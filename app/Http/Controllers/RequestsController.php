<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use App\Http\Requests\RequestRequest;
use Illuminate\Http\Request;


class RequestsController extends Controller
{

    public function delete($id) //cancel request
    {
        $request = Requests::find($id);
        if ($request->status==1)
            return response()->json(['message' => "deleted fails"], 400);
        $request->rate()->delete();
        $request->delete();
        return response()->json(['message' => "deleted successfully" ], 200);
    }

   public function create(RequestRequest $req)  // add request
    {
        $request = Requests::create([
            'user_id'=> $req->user_id,
            'guide_id'=> $req->guide_id,
            'agency_id'=> $req->agency_id,
            'request_date'=> $req->request_date,
        ]);
        return response()->json(['message' => "created successfully" ], 200);
    }

    public function updateRequestStatus(Request $req)  // update request status
    {
        $request = Requests::find($req->id);
        $request->update([
            'status'=> $req->status,
        ]);
        return response()->json(['message' => "updated successfully"], 200);
    }

}
