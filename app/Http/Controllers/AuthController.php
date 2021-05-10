<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (! $token = Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'code'      =>  '401',
                'status'    =>  'failed',
                'message'   => 'These credentials do not match our records.',
            ]);
        }
        Auth::user()->update([
            'remember_token' => $token,
        ]);
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        if (Auth::check()) {
            User::find(Auth::user()->id)->update(['remember_token' => null]);
            Auth::logout();
            return response()->json([   
                'status'    =>  'success',
                'code'      =>  '200',
                'message'   =>  'Logout successfully'
            ]);
        }else{
            return response()->json([   
                'code'      =>  403,
                'status'    =>  'failed',
                'message'   =>  'You are not logged in, so you cannot log out.'
            ],403);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
