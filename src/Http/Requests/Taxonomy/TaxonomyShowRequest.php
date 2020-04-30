<?php
namespace Hooraweb\LaravelApi\Http\Requests\Taxonomy;

use Taxonomy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaxonomyShowRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize() {

        $taxonomy = $this->route()->parameter('taxonomy');
        return Auth::user()->can('view',[Taxonomy::class, $taxonomy]);
    }

    public function rules() {
        return [
            //
        ];
    }
}