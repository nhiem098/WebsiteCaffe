<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function updateTokenFirebase(Request $request){
        $userId = $request->get('user_id', null);
        $token = $request->get('token', null);
        if(!$token){
            return response()->json([
                'code'  => 422,
                'status' => 'error',
                'message' => 'The token field is required.',
            ], 422);
        }
        if($userId){
            $user = User::find($userId);
            if($user){
                $user->update([
                    'token_firebase' => $token
                ]);
                return response()->json([
                    'code'  => 200,
                    'status' => 'success',
                    'message' => 'Update token firebase successfully.',
                ], 200);
            }else{
                return response()->json([
                    'code'  => 400,
                    'status' => 'failed',
                    'message' => 'User not found.',
                ], 400);
            }
        }else{
            return response()->json([
                'code'  => 422,
                'status' => 'error',
                'message' => 'The user_id field is required.',
            ], 422);
        }
    }
}
