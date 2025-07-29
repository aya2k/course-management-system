<?php

namespace App\Http\Controllers\Trainer;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CreateCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $courses = Course::where('trainer_id', auth('trainer_web')->id())->get();
        return view('trainer.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trainer.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCourseRequest $request)
    {
         $data = $request->validated();

        $data['trainer_id'] = auth('trainer_web')->id();
        Course::create($data);

        return redirect()->route('trainer.dashboard')->with('success', 'Course created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $this->authorizeTrainer($course);
        return view('trainer.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
       $this->authorizeTrainer($course);

        $data = $request->validated();
       

        $data['is_avaliable'] = $request->has('is_avaliable');
       
        $course->update($data);

        return redirect()->route('trainer.dashboard')->with('success', 'Course updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $this->authorizeTrainer($course);
        $course->delete();
        return redirect()->route('trainer.dashboard')->with('success', 'Course deleted');
    }


    private function authorizeTrainer(Course $course)
    {
        if ($course->trainer_id !== auth('trainer_web')->id()) {
            abort(403);
        }
    }
}
