<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

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
        $token = $user->createToken('main')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
  
}
