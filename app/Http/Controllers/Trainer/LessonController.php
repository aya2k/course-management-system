<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Requests\Lesson\CreateLessonRequest;
use App\Http\Requests\Lesson\UpdateLessonRequest;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        $this->authorizeTrainer($course);

        $lessons = $course->lessons;
        return view('trainer.courses.lessons', compact('course', 'lessons'));
    }

    public function store(CreateLessonRequest $request, Course $course)
    {
        $this->authorizeTrainer($course);

        $data = $request->validated();

        $data['course_id'] = $course->id;

        Lesson::create($data);

        return redirect()->back()->with('success', 'Lesson added');
    }

    private function authorizeTrainer(Course $course)
    {
        if ($course->trainer_id !== auth('trainer_web')->id()) {
            abort(403);
        }
    }

    public function destroy(Course $course, Lesson $lesson)
    {

        if ($lesson->course_id !== $course->id) {
            abort(403, 'This lesson does not belong to the specified course.');
        }


        $lesson->delete();

        return redirect()->back()->with('success', 'Lesson deleted.');
    }
}
