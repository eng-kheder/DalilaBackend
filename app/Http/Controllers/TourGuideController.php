<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourGuideRequest;
use App\Models\TourGuide;
use Illuminate\Http\Request;
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
                'name' => $tourGuide->name,
                'city' => $tourGuide->city,
                'phone_number' => $tourGuide->phone_number,
                'email' => $tourGuide->email,
                'gender_guide' => $tourGuide->gender_guide,
                'age_guide' => $tourGuide->age_guide,
                'price_guide' => $tourGuide->price_guide,
                'language_guide' => $tourGuide->language_guide,
//                'guide_languages' => $tourGuide->guideLanguages->map(function ($guideLanguage) {
//                    return [
//                        'language_id' => $guideLanguage->language->id,
//                        'language_name' => $guideLanguage->language->language_name
//                    ];
//                }),
                'tour_guide_type' => $tourGuide->tourGuideType
            ];
            return response()->json($responseData, 200);
        }

        return response()->json(['message' => "Unauthorized"], 401);
    }

    public function create(TourGuideRequest $request)    //register
    {
            if ($request->password !== $request->password_confirmation) {
                return response()->json(['message' => "Password and password confirmation do not match"], 400);
            }

            $tourGuide = TourGuide::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_confirmation' => Hash::make($request->password_confirmation),
                'city' => $request->city,
                'phone_number' => $request->phone_number,
                'type_id'=>2,
                'gender_guide' => $request->gender_guide,
                'age_guide' => $request->age_guide,
                'price_guide' => $request->price_guide,
                'language_guide' => $request->language_guide,
            ]);
            $tourGuide->tourGuideType()->associate($tourGuide->type_id);
        $tourGuide->save();

        // Loop through the languages and associate them with the TourGuide
//        foreach ($request->languages as $languageId) {
//            $tourGuide->guideLanguages()->create([
//                'language_id' => $languageId
//            ]);
//        }

        //output
        $responseData = [
            'id' => $tourGuide->id,
            'name' => $tourGuide->name,
            'city' => $tourGuide->city,
            'phone_number' => $tourGuide->phone_number,
            'email' => $tourGuide->email,
            'gender_guide' => $tourGuide->gender_guide,
            'age_guide' => $tourGuide->age_guide,
            'price_guide' => $tourGuide->price_guide,
            'language_guide' => $tourGuide->language_guide,
//            'guide_languages' => $tourGuide->guideLanguages->map(function ($guideLanguage) {
//                return [
//                    'language_id' => $guideLanguage->language->id,
//                    'language_name' => $guideLanguage->language->language_name
//                ];
//            }),
            'tour_guide_type' => $tourGuide->tourGuideType
        ];

        return response()->json($responseData, 200);
    }

    public function getAllGuides()  //index
    {
        $allGuides = TourGuide::select('id','name','email', 'city','phone_number','gender_guide','age_guide','price_guide','language_guide' )->get();
        return response()->json($allGuides, 200);
    }

    public function getGuide($id)  //show
    {
        $guide = TourGuide::select('id','name','email', 'city','phone_number','gender_guide','age_guide','price_guide','language_guide' )->find($id);
        return response()->json($guide, 200);
    }



}
