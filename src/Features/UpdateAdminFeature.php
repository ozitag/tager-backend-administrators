<?php

namespace OZiTAG\Tager\Backend\Administrators\Features;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Admin\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Administrators\Requests\UpdateAdminRequest;
use OZiTAG\Tager\Backend\Administrators\Resources\AdminResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;

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

        if(!$admin) {
            throw new \HttpException('Admin Not Found', 404);
        }

        if($admin->id === $this->user()->id) {
            throw new \HttpException('Access Denied', 403);
        }

        $repository->fillAndSave(
            array_merge($request->only(['name', 'email']), [
                'password' => $request->get('password', null) ?
                    Hash::make($request->get('password')) :
                    $admin->password
            ])
        );

        return new AdminResource($admin);
    }
}
