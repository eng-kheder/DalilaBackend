<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourismAgencyRequest;
use App\Models\TourismAgency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TourismAgencyController extends Controller
{
    public function Login(Request $request)
    {
        $tourismAgency = TourismAgency::where(['email'=>$request->email])->first();
        if($tourismAgency && Hash::check($request->password, $tourismAgency->password))
        {
            $responseData = [
                'id' => $tourismAgency->id,
                'agency_name' => $tourismAgency->agency_name,
                'city' => $tourismAgency->city,
                'phone_number' => $tourismAgency->phone_number,
                'email' => $tourismAgency->email,
                'location' => $tourismAgency->location,
                'commercial_record' => $tourismAgency->commercial_record,
                'price' => $tourismAgency->price,
                'agencyLanguages' => $tourismAgency->agencyLanguages->map(function ($agencyLanguage) {
                    return [
                        'language_id' => $agencyLanguage->language->id,
                        'language_name' => $agencyLanguage->language->language_name
                    ];
                }),
                'tourism_agency_type' => $tourismAgency->tourismAgencyType
            ];
            return response()->json($responseData, 200);
        }

        return response()->json(['message' => "Unauthorized"], 401);
    }

    public function create(TourismAgencyRequest $request)    //register
    {
            if ($request->password !== $request->password_confirmation) {
                return response()->json("Password and password confirmation do not match", 400);
            }

        $tourismAgency = TourismAgency::create([
                'agency_name' => $request->agency_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_confirmation' => Hash::make($request->password_confirmation),
                'city' => $request->city,
                'phone_number' => $request->phone_number,
                'location' => $request->location,
                'commercial_record' => $request->commercial_record,
                'price' => $request->price,
                 'type_id'=>3,
            ]);
        $tourismAgency->tourismAgencyType()->associate($tourismAgency->type_id);
        $tourismAgency->save();

        // Loop through the languages and associate them with the TourGuide
        foreach ($request->languages as $languageId) {
            $tourismAgency->agencyLanguages()->create([
                'language_id' => $languageId
            ]);
        }

        //output
        $responseData = [
            'id' => $tourismAgency->id,
            'agency_name' => $tourismAgency->agency_name,
            'city' => $tourismAgency->city,
            'phone_number' => $tourismAgency->phone_number,
            'email' => $tourismAgency->email,
            'location' => $tourismAgency->location,
            'commercial_record' => $tourismAgency->commercial_record,
            'price' => $tourismAgency->price,
            'agencyLanguages' => $tourismAgency->agencyLanguages->map(function ($agencyLanguage) {
                return [
                    'language_id' => $agencyLanguage->language->id,
                    'language_name' => $agencyLanguage->language->language_name
                ];
            }),
            'tourism_agency_type' => $tourismAgency->tourismAgencyType
        ];

        return response()->json($responseData, 200);        }

}

