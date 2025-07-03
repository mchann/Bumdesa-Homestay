<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (class_exists(Socialite::class)) {
            $this->app->alias(Socialite::class, 'Socialite');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Menghindari error "Specified key was too long" di MySQL
        Schema::defaultStringLength(191);

        // Pastikan HTTPS di production
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        if (App::runningInConsole()) {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);

            $schedule->command('auto-cancel:unpaid')->everyFiveMinutes();

            
            $schedule->command('auto-complete:checkout')->dailyAt('00:10');
        });
    }
    }}
