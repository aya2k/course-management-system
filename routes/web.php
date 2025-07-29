<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Trainer\CourseController;
use App\Http\Controllers\Api\StudentAuthController;
use App\Http\Controllers\Api\TrainerAuthController;
use App\Http\Controllers\Trainer\DashboardController;
use App\Http\Controllers\Student\StudentCourseController;

Route::get('/', function () {
    return view('welcome');
});
// Trainer Routes
Route::prefix('trainer')->name('trainer.')->group(function () {
    Route::get('login', [\App\Http\Controllers\Trainer\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Trainer\AuthController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\Trainer\AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:trainer_web')->prefix('trainer')->name('trainer.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('courses', CourseController::class);
    Route::post('courses/{course}/lessons', [\App\Http\Controllers\Trainer\LessonController::class, 'store'])->name('lessons.store');
    Route::get('courses/{course}/lessons', [\App\Http\Controllers\Trainer\LessonController::class, 'index'])->name('lessons.index');
    Route::delete('courses/{course}/lessons/{lesson}', [\App\Http\Controllers\Trainer\LessonController::class, 'destroy'])
    ->name('lessons.destroy');


});


// Student Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('register', [\App\Http\Controllers\Student\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [\App\Http\Controllers\Student\AuthController::class, 'register']);
    Route::get('login', [\App\Http\Controllers\Student\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Student\AuthController::class, 'login']);
  //  Route::post('logout', [\App\Http\Controllers\Student\AuthController::class, 'logout'])->name('logout');
});




Route::middleware('auth:student_web')->prefix('student')->name('student.')->group(function () {
    Route::post('logout', [\App\Http\Controllers\Student\AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', fn() => view('student.dashboard'))->name('dashboard');

    Route::get('courses', [App\Http\Controllers\Student\StudentCourseController::class, 'index'])->name('courses.index');
    Route::post('courses/{course}/enroll', [App\Http\Controllers\Student\StudentCourseController::class, 'enroll'])->name('courses.enroll');
    Route::get('my-courses/{course}', [App\Http\Controllers\Student\StudentCourseController::class, 'lessons'])->name('courses.lessons');
    Route::get('/student/my-courses', [StudentCourseController::class, 'myCourses'])->name('my_courses');

});


