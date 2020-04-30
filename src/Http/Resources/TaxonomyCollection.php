<?php

namespace Hooraweb\LaravelApi\Http\Resources;


class TaxonomyCollection extends _BaseCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->prepare(TaxonomyResource::class);
        return parent::toArray($request);
    }

    public function resource($relation)
    {
        switch ($relation) {
            case 'tags':
                return TagResource::class;
                break;
        }
    }
}
