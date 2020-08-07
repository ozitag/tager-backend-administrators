<?php

namespace OZiTAG\Tager\Backend\Administrators\Requests;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Core\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'password' => 'required|string|min:6',
            'email' => ['required', 'string', 'email', 'unique:tager_administrators,email'],
        ];
    }
}
