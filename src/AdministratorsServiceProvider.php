<?php

namespace OZiTAG\Tager\Backend\Administrators;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use OZiTAG\Tager\Backend\Administrators\Enums\AdministratorsScope;
use OZiTAG\Tager\Backend\Administrators\Events\AdminRolesUpdated;
use OZiTAG\Tager\Backend\Administrators\Listeners\AdminRevokeAccessTokens;
use OZiTAG\Tager\Backend\Rbac\TagerScopes;

class AdministratorsServiceProvider extends EventServiceProvider
{
    protected $listen = [
        AdminRolesUpdated::class => [
            AdminRevokeAccessTokens::class,
        ]
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        TagerScopes::registerGroup('Administrators', [
            AdministratorsScope::View => 'View administrators',
            AdministratorsScope::Create => 'Create administrators',
            AdministratorsScope::Edit => 'Edit administrators',
            AdministratorsScope::Delete => 'Delete administrators'
        ]);
    }
}
