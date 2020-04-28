<?php
namespace Hooraweb\LaravelApi\Http\Requests\User;

use User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserIndexRequest extends FormRequest {

    public function authorize () {

        // note:this is example code let assume you want pass data to UserPolicy
       // Auth::user()->can('viewAny', [User::class,'your parameter']);

        return Auth::user()->can('viewAny', Auth::user());

    }

    public function rules() {

        return [
            //
        ];
    }
}
