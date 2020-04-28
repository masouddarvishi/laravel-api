<?php

namespace Hooraweb\LaravelApi\Models;



use Hooraweb\LaravelApi\Http\Resources\RoleCollection;
use Hooraweb\LaravelApi\Http\Resources\RoleResource;

class Role extends \Spatie\Permission\Models\Role
{


    public static function resource($data)
    {
        return new RoleResource($data);
    }
    public static function collection($data)
    {
        return new RoleCollection($data);
    }
}
