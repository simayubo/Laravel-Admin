<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            $rules['name'] = 'required|unique:roles,name,'.$this->id;
            $rules['display_name'] = 'required|unique:roles,display_name,'.$this->id;
        }else{
            $rules['name'] = 'required|unique:roles,name';
            $rules['display_name'] = 'required|unique:roles,display_name';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'     =>  '角色不能为空',
            'name.unique'       =>  '该角色已存在',
            'display_name.required' => '角色名称不能为空',
            'display_name.unique' => '该角色名称已存在',
            'description.required'  =>  '角色介绍不能为空'
        ];
    }
}
