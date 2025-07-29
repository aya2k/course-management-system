<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentTransactions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CoursesResource;
use App\Http\Resources\StudentResource;
use App\Http\Requests\Student\StudentRegisterRequest;

class StudentAuthController extends Controller
{
   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

   
    if (!$token = Auth::guard('api_student')->attempt($credentials)) {
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



       
 
    
     public function register(StudentRegisterRequest $request)
{
    $data = $request->validated();
       
    $student = Student::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']), 
    ]);

    $token = auth()->guard('api_student')->login($student);

    $expiresAt = Carbon::now()->addMinutes(config('jwt.ttl', 60))->format('Y-m-d H:i:s');

    return response()->json([
        'message' => 'Register Successfully!',
        'student'=> new StudentResource($student),
        'access_token' => $token,
        'expires_at' => $expiresAt,
    ]);
}


       
 public function enroll(Course $course)
{
    $studentId = auth('api_student')->id();

    // Check if already enrolled
    $alreadyEnrolled = StudentTransactions::where('student_id', $studentId)
        ->where('course_id', $course->id)
        ->exists();

    if ($alreadyEnrolled) {
        return response()->json([
            'error' => 'You are already enrolled in this course.'
        ], 409); 
    }

    // Create enrollment
    $transaction = StudentTransactions::create([
        'student_id' => $studentId,
        'course_id' => $course->id,
        'status' => 'approved',
    ]);

    return response()->json([
        'message' => 'Enrollment successful',
        'enrollment' => $transaction,
    ], 201); // 201 Created
}


public function lessons(Course $course)
{
    $studentId = auth('api_student')->id();

    $isEnrolled = StudentTransactions::where('student_id', $studentId)
        ->where('course_id', $course->id)
        ->where('status', 'approved')
        ->exists();

    if (! $isEnrolled) {
        return response()->json([
            'error' => 'You must be enrolled to access this course.'
        ], 403); 
    }

    $lessons = $course->lessons()->where('is_avaliable', true)->get();

    return response()->json([
        'message' => 'Course lessons retrieved successfully.',
        'lessons' => $lessons,
    ]);
}








public function myCoursesApi()
{
    $student = auth('api_student')->user();

    $courses = $student->enrolledCourses()->wherePivot('status', 'approved')->get();

    return response()->json(['courses' => CoursesResource::collection($courses)]);
}

public function logout()
{
    auth('api_student')->logout();

    return response()->json([
        'message' => 'Logout successful'
    ]);
}


}
