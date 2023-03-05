<?php

namespace App\Http\Requests\Admin;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    private $_productInterface;
    public function __construct(ProductRepositoryInterface $productRepositoryInterface) {
        $this->_productInterface = $productRepositoryInterface;
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
                'productName' => ['required','unique:products,name,'],
                'productCategory' => 'required',
                'productDescription' => 'required',
                'productPrice' => 'required',
                'productImage' => 'required'
            ];
        }
        $product = $this->_productInterface->find(request()->id);
        $products = $this->_productInterface->getAllData();
        return [
            'productName' => [
                'required',
                function ($attribute, $value, $fail) use ($product, $products) {
                    foreach ($products as $item) {
                        if ($item->name == $value && $value != $product->name) {
                            return $fail('Danh mục đã tồn tại trong hệ thống');
                        }
                    }
                }
            ],
            'productCategory' => 'required',
            'productDescription' => 'required',
            'productPrice' => 'required'
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
            'productName.required' => 'Tên sản phẩm không được bỏ trống!',
            'productName.unique' => 'Tên sản phẩm đã tồn tại!',
            'productCategory.required' =>'Danh mục sản phẩm không được bỏ trống!',
            'productDescription.required' => 'Mô tả sản phẩm không được bỏ trống!',
            'productPrice.required' => 'Giá sản phẩm không được bỏ trống!',
            'productImage.required' => 'Hình ảnh sản phẩm không được bỏ trống!'
        ];
    }
}
