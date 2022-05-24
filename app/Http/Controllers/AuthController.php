<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request){
        // return User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'phone' => $input['phone'],
        //     'address'=> $input['address'],
        //     'password' => Hash::make($input['password']),
        // ]);

        $validation = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('myAppToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ],200);
    }


    public function login(Request $request){
        $validation = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $user = User::where('email',$request->email)->first();

        if(empty($user) || !Hash::check($request->password,$user->password)){
            return response()->json([
                'message' => 'Credential Do Not Match.....'
            ],200);
        }

        $token = $user->createToken('myAppToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ],200);

    }


    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout Success...',
        ],200);
    }
}