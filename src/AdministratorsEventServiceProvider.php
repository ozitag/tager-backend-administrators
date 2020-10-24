<?php

namespace OZiTAG\Tager\Backend\Administrators;


use OZiTAG\Tager\Backend\Administrators\Events\AdminRolesUpdated;
use OZiTAG\Tager\Backend\Administrators\Listeners\AdminRevokeAccessTokens;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class AdministratorsEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        AdminRolesUpdated::class => [
            AdminRevokeAccessTokens::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
