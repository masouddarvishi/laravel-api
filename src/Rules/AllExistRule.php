<?php

namespace Hooraweb\LaravelApi\Rules;

use Illuminate\Contracts\Validation\Rule;

class AllExistRule implements Rule
{

    protected $model = null;
    /**
     * Create a new rule instance.
     *
     * @param  $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            return count($value) == $this->model::whereIn('id', $value)->count();
        }catch (\Throwable $throwable){
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'مقادیر انتخاب شده صحیح نمی باشند.';
    }
}
