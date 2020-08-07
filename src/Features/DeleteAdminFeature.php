<?php

namespace OZiTAG\Tager\Backend\Administrators\Features;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Admin\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;

class DeleteAdminFeature extends Feature
{
    protected int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function handle(AdministratorRepository $repository)
    {
        $admin = $repository->find($this->id);
        if(!$admin) {
            throw new \HttpException('Admin Not Found', 404);
        }

        if($admin->id === 1) {
            throw new \HttpException('Access Denied', 403);
        }

        $admin->delete();
        return new SuccessResource();
    }
}
