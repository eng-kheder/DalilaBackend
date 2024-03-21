<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Requests;
use App\Models\TourGuide;
use App\Models\TourismAgency;
use App\Models\User;
use App\Models\UsersType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function Login(Request $request)
    {
        $user = User::where(['email'=>$request->email])->first();
        if($user && Hash::check($request->password, $user->password))
        {
            $responseData = [
                'id' => $user->id,
                'name' => $user->name,
                'city' => $user->city,
                'phone_number' => $user->phone_number,
                'email' => $user->email,
                'gender_user' => $user->gender_user,
                'age_user' => $user->age_user,
                'user_type' => $user->userType,
                'created_at'=> $user->created_at_formatted ,
                'updated_at'=> $user->updated_at_formatted  ,
            ];
            return response()->json($responseData, 200);
        }

        return response()->json(['message' => "Unauthorized"], 401);

    }

    public function create(UserRequest $request)    //register
    {
        if ($request->password !== $request->password_confirmation) {
            return response()->json(['message' => "Password and password confirmation do not match"], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_confirmation' => Hash::make($request->password_confirmation),
            'city' => $request->city,
            'phone_number'=> $request->phone_number,
            'gender_user'=> $request->gender_user,
            'age_user'=> $request->age_user,
            'type_id'=> 1 ,



        ]);
        $user->userType()->associate($user->type_id);
        $user->save();

        $responseData = [
            'id' => $user->id,
            'name' => $user->name,
            'city' => $user->city,
            'phone_number' => $user->phone_number,
            'email' => $user->email,
            'gender_user' => $user->gender_user,
            'age_user' => $user->age_user,
            'user_type' => $user->userType,
            'created_at'=> $user->created_at_formatted ,
            'updated_at'=> $user->updated_at_formatted  ,
        ];
        return response()->json($responseData, 200);
    }

    public function getUser($id)  //show
    {
        $user = User::find($id);
        $user = [
            'id' => $user->id,
            'name' => $user->name,
            'city' => $user->city,
            'phone_number' => $user->phone_number,
            'email' => $user->email,
            'gender_user' => $user->gender_user,
            'age_user' => $user->age_user,
            'user_type' => $user->userType,
            'created_at'=> $user->created_at_formatted ,
            'updated_at'=> $user->updated_at_formatted  ,
            ];
        return response()->json($user, 200);
    }

    public function search($name)
    {

        $guides = TourGuide::where('name','like', '%'.$name.'%')->get();
        $formattedGuides = [];
        foreach ($guides as $guide) {
            $formattedGuides[] = [
                'id' => $guide->id,
                'name' => $guide->name,
                'city' => $guide->city,
                'phone_number' => $guide->phone_number,
                'email' => $guide->email,
                'gender_guide' => $guide->gender_guide,
                'age_guide' => $guide->age_guide,
                'price_guide' => $guide->price_guide,
                'language_guide' => $guide->language_guide,
                'tour_guide_type' => $guide->tourGuideType,
                'created_at' => $guide->created_at_formatted,
                'updated_at' => $guide->updated_at_formatted,
                'averageRate'=> (new TourGuideController)->getAvgGuideRates( $guide->id)->original,

            ];
        }
        $agencies = TourismAgency::where('name','like', '%'.$name.'%')->get();
        $formattedAgencies = [];
        foreach ($agencies as $tourismAgency) {
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
                'averageRate'=> (new TourismAgencyController())->getAvgAgencyRates( $tourismAgency->id)->original,

            ];
        }
        $dataArray = ['guides' => $formattedGuides, 'agencies' => $formattedAgencies];
        return response()->json($dataArray, 200);
    }

    public function getUserRequests($userId)
    {
        $user = User::find($userId);
        $userRequests=$user->userRequests;
        $formattedUserRequests = [];
        foreach ($userRequests as $userRequest) {
            $formattedUserRequests[] = [
                'id'=> $userRequest->id,
                'user_id' => User::find($userRequest->user_id) ? (new UserController())->getUser($userRequest->user_id)->original: null,
                'status'=> $userRequest->status,
                'guide_id'=> TourGuide::find($userRequest->guide_id) ? (new TourGuideController())->getGuide($userRequest->guide_id)->original: null,
                'agency_id'=> TourismAgency::find($userRequest->agency_id) ? (new TourismAgencyController())->getAgency($userRequest->agency_id)->original: null,
                'request_date'=>$userRequest->request_date,
                'created_at'=>$userRequest->created_at_formatted,
            ];
        }
        return response()->json($formattedUserRequests, 200);
    }



}
