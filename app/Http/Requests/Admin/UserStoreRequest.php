<?php

namespace App\Http\Requests\Admin;

use App\Models\Group;
use App\Repositories\GroupRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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

    public function getGroupRuleAll()
    {
        return
            collect(app(GroupRepository::class)->getAllByCondition([
                'status' =>  Group::$STATUS_ACTIVE
            ])->pluck('id')->toArray());
    }

    public function onValidateCreate()
    {
        $groups = request()->groups;

        return [
            'name' => ['required', 'unique:users,name', 'max:200'],
            'email' => ['required', 'unique:users,email', 'max:200', 'email'],
            'password' => ['required', 'min:6', 'max:100'],
            'groups'  => [function ($attribute, $value, $fail) {
                $contains = $this->getGroupRuleAll();
                foreach ($value as $id) {
                    if (!$contains->contains($id)) {
                        return $fail('Danh sách nhóm quyền chứa không hợp lệ ');
                    }
                }
            }],
        ];
    }

    public function onValidateUpdate()
    {
        $groups = request()->groups;
        return [
            'name' => ['required', 'unique:users,name,' . request()->id, 'max:200'],
            'email' => ['required', 'unique:users,email,' . request()->id, 'max:200', 'email'],
            'password' => ['min:6', 'max:100'],
            'groups'  => [function ($attribute, $value, $fail) {
                $contains = $this->getGroupRuleAll();
                foreach ($value as $id) {
                    if (!$contains->contains($id)) {
                        return $fail('Danh sách nhóm quyền chứa không hợp lệ ');
                    }
                }
            }],
        ];
    }
}
