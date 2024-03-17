<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
             return [
                 'user_id'=> 'required',
                 'request_id'=> 'required',
                 'description'=> 'required',
                 'value'=> 'required',
             ];
    }

}
