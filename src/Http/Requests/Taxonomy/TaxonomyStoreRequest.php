<?php 
namespace App\Http\Requests\Taxonomy;

use App\Models\Taxonomy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaxonomyStoreRequest extends FormRequest {
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize() {

        return Auth::user()->can('create', [Taxonomy::class]);

    }

    public function rules() {
        $this->bind();
        return [
            'slug' => 'nullable|string|unique:taxonomies,slug',
            'label' => 'required|string',
            'group_name' => 'required|string',
        ];
    }

    public function bind() {
        $this->request->add(['taxonomy' => $this->route()->hasParameter('taxonomy') ? Taxonomy::findOrFail($this->taxonomy): new Taxonomy()]);
    }


}