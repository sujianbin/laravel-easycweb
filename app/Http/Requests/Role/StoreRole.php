<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class StoreRole extends FormRequest
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
            'role_name'=>'required',
            'role_description'=>'required',
            'right'=>'required|array',
        ];
    }

    public function messages()
    {
        return [
            'role_name.required'=>'角色名称不能为空',
            'role_description.required'=>'角色描述不能为空',
            'right.required'=>'请选择对应权限'
        ];
    }
}
