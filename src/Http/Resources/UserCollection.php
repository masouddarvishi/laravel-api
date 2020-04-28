<?php

namespace Hooraweb\LaravelApi\Http\Resources;


class UserCollection extends _BaseCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->prepare(UserResource::class);

        return parent::toArray($request);
    }
}
