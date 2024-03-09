<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourGuideRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
             return [
                 'guide_name'=> 'required|max:50',
                 'city'=> 'required|max:50 ',
                 'gender'=> 'required ',
                 'age'=> 'required ',
                 'price'=> 'required ',
                 'password' => 'required|max:255',
                 'password_confirmation' => 'required|max:255',
                 'phone_number' => [
                     'required',
                    ' max:50',
                     'unique:tour_guides,phone_number'
                 ],
                 'email' => [
                     'required',
                     ' max:50',
                     'unique:tour_guides,email'
                 ],
             ];
    }

}
