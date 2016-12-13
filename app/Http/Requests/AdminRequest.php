<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        if (request('id','')) {
            $rules['name'] = 'required|unique:admins,name,'.$this->id;
            $rules['email'] = 'required|email|unique:admins,email,'.$this->id;
            $rules['password'] = 'max:20|min:6';
        }else{
            $rules['name'] = 'required|unique:admins,name';
            $rules['email'] = 'required|email|unique:admins,email';
            $rules['password'] = 'required|max:20|min:6';
        }

        return $rules;
    }
}
