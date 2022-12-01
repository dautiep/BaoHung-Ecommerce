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
            'status' => ['required'],
            'content_to_consult' => ['max:200', function ($attribute, $value, $fail) {
                $status_answered = config('global.default.status.orther_faqs.answered');
                if ((request()->get('status') == @$status_answered['key']) && empty($value)) {
                    $message = config('global.default.messages.orther_faqs.not_required_answer') ?? '';
                    $fail($message);
                }
            }]
        ];
    }
}
