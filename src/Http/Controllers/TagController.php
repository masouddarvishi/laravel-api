<?php

namespace Hooraweb\LaravelApi\Http\Controllers;


use App\Http\Controllers\Controller;
use Hooraweb\LaravelApi\Http\Requests\Tag\TagIndexRequest;
use Hooraweb\LaravelApi\Http\Requests\Tag\TagShowRequest;
use Hooraweb\LaravelApi\Http\Requests\Tag\TagStoreRequest;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Tag;

class TagController extends Controller
{

    public function index(TagIndexRequest $request)
    {

        $tags = QueryBuilder::for(Tag::class)
            ->allowedFilters(['parent_id', 'taxonomy_id', 'label', 'slug'])
            ->allowedSorts( ['parent_id', 'taxonomy_id', 'label', 'slug']);

        $tags = $request->get('per_page',false) ? $tags->paginate($request->per_page) : $tags->get();


        return Tag::collection($tags);

    }

    public function store(TagStoreRequest $request)
    {

        try {
            DB::beginTransaction();
            // store tag
            $tag = $request->tag->fill([
                'taxonomy_id' => $request->get('taxonomy_id'),
                'label' => $request->get('label'),
                'slug' => $request->get('slug'),
                'metadata' => $request->get('metadata')
            ]);
            $tag->save();
            DB::commit();
            return Tag::resource($tag);

        } catch (\Exception $e) {

            DB::rollBack();
            return response(['message' => 'اطلاعات ذخیره نشد.']);

        }
    }

    /**
     * @param Tag $tag
     * @param TagShowRequest $request
     * @return TagResource
     */
    public function show(Tag $tag, TagShowRequest $request)
    {
        return Tag::resource($tag);
    }
}
