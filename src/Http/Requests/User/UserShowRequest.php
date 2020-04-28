<?php

namespace Hooraweb\LaravelApi\Http\Requests\User;

use User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class UserShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->bind();
         return  Auth::user()->hasPermissionTo('manage-users');
    }

    public function rules()
    {
        return [
            //
        ];
    }

    private function bind()
    {
        //Auth::user()->bindingPermissions();
        // this is shite code just for testing.
        $user = QueryBuilder::for(User)
            ->allowedFields(['id', 'name', 'mobile'])
            ->allowedIncludes('roles.permissions', 'posts')
            ->firstWhere('id', '=', $this->user);

        if (empty($user)){
            abort(404);
        }

        $this->user = $user;
    }
}
