<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourismAgencyRequest;
use App\Models\TourGuide;
use App\Models\TourismAgency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Nette\Utils\isEmpty;

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
                'tourism_agency_type' => $tourismAgency->tourismAgencyType,
                'created_at'=> $tourismAgency->created_at_formatted ,
                'updated_at'=> $tourismAgency->updated_at_formatted ,
                'averageRate'=> $this->getAvgAgencyRates( $tourismAgency->id)->original,

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
            'tourism_agency_type' => $tourismAgency->tourismAgencyType,
            'created_at'=> $tourismAgency->created_at_formatted ,
            'updated_at'=> $tourismAgency->updated_at_formatted ,
            'averageRate'=> $this->getAvgAgencyRates( $tourismAgency->id)->original,

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
        $allAgencies = TourismAgency::get();
        $formattedAgencies = [];
        foreach ($allAgencies as $tourismAgency) {
            $formattedAgencies[] = [
                'id' => $tourismAgency->id,
                'name' => $tourismAgency->name,
                'city' => $tourismAgency->city,
                'phone_number' => $tourismAgency->phone_number,
                'email' => $tourismAgency->email,
                'location_agency' => $tourismAgency->location_agency,
                'commercial_record_agency' => $tourismAgency->commercial_record_agency,
                'price_agency' => $tourismAgency->price_agency,
                'language_agency' => $tourismAgency->language_agency,
                'tourism_agency_type' => $tourismAgency->tourismAgencyType,
                'created_at'=> $tourismAgency->created_at_formatted ,
                'updated_at'=> $tourismAgency->updated_at_formatted ,
                'averageRate'=> $this->getAvgAgencyRates( $tourismAgency->id)->original,

            ];
        }
        return response()->json($formattedAgencies, 200);
    }

    public function getAgency($id)  //show
    {
        $tourismAgency = TourismAgency::find($id);
        $tourismAgency = [
            'id' => $tourismAgency->id,
            'name' => $tourismAgency->name,
            'city' => $tourismAgency->city,
            'phone_number' => $tourismAgency->phone_number,
            'email' => $tourismAgency->email,
            'location_agency' => $tourismAgency->location_agency,
            'commercial_record_agency' => $tourismAgency->commercial_record_agency,
            'price_agency' => $tourismAgency->price_agency,
            'language_agency' => $tourismAgency->language_agency,
            'tourism_agency_type' => $tourismAgency->tourismAgencyType,
            'created_at'=> $tourismAgency->created_at_formatted ,
            'updated_at'=> $tourismAgency->updated_at_formatted ,
            'averageRate'=> $this->getAvgAgencyRates( $tourismAgency->id)->original,

        ];
        return response()->json($tourismAgency, 200);
    }

    public function getAgencyRequests($agencyId)
    {
        $agency = TourismAgency::find($agencyId);
        $agencyRequests = $agency->agencyRequests;

        if ($agencyRequests->isEmpty()) {
            $formattedAgencyRequests = [];
        } else {
            $formattedAgencyRequests = [];
            foreach ($agencyRequests as $agencyRequest) {
                $rate = $agencyRequest->rate;

                $formattedAgencyRequests[] = [
                    'id' => $agencyRequest->id,
                    'user_id' => User::find($agencyRequest->user_id) ? (new UserController())->getUser($agencyRequest->user_id)->original : null,
                    'status' => $agencyRequest->status,
                    'guide_id' => TourGuide::find($agencyRequest->guide_id) ? (new TourGuideController())->getGuide($agencyRequest->guide_id)->original : null,
                    'agency_id' => TourismAgency::find($agencyRequest->agency_id) ? (new TourismAgencyController())->getAgency($agencyRequest->agency_id)->original : null,
                    'request_date' => $agencyRequest->request_date,
                    'created_at' => $agencyRequest->created_at_formatted,
                    'request_rate' => $rate ? [
                        'id' => $rate->id,
                        'user_id' => $rate->user_id,
                        'request_id' => $rate->request_id,
                        'description' => $rate->description,
                        'value' => $rate->value,
                    ] : null,
                ];
            }
        }
        return response()->json($formattedAgencyRequests, 200);
    }
    public function getAgencyRates($agencyId)
    {
        $agency = TourismAgency::find($agencyId);
        $agencyRequests=$agency->agencyRequests;
            $agencyRates = $agency->agencyRequests->pluck('rate');
        return response()->json($agencyRates, 200);
    }
    public function getAvgAgencyRates($agencyId)
    {
        $agency = TourismAgency::find($agencyId);
        $agencyRequests=$agency->agencyRequests->where('status',1);
        $agencyRates =  $agencyRequests->pluck('rate')->filter(function ($rate) {
            return !is_null($rate) && !is_null($rate->value);
        });
        $agencyRatesCount = count($agencyRates);
        $agencyRatesValues = 0;
        foreach ($agencyRates as $agencyRate) {
            if (isset($agencyRate['value'])) {
                $agencyRatesValues += $agencyRate['value'];
            }
        }
        if ($agencyRatesCount > 0) {
            $averageValue = $agencyRatesValues / $agencyRatesCount;
        } else {
            $averageValue = 0;
        }
        return response()->json($averageValue, 200);
    }

}

