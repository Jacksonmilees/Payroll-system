<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $helpers = app_path('helpers.php');

        if (file_exists($helpers)) {
            require_once $helpers;
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Reset connection if running in console to clear any aborted transactions from boot-time queries
        if ($this->app->runningInConsole()) {
            try {
                DB::reconnect();
            } catch (\Exception $e) {
                // Ignore reconnection errors
            }
        }

        if (PHP_MAJOR_VERSION >= 8) {
            error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
        }

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
