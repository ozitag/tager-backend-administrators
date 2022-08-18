<?php

namespace OZiTAG\Tager\Backend\Administrators\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use OZiTAG\Tager\Backend\Core\Models\TModel;
use OZiTAG\Tager\Backend\Rbac\Models\Role;

/**
 * @property int $administrator_id
 * @property string $field
 * @property string $value
 */
class AdministratorField extends TModel
{
    protected $table = 'tager_administrators_fields';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'administrator_id', 'field', 'value'
    ];
}
