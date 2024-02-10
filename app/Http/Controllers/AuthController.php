<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function register(Request $request){
        $data= $request->validate([
                    'name'=> 'required|string',
                    'email'=> 'required|email|string|unique:users,email',
                    'password' => [
                        'required',
                        'confirmed',
                        Password::min(8)->mixedCase()->numbers()->symbols(),
                    ]
                ]);
    }
}
