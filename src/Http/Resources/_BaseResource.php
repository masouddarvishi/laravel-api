<?php

namespace Hooraweb\LaravelApi\Http\Resources;

use User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Response;

abstract class _BaseResource extends Resource
{
    protected $full;

    public function __construct($resource, $full = true)
    {
        $this->full = $full;
        parent::__construct($resource);
    }

    public function withResponse($request, $response)
    {
        $response
            ->setStatusCode(Response::HTTP_OK)
            ->header('Content-Type', 'application/vnd.api+json');
    }

//    protected function setIncludes(&$resource)
//    {
//        $includes = new \stdClass();
//        foreach ($this->resource->getRelations() as $relation => $items) {
//            $relationResource = $this->resource($relation);
//            if ($relationResource === null) {
//                continue;
//            }
//            if ($items instanceof Model) {
//                $includes->{$relation}[$items->id] = (new $relationResource($items))->partial();
//            } else {
//                if ($items instanceof Collection) {
//                    foreach ($items as $item) {
//                        $includes->{$relation}[$item->id] = (new $relationResource($item))->partial();
//                    }
//                }
//            }
//            $resource[$relation] = isset($includes->{$relation}) ? (object)$includes->{$relation} : null;
//        }
//    }

    public function partial()
    {
        $this->full = false;

        return $this;
    }
}
