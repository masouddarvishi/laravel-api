<?php

namespace Hooraweb\LaravelApi\Http\Resources;


Use Permission;

class RoleResource extends _BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = [
            'id' => $this->id,
            'type' => 'role',
            'attributes' => [
                'name' => $this->name,
                'guard_name' => $this->guard_name
            ]
        ];

        $resource['includes']['permissions'] = $this->whenLoaded('permissions', function(){
            return Permission::collection($this->permissions);
        });
        return $resource;
    }
}
