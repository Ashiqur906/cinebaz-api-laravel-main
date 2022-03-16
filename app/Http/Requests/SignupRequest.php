<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SignupRequest extends FormRequest
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
    public function rules(Request $request)
    {
      
        $rules = [
            'name'      => 'required',
            'password'  => 'required|max:191|min:6',
            'password_confirmation' => 'required_with:password|same:password',
            'gender' => 'nullable|max:10',
        ];


        if($request->phone){
            $rules['phone'] = 'required|string|unique:members,phone|regex:/(1)[0-9]{9}/|max:11|min:10';
            $rules['country_code'] = 'required|string';
            $rules['email'] = 'nullable|email|max:255|unique:members,email';
        }else{
            $rules['email'] = 'required|email|max:255|unique:members,email';
        }

        return $rules;

    }

}
