<?php

namespace OZiTAG\Tager\Backend\Admin;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\Token;
use Laravel\Passport\Passport;
use OZiTAG\Tager\Backend\Admin\Listeners\AdminAuthListener;
use OZiTAG\Tager\Backend\Admin\Observers\TokenObserver;
use OZiTAG\Tager\Backend\Auth\AuthServiceProvider;

class AdministratorsServiceProvider extends EventServiceProvider
{

    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
