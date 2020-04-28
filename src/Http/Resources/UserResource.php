<?php

namespace Hooraweb\LaravelApi\Http\Resources;

use Role;
class UserResource extends _BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = [
            'id' => $this->id,
            'type' => 'user',
            'attributes' => [
                'name' => $this->name,
                'mobile' => str_pad((string)$this->mobile, 11, "0", STR_PAD_LEFT),
                'cache' => $this->cache
            ]
        ];


        $resource['attributes'] = array_filter($resource['attributes'], function ($value) {
            return !is_null($value);
        });

        $resource['includes']['roles'] = $this->whenLoaded('roles', function(){
            return Role::collection($this->roles);
        });


        return $resource;
    }

}
