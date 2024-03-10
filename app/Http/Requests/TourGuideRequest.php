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
                 'name'=> 'required|max:50',
                 'city'=> 'required|max:50 ',
                 'gender_guide'=> 'required ',
                 'age_guide'=> 'required ',
                 'price_guide'=> 'required ',
                 'language_guide'=>'required|max:255 ',
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
