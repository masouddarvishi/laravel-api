<?php
namespace Hooraweb\LaravelApi\Http\Requests\Tag;

use Hooraweb\LaravelApi\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

class TagIndexRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('viewAny', [Tag::class]);
    }

    public function rules() {
        return [
            'per_page' => 'numeric|min:1|max:100'
        ];
    }
}