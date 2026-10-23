<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tambahkan ini untuk mendaftarkan alias dari config/middleware.php
        foreach (config('middleware.aliases') as $key => $middleware) {
            Route::aliasMiddleware($key, $middleware);
        }
    }
}
