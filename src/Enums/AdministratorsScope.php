<?php

namespace OZiTAG\Tager\Backend\Administrators\Enums;

enum AdministratorsScope: string
{
    case View = 'administrators.view';
    case Create = 'administrators.create';
    case Edit = 'administrators.edit';
    case Delete = 'administrators.delete';
}
