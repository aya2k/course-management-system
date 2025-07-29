<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CoursesResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Course\CreateCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::where('is_avaliable', true)->get();
        return response()->json(['courses' => CoursesResource::collection($courses)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCourseRequest $request)
    {

        $data = $request->validated();

        $course = new Course();

        $course->name = $data['name'];
        $course->desc = $data['desc'];
        $course->duration = $data['duration'];
        $course->price = $data['price'];
        $course->is_avaliable = $data['is_avaliable'] ?? true;
        $course->trainer_id = auth('api_trainer')->id();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $course->image = $path;
        }

        $course->save();

        return response()->json([
            'message' => 'Course added successfully',
            'course' => $course
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        if ($course) {
            return response()->json($course, '200');
        } else {
            return 'the Course not found';
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, string $id)
    {

        $data = $request->validated();
        $course = Course::findOrFail($id);
        $course->name = $data['name'];
        $course->desc = $data['desc'];
        $course->duration = $data['duration'];
        $course->price = $data['price'];
        $course->is_avaliable = $data['is_avaliable'] ??true;


        if ($request->hasFile('image')) {
            // Delete old file if it exists
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }

            // Store new file
            $path = $request->file('image')->store('uploads', 'public');
            $course->image = $path;
        }

        // Save changes
        $course->save();

        return response()->json([
            'message'  => 'Course updated successfully',
            'course' => $course
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return response()->json('the Course is deleted', 200);
        } else {
            return response()->json('the Course is not found');
        }
    }
}
