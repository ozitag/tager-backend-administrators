<?php

namespace OZiTAG\Tager\Backend\Administrators\Repositories;

use OZiTAG\Tager\Backend\Administrators\Models\AdministratorField;
use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Admin\Models\Administrator;

class AdministratorFieldRepository extends EloquentRepository
{
    public function __construct(AdministratorField $model)
    {
        parent::__construct($model);
    }
}
