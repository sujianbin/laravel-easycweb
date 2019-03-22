<?php

namespace App\Http\Requests\SystemRight;

use Illuminate\Foundation\Http\FormRequest;

class StoreSystemRight extends FormRequest
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
            'name'=>'required',
            'group'=>'required',
            'order_id'=>'integer|min:1|max:999999',
            'right'=>'required|array',
        ];
    }


    public function messages()
    {
        return [
            'name.required'=>'资源名称不能为空',
            'group.required'=>'分组名称不能为空',
            'order_id.min'=>'权重不能小于1',
            'order_id.max'=>'权重必须在1-999999',
            'right.required'=>'权限码不能为空'
        ];
    }
}
