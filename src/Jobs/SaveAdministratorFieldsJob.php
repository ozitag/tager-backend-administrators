<?php

namespace OZiTAG\Tager\Backend\Administrators\Jobs;

use OZiTAG\Tager\Backend\Admin\Models\Administrator;
use OZiTAG\Tager\Backend\Admin\Repositories\AdministratorFieldRepository;
use OZiTAG\Tager\Backend\Admin\Utils\TagerAdminConfig;
use OZiTAG\Tager\Backend\Core\Jobs\Job;

class SaveAdministratorFieldsJob extends Job
{
    protected Administrator $model;

    protected ?array $params;

    public function __construct(Administrator $model, ?array $params)
    {
        $this->model = $model;
        $this->params = $params;
    }

    public function handle(AdministratorFieldRepository $administratorFieldRepository)
    {
        $administratorFieldRepository->builder()
            ->where('administrator_id', $this->model->id)
            ->delete();

        foreach ($this->params as $param) {
            $name = $param['name'] ?? null;
            $value = $param['value'] ?? null;

            if (is_null($name) || is_null($value)) continue;

            $field = TagerAdminConfig::getField($name);
            if (!$field) {
                continue;
            }

            $type = $field->getTypeInstance();
            $type->setValue($value);

            if (!empty($type->hasFiles())) {
                $scenario = $field->getMetaParamValue('scenario');
                if (!empty($scenario)) {
                    $type->applyFileScenario($scenario);
                }
            }

            $administratorFieldRepository->reset()->fillAndSave([
                'administrator_id' => $this->model->id,
                'field' => $name,
                'value' => $type->getDatabaseValue()
            ]);
        }
    }
}
