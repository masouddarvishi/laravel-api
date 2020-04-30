<?php

namespace Hooraweb\LaravelApi\Http\Resources;


class TagCollection extends _BaseCollection
{
    /**
     * TagCollection constructor.
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        $this->prepare(TagResource::class);

        return parent::toArray($request);
    }
}
