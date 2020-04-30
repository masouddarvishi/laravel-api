<?php

namespace Hooraweb\LaravelApi\Http\Resources;

class TaxonomyResource extends _BaseResource
{
    public function toArray($request)
    {
        $resource = [
            'type'   =>  'taxonomy',
            'id'     =>  (string) $this->id,
            'attributes'   =>  [
                'group_name'        =>  $this->group_name,
                'label'             =>  $this->label,
                'slug'              =>  $this->slug,
            ],
        ];

        return $resource;
    }
}
