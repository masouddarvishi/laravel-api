<?php

namespace Hooraweb\LaravelApi\Http\Requests\Role;

use Hooraweb\LaravelApi\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class RoleShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('view', [Role::class]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->bind();
        return [
            //
        ];
    }

    private function bind(){
        // this is shite code just for testing.
        $role = QueryBuilder::for(Role::class)
            ->allowedFields(['id', 'name'])
            ->allowedIncludes('permissions')
            ->firstWhere('id', '=', $this->role);

        if (empty($role)){
            abort(404);
        }

        $this->role = $role;
    }
}
