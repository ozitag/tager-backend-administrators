<?php

namespace OZiTAG\Tager\Backend\Administrators\Features;

use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Administrators\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Administrators\Requests\StoreAdminRequest;
use OZiTAG\Tager\Backend\Administrators\Resources\AdminResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class StoreAdminFeature extends Feature
{
    public function handle(StoreAdminRequest $request, AdministratorRepository $repository)
    {
        $admin = $repository->fillAndSave(
            array_merge($request->only(['name', 'email']), [
                'password' => Hash::make($request->get('password'))
            ])
        );

        $admin->roles()->sync($request->get('roles'));

        return new AdminResource($admin);
    }
}
