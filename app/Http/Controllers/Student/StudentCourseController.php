<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentTransaction;
use App\Models\StudentTransactions;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_avaliable', true)->get();
      // dd ( $courses);
         return view('student.courses.index', compact('courses'));
    }

    public function enroll(Course $course)
    {
        $studentId = auth('student_web')->id();

        $exists = StudentTransactions::where('student_id', $studentId)
            ->where('course_id', $course->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        StudentTransactions::create([
            'student_id' => $studentId,
            'course_id' => $course->id,
            'status' => 'approved', 
        ]);

        return redirect()->route('student.courses.lessons', $course->id)->with('success', 'You are enrolled!');
    }

    public function lessons(Course $course)
    {
        $studentId = auth('student_web')->id();

        $isEnrolled = StudentTransactions::where('student_id', $studentId)
            ->where('course_id', $course->id)
            ->where('status', 'approved')
            ->exists();

        if (! $isEnrolled) {
            abort(403, 'You must be enrolled to access this course.');
        }

        $lessons = $course->lessons()->where('is_avaliable', true)->get();
        return view('student.courses.lessons', compact('course', 'lessons'));
    }


    public function myCourses()
{
    $student =auth('student_web')->user() ;

    $courses =$student->enrolledCourses()->wherePivot('status', 'approved')->get();

    return view('student.courses.my_courses', compact('courses'));
}
}

