<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        $rules = [
            'description' => 'required'
        ];

        if (request('id','')) {
            $rules['name'] = 'required|unique:permissions,name,'.$this->id;
            $rules['display_name'] = 'required|unique:permissions,display_name,'.$this->id;
        }else{
            $rules['name'] = 'required|unique:permissions,name';
            $rules['display_name'] = 'required|unique:permissions,display_name';
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required'     =>  '权限节点不能为空',
            'name.unique'       =>  '该权限节点已存在',
            'display_name.required' => '权限名称不能为空',
            'display_name.unique' => '该权限名称已存在',
            'description.required'  =>  '权限介绍不能为空'
        ];
    }
}
