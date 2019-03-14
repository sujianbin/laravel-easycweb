<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmin extends FormRequest
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
            'username'=>'required',
            'realname'=>'required',
            'role_id'=>'required|Numeric',
        ];
    }

    public function messages()
    {
        return [
            'username.required'=>'用户名称不能为空',
            'realname.required'=>'真实姓名不能为空',
            'role_id.required'=>'请选择对应角色',
            'role_id.Numeric'=>'请选择对应角色'
        ];
    }
}
