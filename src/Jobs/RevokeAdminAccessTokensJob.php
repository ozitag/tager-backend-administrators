<?php

namespace OZiTAG\Tager\Backend\Administrators\Jobs;

use Illuminate\Support\Facades\DB;
use OZiTAG\Tager\Backend\Core\Jobs\Job;

class RevokeAdminAccessTokensJob extends Job
{

    protected int $id;

    /**
     * GetRefreshTokenJob constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        $id = $this->id;
        DB::update("UPDATE oauth_access_tokens SET revoked = 1 WHERE user_id = $id AND provider = 'administrators'");
    }
}
