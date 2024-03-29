<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
             return [
                 'name'=> 'required|max:50',
                 'city'=> 'required|max:50 ',
                 'gender_user'=> 'required ',
                 'age_user'=> 'required ',
                 'password' => 'required|max:50',
                 'password_confirmation' => 'required|max:50',
                 'phone_number' => [
                     'required',
                    ' max:50',
                     'unique:users,phone_number'
                 ],
                 'email' => [
                     'required',
                     ' max:50',
                     'unique:users,email'
                 ],
             ];
    }

}
