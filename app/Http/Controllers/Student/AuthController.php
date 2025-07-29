<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Http\Requests\Student\StudentLoginRequest;
use App\Http\Requests\Student\StudentRegisterRequest;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('student.auth.register');
    }

    public function register(StudentRegisterRequest $request)
    {
        $data = $request->validated();
           
        $student = Student::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('student_web')->login($student);
        return redirect()->route('student.dashboard');
    }

    public function showLoginForm()
    {
        return view('student.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('student_web')->attempt($credentials)) {
            return redirect()->route('student.dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::guard('student_web')->logout();
        return redirect()->route('student.login');
    }
}
