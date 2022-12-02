<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        $unique_except = request()->id;
        if (request()->id) {
            return [
                'name' => ['required', 'max:200', 'min:6', 'unique:department,name,' . $unique_except],
            ];
        }
        return [
            'name' => ['required', 'max:200', 'min:6', 'unique:department,name']
        ];
    }
}
