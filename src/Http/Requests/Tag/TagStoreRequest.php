<?php
namespace Hooraweb\LaravelApi\Http\Requests\Tag;


use Hooraweb\LaravelApi\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class TagStoreRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('create', [Tag::class]);
    }

    public function rules() {
        $this->bind();
        return [
            'taxonomy_id' => 'required|string',
            'label' => 'required|string',
            'slug' => 'nullable|string|unique:tags,slug',
            'metadata' => 'nullable|json'
          ];

    }

    public function bind() {

        $this->request->add(['tag' => $this->route()->hasParameter('tag') ? Tag::findOrFail($this->tag): new Tag()]);


    }

}