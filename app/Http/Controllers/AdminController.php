<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Reports;
use App\Models\TourGuide;
use App\Models\TourismAgency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function Login(Request $request)
    {
        $admin = Admin::where(['email'=>$request->email])->first();
        if($admin && Hash::check($request->password, $admin->password))
        {
            $responseData = [
                'id' => $admin->id,
                'name'=> $admin->name,
                'email'=> $admin->email,
            ];
            return response()->json($responseData, 200);
        }
        return response()->json(['message' => "Unauthorized"], 401);
    }

    public function create(AdminRequest $request)    //register
    {
        if ($request->password !== $request->password_confirmation) {
            return response()->json(['message' => "Password and password confirmation do not match"], 400);
        }
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_confirmation' => Hash::make($request->password_confirmation),
        ]);
        $responseData = [
            'id' => $admin->id,
            'name'=> $admin->name,
            'email'=> $admin->email,
        ];
        return response()->json($responseData, 200);
    }

    public function deleteGuide($id)
    {
        $tourGuide = TourGuide::find($id);
        $tourGuide->guideRequests()->each(function ($request) {
            $request->rate()->delete();
            $request->delete();
        });
        $tourGuide->guideReports()->delete();
        $tourGuide->delete();
        return response()->json(['message' => "deleted successfully" ], 200);
    }
    public function deleteAgency($id)
    {
        $tourAgency = TourismAgency::find($id);
        $tourAgency->agencyRequests()->each(function ($request) {
            $request->rate()->delete();
            $request->delete();
        });
        $tourAgency->agencyReports()->delete();
        $tourAgency->delete();
        return response()->json(['message' => "deleted successfully" ], 200);
    }
    public function getAllReports()
    {
        $allReports = Reports::select('id','user_id', 'description', 'agency_id', 'guide_id')->get();
        return response()->json($allReports, 200);
    }
}
