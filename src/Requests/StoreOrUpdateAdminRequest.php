<?php

namespace OZiTAG\Tager\Backend\Administrators\Requests;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Core\Http\FormRequest;
use OZiTAG\Tager\Backend\Crud\Requests\CrudFormRequest;

/**
 * @property string $name
 * @property string $password
 * @property string $email
 * @property int[] $roles
 * @property array $params
 */
class StoreOrUpdateAdminRequest extends CrudFormRequest
{
    public function rules()
    {
        $userId = $this->route('id', 0);

        return [
            'name' => 'required|string',
            'password' => ($userId ? 'nullable' : 'required') . '|string|min:6',
            'email' => ['required', 'string', 'email', 'unique:tager_administrators,email,' . $userId . ',id,deleted_at,NULL'],
            'roles' => 'array|nullable',
            'roles.*' => 'integer|exists:tager_roles,id',
            'params' => 'nullable|array',
            'params.*.name' => 'string',
            'params.*.value' => 'present'
        ];
    }
}
