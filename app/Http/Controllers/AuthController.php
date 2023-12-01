<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response(['token' => $request->user()->createToken('log')->plainTextToken], 200);
        }
        return response('Not Authorized', 403);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response('Token Revoked', 200);
    }
}