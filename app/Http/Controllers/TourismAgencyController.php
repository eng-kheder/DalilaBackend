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
                'name' => $tourismAgency->name,
                'city' => $tourismAgency->city,
                'phone_number' => $tourismAgency->phone_number,
                'email' => $tourismAgency->email,
                'location_agency' => $tourismAgency->location_agency,
                'commercial_record_agency' => $tourismAgency->commercial_record_agency,
                'price_agency' => $tourismAgency->price_agency,
                'language_agency' => $tourismAgency->language_agency,

//                'agencyLanguages' => $tourismAgency->agencyLanguages->map(function ($agencyLanguage) {
//                    return [
//                        'language_id' => $agencyLanguage->language->id,
//                        'language_name' => $agencyLanguage->language->language_name
//                    ];
//                }),
                'tourism_agency_type' => $tourismAgency->tourismAgencyType
            ];
            return response()->json($responseData, 200);
        }

        return response()->json(['message' => "Unauthorized"], 401);
    }

    public function create(TourismAgencyRequest $request)    //register
    {
            if ($request->password !== $request->password_confirmation) {
                return response()->json(['message' => "Password and password confirmation do not match"], 400);
            }

        $tourismAgency = TourismAgency::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_confirmation' => Hash::make($request->password_confirmation),
                'city' => $request->city,
                'phone_number' => $request->phone_number,
                 'type_id'=>3,
            'location_agency' => $request->location_agency,
            'commercial_record_agency' => $request->commercial_record_agency,
            'price_agency' => $request->price_agency,
            'language_agency' => $request->language_agency,
            ]);
        $tourismAgency->tourismAgencyType()->associate($tourismAgency->type_id);
        $tourismAgency->save();

//        // Loop through the languages and associate them with the TourGuide
//        foreach ($request->languages as $languageId) {
//            $tourismAgency->agencyLanguages()->create([
//                'language_id' => $languageId
//            ]);
//        }

        //output
        $responseData = [
            'id' => $tourismAgency->id,
            'name' => $tourismAgency->name,
            'city' => $tourismAgency->city,
            'phone_number' => $tourismAgency->phone_number,
            'email' => $tourismAgency->email,
            'location_agency' => $tourismAgency->location_agency,
            'commercial_record_agency' => $tourismAgency->commercial_record_agency,
            'price_agency' => $tourismAgency->price_agency,
            'language_agency' => $tourismAgency->language_agency,

//            'agencyLanguages' => $tourismAgency->agencyLanguages->map(function ($agencyLanguage) {
//                return [
//                    'language_id' => $agencyLanguage->language->id,
//                    'language_name' => $agencyLanguage->language->language_name
//                ];
//            }),
            'tourism_agency_type' => $tourismAgency->tourismAgencyType
        ];

        return response()->json($responseData, 200);
    }

    public function update(Request $request, $id)
    {
        $tourAgency = TourismAgency::find($id);
        $tourAgency->update($request->all());
        return response()->json(['message' => "updated successfully"], 200);
    }

    public function getAllAgencies()  //index
    {
        $allAgencies = TourismAgency::select('id','name','email', 'city','phone_number','location_agency','commercial_record_agency','price_agency','language_agency' )->get();
        return response()->json($allAgencies, 200);
    }

    public function getAgency($id)  //show
    {
        $agency = TourismAgency::select('id','name','email', 'city','phone_number','location_agency','commercial_record_agency','price_agency','language_agency' )->find($id);
        return response()->json($agency, 200);
    }

    public function getAgencyRequests($agencyId)
    {
        $agency = TourismAgency::find($agencyId);
        $agencyRequests=$agency->agencyRequests;
        return response()->json($agencyRequests, 200);
    }
    public function getAgencyRates($agencyId)
    {
        $agency = TourismAgency::find($agencyId);
        $agencyRates=$agency->agencyRequests->pluck('rate');
        return response()->json($agencyRates, 200);
    }


}

