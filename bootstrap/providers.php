<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Service Providers
    |--------------------------------------------------------------------------
    */
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\BroadcastServiceProvider::class,

    /*
    |--------------------------------------------------------------------------
    | Third-Party / Package Providers
    |--------------------------------------------------------------------------
    */
    Barryvdh\DomPDF\ServiceProvider::class,
    Laratrust\LaratrustServiceProvider::class,
    Maatwebsite\Excel\ExcelServiceProvider::class,
];

