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
        $token = $user->createToken('user1')->plainTextToken;
        auth()->login();
        return response()->json([
            'token' => $token,
        ]);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password' => 'required|email',
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        auth()->login();
        return response([
            'token' =>$user->createToken($request->device_name)->plainTextToken,
            'user'=> $user
        ]) ;
    }
    public function logout(){
        auth()->user();
        $user->currentAccessToken()->delete();
        return response([
            'success' => true
        ]);
    }
  
}
