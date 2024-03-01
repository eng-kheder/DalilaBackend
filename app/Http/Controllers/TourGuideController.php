<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourGuideRequest;
use App\Models\TourGuide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TourGuideController extends Controller
{

    public function Login(Request $request)
    {
        $tourGuide = TourGuide::where(['email'=>$request->email])->first();
        if($tourGuide && Hash::check($request->password, $tourGuide->password))
        {
            $responseData = [
                'id' => $tourGuide->id,
                'guide_name' => $tourGuide->guide_name,
                'city' => $tourGuide->city,
                'phone_number' => $tourGuide->phone_number,
                'email' => $tourGuide->email,
                'gender' => $tourGuide->gender,
                'age' => $tourGuide->age,
                'price' => $tourGuide->price,
                'guide_languages' => $tourGuide->guideLanguages->map(function ($guideLanguage) {
                    return [
                        'language_id' => $guideLanguage->language->id,
                        'language_name' => $guideLanguage->language->language_name
                    ];
                }),
                'tour_guide_type' => $tourGuide->tourGuideType
            ];
            return response()->json($responseData, 200);
        }

        return response()->json(['message' => "Unauthorized"], 401);
    }

    public function create(TourGuideRequest $request)    //register
    {
            if ($request->password !== $request->password_confirmation) {
                return response()->json("Password and password confirmation do not match", 400);
            }

            $tourGuide = TourGuide::create([
                'guide_name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_confirmation' => Hash::make($request->password_confirmation),
                'city' => $request->city,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'age' => $request->age,
                'price' => $request->price,
//            'type_id'=> $request->type,
            ]);
            $tourGuide->tourGuideType()->associate($request->type);
        $tourGuide->save();

        // Loop through the languages and associate them with the TourGuide
        foreach ($request->languages as $languageId) {
            $tourGuide->guideLanguages()->create([
                'language_id' => $languageId
            ]);
        }

        //output
        $responseData = [
            'id' => $tourGuide->id,
            'guide_name' => $tourGuide->guide_name,
            'city' => $tourGuide->city,
            'phone_number' => $tourGuide->phone_number,
            'email' => $tourGuide->email,
            'gender' => $tourGuide->gender,
            'age' => $tourGuide->age,
            'price' => $tourGuide->price,
            'guide_languages' => $tourGuide->guideLanguages->map(function ($guideLanguage) {
                return [
                    'language_id' => $guideLanguage->language->id,
                    'language_name' => $guideLanguage->language->language_name
                ];
            }),
            'tour_guide_type' => $tourGuide->tourGuideType
        ];

        return response()->json($responseData, 200);        }


}
