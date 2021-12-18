<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'password' => 'required'
        ]);

        $user = User::where([
            'user_name' => $request->user_name,
            'password' => md5($request->password)
        ])->first();

        if(!$user) {
            return response([
                'message' => 'Invalid Credentials'
            ]);
        }
        Auth::login($user);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user' => auth()->user(),
            'access_token' => $accessToken
        ]);
    }


}
