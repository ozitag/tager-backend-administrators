<?php

namespace OZiTAG\Tager\Backend\Administrators\Features;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Admin\Models\Administrator;
use OZiTAG\Tager\Backend\Administrators\Repositories\AdministratorRepository;
use OZiTAG\Tager\Backend\Administrators\Resources\AdminResource;
use OZiTAG\Tager\Backend\Administrators\Utils\TagerAdministratorsConfig;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\Enums\RepeaterView;
use OZiTAG\Tager\Backend\Fields\FieldFactory;
use OZiTAG\Tager\Backend\Fields\Fields\RepeaterField;

class FieldsAdminFeature extends Feature
{
    public function handle()
    {
        $configFields = TagerAdministratorsConfig::getFields();

        $fields = [];
        foreach ($configFields as $field) {
            $fields[] = $field->getJson();
        }

        return new JsonResource($fields);
    }

}
