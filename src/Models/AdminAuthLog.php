<?php

namespace OZiTAG\Tager\Backend\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdminAuthLog extends Model
{
    const UPDATED_AT = null;

    protected $table = 'tager_administrator_auth_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip',
        'administrator_id'
    ];
}
