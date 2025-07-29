<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TrainerAuthController extends Controller
{

 public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

   
    if (!$token = Auth::guard('api_trainer')->attempt($credentials)) {
        return response()->json(['error' => 'Invalid email or password'], 401);
    }

    
    $expiresAt = Carbon::now()
        ->addMinutes(config('jwt.ttl', 60)) 
        ->format('Y-m-d H:i:s');

    return response()->json([
        'message' => 'Login success!',
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_at' => $expiresAt,
    ]);
}

public function logout()
{
    auth('api_trainer')->logout();

    return response()->json([
        'message' => 'Logout successful'
    ]);
}


}
