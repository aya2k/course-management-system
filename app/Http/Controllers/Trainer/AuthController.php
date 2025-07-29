<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('trainer.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('trainer_web')->attempt($credentials)) {
            return redirect()->route('trainer.dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('trainer_web')->logout();
        return redirect()->route('trainer.login');
    }
}
