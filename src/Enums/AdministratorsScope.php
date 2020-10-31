<?php

namespace OZiTAG\Tager\Backend\Administrators\Enums;

use OZiTAG\Tager\Backend\Core\Enums\Enum;

final class AdministratorsScope extends Enum
{
    const View = 'administrators.view';
    const Create = 'administrators.create';
    const Edit = 'administrators.edit';
    const Delete = 'administrators.delete';
}
