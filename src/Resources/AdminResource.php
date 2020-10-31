<?php

namespace OZiTAG\Tager\Backend\Administrators\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Rbac\Facades\AccessControl;
use OZiTAG\Tager\Backend\Rbac\Models\Role;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => AdminRoleResource::collection($this->roles),
            'isSuperAdmin' => AccessControl::is($this->resource, Role::getSuperAdminRoleId()),
            'isSelf' => $this->id == Auth::user()->id
        ];
    }
}
