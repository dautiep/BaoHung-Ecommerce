<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Interfaces\TypeOfServiceRepositoryInterface;

class TypeOfServiceRequest extends FormRequest
{
    private $_typeOfServiceInterFace;
    public function __construct(TypeOfServiceRepositoryInterface $typeOfServiceInterFace)
    {
        $this->_typeOfServiceInterFace = $typeOfServiceInterFace;
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
            return ['serviceName' => ['required','unique:type_of_service,name,','max:200']];
        }
        $service = $this->_typeOfServiceInterFace->find(request()->id);
        $services = $this->_typeOfServiceInterFace->getAllData();
        return ['serviceName' => [
                    'required',
                    'max:191',
                    function ($attribute, $value, $fail) use ($service, $services) {
                        foreach ($services as $item) {
                            if ($item->name == $value && $value != $service->name) {
                                return $fail('Dịch vụ đã tồn tại trong hệ thống');
                            }
                        }
                    }
                    ]
                ];
    }
}
