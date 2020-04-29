<?php

namespace App\Http\Requests\Taxonomy;

use App\Models\Taxonomy;
use App\Policies\TaxonomyPolicy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaxonomyIndexRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize() {

        return Auth::user()->can('vieAny',[Taxonomy::class]);

    }

    public function rules() {
        return [
            //
        ];
    }
}