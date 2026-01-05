<?php

namespace App\Providers;

use App\Models\Iuran;
use App\Observers\IuranObserver;
use Illuminate\Support\ServiceProvider;

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
        Iuran::observe(IuranObserver::class);
    }
}
