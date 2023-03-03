<?php

namespace App\Http\Requests\Admin;

use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    private $_serviceInterFace;
    public function __construct(ServiceRepositoryInterface $serviceRepositoryInterface)
    {
        $this->_serviceInterFace = $serviceRepositoryInterface;
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
                'serviceName' => ['required','unique:services,name,'],
                'serviceDescription' => 'required'
            ];
        }
        $service = $this->_serviceInterFace->find(request()->id);
        $services = $this->_serviceInterFace->getAllData();
        return [
            'serviceName' => [
                'required',
                function ($attribute, $value, $fail) use ($service, $services) {
                    foreach ($services as $item) {
                        if ($item->name == $value && $value != $service->name) {
                            return $fail('Dịch vụ đã tồn tại trong hệ thống');
                        }
                    }
                }
            ],
            'serviceDescription' => 'required'
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
            'serviceName.required' => 'Tên dịch vụ không được bỏ trống!',
            'serviceName.unique' => 'Tên dịch vụ đã tồn tại!',
            'serviceDescription.required' =>'Mô tả dịch vụ không được bỏ trống!'
        ];
    }
}
