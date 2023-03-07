<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'btn_href' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'img_src' => [''],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề hình ảnh không được bỏ trống!',
            'btn_href.required' => 'Đường dẫn liên kết không được bỏ trống !',
            'description.required' => 'Mô tả không được bỏ trống',
            'img_src.required' => 'Hình ảnh không được bỏ trống',
            '*.max' => 'Số lượng kí tự văn bản không vượt quá 255 kí tự ',
        ];
    }
}
