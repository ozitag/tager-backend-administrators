<?php

namespace OZiTAG\Tager\Backend\Administrators\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminRoleResource extends JsonResource
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
            'scopes' => $this->scopes ? explode(',', $this->scopes) : [],
        ];
    }
}
