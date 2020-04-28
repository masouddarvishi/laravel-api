<?php

namespace Hooraweb\LaravelApi\Http\Resources;

class RoleCollection extends _BaseCollection
{
    public function toArray($request)
    {
        $this->prepare(RoleResource::class);

        return parent::toArray($request);
    }
}
