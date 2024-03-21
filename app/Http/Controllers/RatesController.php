<?php

namespace App\Http\Controllers;

use App\Models\Rates;
use App\Http\Requests\RateRequest;
use Illuminate\Http\Request;


class RatesController extends Controller
{
//    public function create(RateRequest $req)  // add rate
//    {
//
//        $rate = Rates::create([
//            'user_id'=> $req->user_id,
//            'request_id'=> $req->request_id,
//            'description'=> $req->description,
//            'value'=> $req->value,
//        ]);
//        return response()->json(['message' => "created successfully" ], 200);
//    }

    public function create(RateRequest $req) // add rate
    {
        $existingRate = Rates::where('user_id', $req->user_id)
            ->where('request_id', $req->request_id)
            ->first();

        if ($existingRate) {
            $existingRate->update([
                'description' => $req->description,
                'value' => $req->value,
            ]);
        } else {
            $rate = Rates::create([
                'user_id' => $req->user_id,
                'request_id' => $req->request_id,
                'description' => $req->description,
                'value' => $req->value,
            ]);
        }

        return response()->json(['message' => "created successfully" ], 200);
    }

}
