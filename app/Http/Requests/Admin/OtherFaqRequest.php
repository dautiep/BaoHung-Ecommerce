<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OtherFaqRequest extends FormRequest
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
        return [

            'content_to_consult' => ['max:200', function ($attribute, $value, $fail) {
                // if (isset(request()->assigned_user_id) && empty($value)) {
                //     $message = config('global.default.messages.orther_faqs.not_assgiment_answer') ?? '';
                //     $fail($message);
                // }
            }]
        ];
    }
}
