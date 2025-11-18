FROM php:7.4-apache

LABEL maintainer="Payroll Suite <devops@example.com>"

# Install OS dependencies, PHP extensions, Node.js 14 and supporting tools
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        curl \
        git \
        unzip \
        gnupg \
        libzip-dev \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libssl-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo_mysql zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && curl -fsSL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && npm install -g npm@6 \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Install Composer from the official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Install PHP dependencies
RUN composer install \
        --no-dev \
        --prefer-dist \
        --optimize-autoloader \
        --no-interaction

# Install JS dependencies and build production assets
RUN npm install \
    && npm run production \
    && rm -rf node_modules

# Ensure writable directories belong to www-data
RUN chown -R www-data:www-data storage bootstrap/cache

# Point Apache to the Laravel public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80

CMD ["apache2-foreground"]

