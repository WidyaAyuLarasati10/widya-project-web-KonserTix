<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon; // Import Carbon untuk pengaturan bahasa

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
        // Mengatur zona waktu aplikasi ke WIB dan bahasa default Carbon ke Bahasa Indonesia
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }
}