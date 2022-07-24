<?php

namespace App\Http\Controllers;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class Controller extends BaseController
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function saveUser(Request $request)
    {
        // REGISTRATION CONTROLLER
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        // generate a token for the user
        $token = $user->createToken('authToken')->plainTextToken;

        $response =[
            'user' => $user,
            'token' => $token
        ];

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function userLogin(Request $request)
    {
        // REGISTRATION CONTROLLER
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        // check email
        $user = User::where('email', $fields['email'])->first();
        // check password
        if(!$user ||  !Hash::check($fields['password'],$user->password) ){
            return response([
                'message'=>"Bad email or password",
            ],401);
        }
        // generate a token for the user
        $token = $user->createToken('authToken')->plainTextToken;
        $response =[
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }


    public function logout(Request $request){
        // logout the user
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
    
    
}
