<?php

namespace OZiTAG\Tager\Backend\Administrators\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Admin\Models\Administrator;

class AdministratorRepository extends EloquentRepository
{
    public function __construct(Administrator $model)
    {
        parent::__construct($model);
    }
}
