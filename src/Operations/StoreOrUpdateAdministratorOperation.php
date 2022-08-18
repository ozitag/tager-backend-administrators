<?php

namespace OZiTAG\Tager\Backend\Administrators\Operations;

use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Admin\Models\Administrator;
use OZiTAG\Tager\Backend\Administrators\Events\AdminRolesUpdated;
use OZiTAG\Tager\Backend\Administrators\Jobs\SaveAdministratorFieldsJob;
use OZiTAG\Tager\Backend\Administrators\Repositories\AdministratorFieldRepository;
use OZiTAG\Tager\Backend\Administrators\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Administrators\Requests\StoreOrUpdateAdminRequest;
use OZiTAG\Tager\Backend\Core\Jobs\Operation;

class StoreOrUpdateAdministratorOperation extends Operation
{
    protected StoreOrUpdateAdminRequest $request;

    protected ?Administrator $model;

    public function __construct(StoreOrUpdateAdminRequest $request, ?Administrator $model = null)
    {
        $this->request = $request;
        $this->model = $model;
    }

    public function handle(AdministratorRepository $repository, AdministratorFieldRepository $administratorFieldRepository)
    {
        if ($this->model) {
            $repository->reset()->set($this->model);

            $password = $this->request->get('password', null) ?
                Hash::make($request->get('password')) :
                $this->model->password;
        } else {
            $password = Hash::make($this->request->get('password'));
        }

        $admin = $repository->fillAndSave(
            array_merge($this->request->only(['name', 'email']), [
                'password' => $password
            ])
        );

        $changes = $admin->roles()->sync($this->request->get('roles'));

        if ($changes['attached'] || $changes['detached']) {
            event(new AdminRolesUpdated($admin->id));
        }

        $params = $this->request->params;

        $this->run(SaveAdministratorFieldsJob::class, [
            'model' => $admin,
            'params' => $this->request->params
        ]);

        return $admin;
    }
}
