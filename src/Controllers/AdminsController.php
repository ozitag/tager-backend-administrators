<?php

namespace OZiTAG\Tager\Backend\Administrators\Controllers;

use App\Admin\Services\Operations\CreateOrUpdateServiceOperation;
use App\Admin\Services\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Admin\Models\Administrator;
use OZiTAG\Tager\Backend\Admin\Models\AdministratorRole;
use OZiTAG\Tager\Backend\Administrators\Features\DeleteAdminFeature;
use OZiTAG\Tager\Backend\Administrators\Features\FieldsAdminFeature;
use OZiTAG\Tager\Backend\Administrators\Features\ListAdminFeature;
use OZiTAG\Tager\Backend\Administrators\Features\StoreAdminFeature;
use OZiTAG\Tager\Backend\Administrators\Features\UpdateAdminFeature;
use OZiTAG\Tager\Backend\Administrators\Features\ViewAdminFeature;
use OZiTAG\Tager\Backend\Administrators\Models\AdministratorField;
use OZiTAG\Tager\Backend\Administrators\Operations\StoreOrUpdateAdministratorOperation;
use OZiTAG\Tager\Backend\Administrators\Repositories\AdministratorFieldRepository;
use OZiTAG\Tager\Backend\Administrators\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Administrators\Requests\StoreOrUpdateAdminRequest;
use OZiTAG\Tager\Backend\Administrators\Resources\AdminRoleResource;
use OZiTAG\Tager\Backend\Administrators\Utils\TagerAdministratorsConfig;
use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\Crud\Actions\IndexAction;
use OZiTAG\Tager\Backend\Crud\Actions\StoreOrUpdateAction;
use OZiTAG\Tager\Backend\Crud\Controllers\AdminCrudController;
use OZiTAG\Tager\Backend\Rbac\Facades\AccessControl;
use OZiTAG\Tager\Backend\Rbac\Models\Role;

class AdminsController extends AdminCrudController
{
    public bool $hasCountAction = true;

    public function __construct(AdministratorRepository $repository)
    {
        parent::__construct($repository);

        $this->setResourceFields([
            'id', 'name', 'email',
            'roles' => function (Administrator $model) {
                return $model->roles->map(function (Role $role) {
                    return [
                        'id' => $role->id,
                        'name' => $role->name,
                        'scopes' => $role->scopes ? explode(',', $role->scopes) : [],
                    ];
                });
            },
            'isSuperAdmin' => function (Administrator $model) {
                return AccessControl::is($model, Role::getSuperAdminRoleId());
            },
            'isSelf' => function (Administrator $model) {
                return $model->id == Auth::user()->id;
            },
        ], true);

        $this->setFullResourceFields([
            'id', 'name', 'email',
            'roles' => function (Administrator $model) {
                return $model->roles->map(function (Role $role) {
                    return [
                        'id' => $role->id,
                        'name' => $role->name,
                        'scopes' => $role->scopes ? explode(',', $role->scopes) : [],
                    ];
                });
            },
            'isSuperAdmin' => function (Administrator $model) {
                return AccessControl::is($model, Role::getSuperAdminRoleId());
            },
            'isSelf' => function (Administrator $model) {
                return $model->id == Auth::user()->id;
            },
            'params' => function (Administrator $model) {

                /** @var AdministratorFieldRepository $repository */
                $repository = App::make(AdministratorFieldRepository::class);

                /** @var AdministratorField[] $dbFields */
                $dbFields = $repository->builder()->where('administrator_id', $model->id)->get();
                $data = [];
                foreach ($dbFields as $dbField) {
                    $data[$dbField->field] = $dbField->value;
                }

                $fields = TagerAdministratorsConfig::getFields();
                $result = [];

                foreach ($fields as $fieldName => $field) {
                    $type = $field->getTypeInstance();
                    $type->loadValueFromDatabase($data[$fieldName] ?? null);

                    $result[] = [
                        'config' => $field->getJson(),
                        'value' => $type->getAdminFullJson(),
                    ];
                }

                return $result;
            }
        ], true);

        $this->setStoreAndUpdateAction(new StoreOrUpdateAction(
            StoreOrUpdateAdminRequest::class,
            StoreOrUpdateAdministratorOperation::class
        ));
    }

    public function fields()
    {
        return $this->serve(FieldsAdminFeature::class);
    }
}
