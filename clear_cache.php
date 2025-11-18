<?php

/**
 * Quick cache reset utility.
 *
 * Upload this file together with your application (preferably outside the public
 * web root) and hit it from the CLI or browser when you need to flush Laravel's
 * caches on a shared host.
 *
 * IMPORTANT: remove this file after use or protect it, otherwise anyone who can
 * guess the URL could wipe your caches.
 */

define('LARAVEL_START', microtime(true));

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

ob_start();

try {
    $commands = [
        'cache:clear',
        'config:clear',
        'route:clear',
        'view:clear',
        'optimize:clear',
    ];

    foreach ($commands as $command) {
        $kernel->call($command);
        echo sprintf("[%s] %s\n", now()->toDateTimeString(), $command);
    }

    echo "\nCaches cleared successfully in " . round(microtime(true) - LARAVEL_START, 3) . "s\n";
} catch (Throwable $e) {
    http_response_code(500);
    echo "Cache clear failed: " . $e->getMessage();
}

return ob_get_flush();


