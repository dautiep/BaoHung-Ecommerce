<?php

namespace App\Http\Requests\Admin;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    private $_categoryInterface;
    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface) {
        $this->_categoryInterface = $categoryRepositoryInterface;
    }

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
        if (!request()->id) {
            return [
                'categoryName' => ['required','unique:categories,name,'],
            ];
        }
        $category = $this->_categoryInterface->find(request()->id);
        $categories = $this->_categoryInterface->getAllData();
        return [
            'categoryName' => [
                'required',
                function ($attribute, $value, $fail) use ($category, $categories) {
                    foreach ($categories as $item) {
                        if ($item->name == $value && $value != $category->name) {
                            return $fail('Danh mục đã tồn tại trong hệ thống');
                        }
                    }
                }
            ]
        ];
    }

    /**
     * Get the message validate
     *
     * @return array
     */
    public function messages()
    {
        return [
            'categoryName.required' => 'Tên danh mục không được bỏ trống!',
            'categoryName.unique' => 'Tên danh mục đã tồn tại!'
        ];
    }
}
