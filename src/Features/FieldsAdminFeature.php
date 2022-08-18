<?php

namespace OZiTAG\Tager\Backend\Administrators\Features;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Admin\Utils\TagerAdminConfig;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class FieldsAdminFeature extends Feature
{
    public function handle()
    {
        $configFields = TagerAdminConfig::getFields();

        $fields = [];
        foreach ($configFields as $field) {
            $fields[] = $field->getJson();
        }

        return new JsonResource($fields);
    }

}
