<?php

namespace App\Http\Requests\Chatbot;

use App\Traits\ApiValidateTrait;
use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
{
    use ApiValidateTrait;
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
        return [
            'email' => [
                function ($attribute, $value, $fail) {
                    if (empty(request()->email) && empty(request()->phone)) {
                        return $fail('Vui lòng nhập số điện thoại hoặc email!');
                    }
                },
                'email'
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.min' => 'Số điện thoại không đúng định dạng',
            'phone.max' => 'Số điện thoại không đúng định dạng'
        ];
    }
}
