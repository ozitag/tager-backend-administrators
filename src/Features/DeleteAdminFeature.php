<?php

namespace OZiTAG\Tager\Backend\Administrators\Features;

use Illuminate\Foundation\Auth\User;
use OZiTAG\Tager\Backend\Administrators\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\Rbac\Facades\AccessControl;
use OZiTAG\Tager\Backend\Rbac\Models\Role;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DeleteAdminFeature extends Feature
{
    protected int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function handle(AdministratorRepository $repository)
    {
        $user = $this->user();

        /** @var User $admin */
        $admin = $repository->find($this->id);
        if (!$admin) {
            throw new HttpException(404, 'Admin Not Found');
        }

        if ($admin->id == $user->id) {
            throw new HttpException(403, 'It is forbidden to remove yourself');
        }

        if (AccessControl::is($admin, Role::getSuperAdminRoleId())) {
            throw new HttpException(403, 'Access Denied');
        }

        $admin->delete();
        return new SuccessResource();
    }
}
