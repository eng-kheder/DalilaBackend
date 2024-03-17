<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
             return [
                 'name'=> 'required|max:50',
                 'password' => 'required|max:50',
                 'password_confirmation' => 'required|max:50',
                 'email' => [
                     'required',
                     ' max:50',
                     'unique:admins,email'
                 ],
             ];
    }

}
