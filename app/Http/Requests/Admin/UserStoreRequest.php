<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if (!request()->id) {
            return $this->onValidateCreate();
        }
        return $rules;
    }

    public function onValidateCreate()
    {
        $is_active = collect(config('global.default.status.users'))->pluck('key')->toArray();

        return [
            'name' => ['required', 'unique:users,name', 'max:200'],
            'email' => ['required', 'unique:users,email', 'max:200', 'email'],
            'password' => ['required', 'min:6', 'max:100'],
            'is_active' => ['required', Rule::in($is_active)]
        ];
    }

    public function onValidateUpdate()
    {
    }
}
