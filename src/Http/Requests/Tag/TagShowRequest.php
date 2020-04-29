<?php
namespace Hooraweb\LaravelApi\Http\Requests\Tag;

use Hooraweb\LaravelApi\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class TagShowRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $tag = $this->route()->parameter('tag');
        return Auth::user()->can('view', [Tag::class, $tag]);
    }

    public function rules() {

        return [
            //
        ];

    }
}