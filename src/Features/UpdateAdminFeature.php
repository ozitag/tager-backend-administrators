<?php

namespace OZiTAG\Tager\Backend\Administrators\Features;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Administrators\Events\AdminRolesUpdated;
use OZiTAG\Tager\Backend\Administrators\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Administrators\Requests\UpdateAdminRequest;
use OZiTAG\Tager\Backend\Administrators\Resources\AdminResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Rbac\Facades\AccessControl;
use OZiTAG\Tager\Backend\Rbac\Models\Role;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdateAdminFeature extends Feature
{
    protected int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function handle(UpdateAdminRequest $request, AdministratorRepository $repository)
    {
        $admin = $repository->setById($this->id);

        if (!$admin) {
            throw new HttpException(404, 'Admin Not Found');
        }

        $repository->fillAndSave(
            array_merge($request->only(['name', 'email']), [
                'password' => $request->get('password', null) ?
                    Hash::make($request->get('password')) :
                    $admin->password
            ])
        );

        $changes = $admin->roles()->sync($request->get('roles'));

        if ($changes['attached'] || $changes['detached']) {
            event(new AdminRolesUpdated($admin->id));
        }

        return new AdminResource($admin);
    }
}
