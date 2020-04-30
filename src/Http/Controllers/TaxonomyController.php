<?php

namespace Hooraweb\LaravelApi\Http\Controllers;


use App\Http\Controllers\Controller;
use Hooraweb\LaravelApi\Http\Requests\Taxonomy\TaxonomyIndexRequest;
use Hooraweb\LaravelApi\Http\Requests\Taxonomy\TaxonomyShowRequest;
use Hooraweb\LaravelApi\Http\Requests\Taxonomy\TaxonomyStoreRequest;
use Spatie\QueryBuilder\QueryBuilder;
use Taxonomy;
use Illuminate\Support\Facades\DB;

class TaxonomyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param TaxonomyIndexRequest $request
     * @return
     */
    public function index(TaxonomyIndexRequest $request)
    {
        $taxonomies = QueryBuilder::for(Taxonomy::class)
            ->allowedFilters( ['slug', 'label', 'group_name'])
            ->allowedSorts(['slug', 'label', 'group_name']);

        $taxonomies = $request->get('per_page',false) ? $taxonomies->paginate($request->per_page) : $taxonomies->get();


        return Taxonomy::collection($taxonomies);
    }


    /**
     * Store a newly created resource in storage.
     * @param TaxonomyStoreRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(TaxonomyStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $taxonomy = $request->taxonomy->fill([
                'slug' => $request->get('slug'),
                'label' => $request->get('label'),
                'group_name' => $request->get('group_name')

            ]);
            $taxonomy->save();
            DB::commit();
            return Taxonomy::resource($taxonomy);
        }catch( \Exception $e) {
            return response(['message' => 'اطلاعات ذخیره نشد']);
        }
        
    }

    /**
     * Display the specified resource.
     * @param Taxonomy $taxonomy
     * @param TaxonomyShowRequest $request
     * @return
     */
    public function show(Taxonomy $taxonomy, TaxonomyShowRequest $request)
    {
       return Taxonomy::resource($taxonomy);
    }

    

}
