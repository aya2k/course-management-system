<?php

namespace App\Http\Controllers\Trainer;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
       $courses = Course::where('trainer_id', auth('trainer_web')->id())->get();
    return view('trainer.dashboard', compact('courses'));
    }
}
