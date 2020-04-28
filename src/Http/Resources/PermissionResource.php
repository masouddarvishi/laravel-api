<?php

namespace Hooraweb\LaravelApi\Http\Resources;

class PermissionResource extends _BaseResource
{
    public function toArray($request)
    {
        $resource = [
            'type'   =>  'permission',
            'id'     =>  (string) $this->id,
            'attributes'   =>  [
                'name'       =>  $this->name,
            ],
//            $this->mergeWhen(isset($relations['roles']) && count($relations['roles']), [
//                'relations' => [
//                    'roles'             =>  $this->roles->pluck('id'),
//                ],
//            ]),
        ];

        if ($this->full){
            $resource['attributes']['created_at'] = optional($this->created_at)->toIso8601String();
            $resource['attributes']['updated_at'] = optional($this->updated_at)->toIso8601String();
        }

        return $resource;
    }
}
