<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
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
                'user_name' => $user->user_name,
                'city' => $user->city,
                'phone_number' => $user->phone_number,
                'email' => $user->email,
                'gender' => $user->gender,
                'age' => $user->age,
                'user_type' => $user->userType
            ];
            return response()->json($responseData, 200);
        }

        return response()->json(['message' => "Unauthorized"], 401);

    }

    public function create(UserRequest $request)    //register
    {
        if ($request->password !== $request->password_confirmation) {
            return response()->json("Password and password confirmation do not match", 400);
        }

        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_confirmation' => Hash::make($request->password_confirmation),
            'city' => $request->city,
            'phone_number'=> $request->phone_number,
            'gender'=> $request->gender,
            'age'=> $request->age,
            'type_id'=> 1 ,


        ]);
        $user->userType()->associate($user->type_id);
        $user->save();

        $responseData = [
            'id' => $user->id,
            'user_name' => $user->user_name,
            'city' => $user->city,
            'phone_number' => $user->phone_number,
            'email' => $user->email,
            'gender' => $user->gender,
            'age' => $user->age,
            'user_type' => $user->userType
        ];
        return response()->json($responseData, 200);
    }

}
