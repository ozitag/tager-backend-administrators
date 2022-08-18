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
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'tager-administrators');

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        TagerScopes::registerGroup(__('tager-administrators::scopes.group'), [
            AdministratorsScope::View->value => __('tager-administrators::scopes.view_administrators'),
            AdministratorsScope::Create->value => __('tager-administrators::scopes.create_administrators'),
            AdministratorsScope::Edit->value => __('tager-administrators::scopes.edit_administrators'),
            AdministratorsScope::Delete->value => __('tager-administrators::scopes.delete_administrators')
        ]);
    }
}
