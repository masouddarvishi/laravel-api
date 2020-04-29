<?php

namespace Hooraweb\LaravelApi\Http\Requests\Role;

use Hooraweb\LaravelApi\Models\Role;
use User;
use Hooraweb\LaravelApi\Rules\AllExistRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class RoleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('create', [Role::class]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->bind();
        
        // rules for update
        if ($this->role->id) {
            $rules = [
                'name' => ['required', 'string', 'min:2','max:50' ,
                    $this->route()->hasParameter('role') ? Rule::unique('roles','name')->ignore( $this->role->id) : 'unique:roles,name'],
                
            ];
        }
        // rules for store
        else {
            $rules = [
                'name' => ['required', 'string', 'min:2','max:50' ,
                    $this->route()->hasParameter('role') ? Rule::unique('roles','name')->ignore( $this->role->id) : 'unique:roles,name'],
                'permissions' => ['required', new AllExistRule(Permission::class)]
            ];
        
        }

        return $rules;
    }

    private function bind()
    {
        $this->role = $this->role? Role::findOrFail($this->role) : new Role();
    }
}

