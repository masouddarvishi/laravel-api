<?php

namespace Hooraweb\LaravelApi\Http\Resources;

class PermissionCollection extends _BaseCollection
{
    public function toArray($request)
    {
        $this->prepare(PermissionResource::class);

        return parent::toArray($request);
    }
}
