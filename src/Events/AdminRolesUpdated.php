<?php

namespace OZiTAG\Tager\Backend\Administrators\Events;


class AdminRolesUpdated
{
    protected int $adminId;

    public function __construct(int $adminId)
    {
        $this->adminId = $adminId;
    }

    public function getAdminId()
    {
        return $this->adminId;
    }
}
