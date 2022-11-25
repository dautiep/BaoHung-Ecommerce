<?php

namespace App\Http\Requests\Admin;

use App\Repositories\RoleRepository;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
        } else {
            return $this->onValidateUpdate();
        }

        return $rules;
    }

    public function getRoleRuleAll()
    {
        return
            collect(app(RoleRepository::class)->getAllByCondition()->pluck('id')->toArray());
    }

    public function getConfigStatus()
    {
        return collect(config('global.default.status.groups'))->pluck('key')->toArray();
    }

    public function onValidateCreate()
    {
        $config = $this->getConfigStatus();

        return [
            'name' => ['required', 'max:200', 'min:6'],
            'status' => ['required', Rule::in($config)],
        ];
    }

    public function onValidateUpdate()
    {
        $config = $this->getConfigStatus();
        return [
            'name' => ['required', 'max:200', 'min:6'],
            'status' => ['required', Rule::in($config)],
        ];
    }
}
