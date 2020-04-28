<?php

namespace Hooraweb\LaravelApi\Http\Requests\User;

use User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $this->bind();
        return Auth::user()->id  == ($this->user->id ?? 0) || Auth::user()->hasPermissionTo('manage-users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => 'required|string|min:5|max:50',
            'mobile' => 'required_without:email' ,
        ];
    }

    private function bind()
    {
        $this->user = $this->user ? User::findOrFail($this->user): new User();
    }
}
