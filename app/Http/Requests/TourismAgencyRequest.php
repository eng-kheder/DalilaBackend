<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourismAgencyRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
             return [
                 'agency_name'=> 'required|max:50',
                 'city'=> 'required|max:50 ',
                 'location'=> 'required|max:50 ',
                 'price'=> 'required ',
                 'password' => 'required|max:255',
                 'password_confirmation' => 'required|max:255',
                 'phone_number' => [
                     'required',
                    ' max:50',
                     'unique:tourism_agencies,phone_number'
                 ],
                 'email' => [
                     'required',
                     ' max:50',
                     'unique:tourism_agencies,email'
                 ],
                 'commercial_record' => [
                     'required',
                     ' max:50',
                     'unique:tourism_agencies,email'
                 ],
             ];
    }

}
