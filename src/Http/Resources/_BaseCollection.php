<?php

namespace Hooraweb\LaravelApi\Http\Resources;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Throwable;

abstract class _BaseCollection extends ResourceCollection
{
    protected $full = true;

    protected $includes;

    public function with($request)
    {
        return empty($this->includes) ? [] : ['included' => $this->includes];
    }

    public function withResponse($request, $response)
    {
        $response
            ->setStatusCode(Response::HTTP_OK)
            ->header('Content-Type', 'application/vnd.api+json');
    }

    public function partial()
    {
        $this->full = false;

        return $this;
    }

    /**
     * @param   $resource
     *
     * @param Closure $closure
     */
    protected function prepare($resource)
    {
        $this->collection->transform(function ($model) use ($resource) {
            return (new $resource($model, $this->full))->additional(['meta' => $this->additional]);
        });
    }

}
