<?php

namespace OZiTAG\Tager\Backend\Administrators\Requests;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Core\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'password' => 'nullable|string|min:6',
            'email' => ['required', 'string', 'email', 'unique:tager_administrators,email,' . $this->id],
        ];
    }
}
