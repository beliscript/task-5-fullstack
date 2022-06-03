<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PassportAuthController extends Controller
{
    public function login(UserLoginRequest $request) {
        $data = [
                'email' => $request->email,
                'password' => $request->password
        ];
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function userInfo()
    {
        $user = auth()->user();
        return response()->json(['user' => $user], 200);
    }
    public function logout()
    {
        if (auth()->check()) {
            $token = auth()->user()->token();
            $token->revoke();
            return response()->json([
                'status' => true,
                'message' => 'berhasil logout',
            ], 200);
        } 
        else{ 
            return response()->json([
                'status' => false,
                'message' => 'gagal logout',
            ], 401);
        } 
    }
}