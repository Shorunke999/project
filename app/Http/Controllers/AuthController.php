<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function register(Request $request){
      
       $data= $request->validate([
                    'name'=> 'required|string',
                    'email'=> 'required|email|string|unique:users,email',
                    'password' => [
                        'required',
                        'confirmed',
                        //Password::min(8)->mixedCase()->numbers()->symbols(),
                    ]
                ]);
        
        $user = \App\Models\User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password'=> Hash::make($request->password),

        ]);
        $token = $user->createToken('user')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
        ]);
    }
    public function login(Request $request){
        $data = $request->validate([
            'email'=> 'required|email|string|exists:users,email',
            'password' => 'required',
            //'remember' => 'boolean'
        ]);
        //$credentials = $data['remember'] ?? false;
        //unset($credentials['remember']);
        if(!Auth::attempt($data/*, $credentials*/)){
            return response()->json([
                'errorData'=> 'Invalid credentials'
            ],422);
        }
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
    public function logout(){
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response([
            'success' => true
        ]);
    }
  
}
