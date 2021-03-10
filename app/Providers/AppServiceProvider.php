<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );

        $this->app->bind(
            'App\Interfaces\EmployeeRepositoryInterface',
            'App\Repositories\EmployeeRepository'
        );

        $this->app->bind(
            'App\Interfaces\HolidayRequestRepositoryInterface',
            'App\Repositories\HolidayRequestRepository'
        );

        $this->app->bind(
            'App\Interfaces\TeamLeaderRepositoryInterface',
            'App\Repositories\TeamLeaderRepository'
        );

        $this->app->bind(
            'App\Interfaces\TeamRepositoryInterface',
            'App\Repositories\TeamRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
