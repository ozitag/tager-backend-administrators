<?php

namespace OZiTAG\Tager\Backend\Administrators\Listeners;

use OZiTAG\Tager\Backend\Administrators\Events\AdminRolesUpdated;
use OZiTAG\Tager\Backend\Administrators\Jobs\RevokeAdminAccessTokensJob;

class AdminRevokeAccessTokens
{
    /**
     * @param AdminRolesUpdated $event
     */
    public function handle(AdminRolesUpdated $event)
    {
        dispatch_now(new RevokeAdminAccessTokensJob($event->getAdminId()));
    }
}
