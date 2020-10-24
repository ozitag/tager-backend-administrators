<?php

namespace OZiTAG\Tager\Backend\Administrators;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class AdministratorsServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->register(AdministratorsEventServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
    }
}
