<?php

namespace App\Http\Controllers\Api;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Lesson\CreateLessonRequest;
use App\Http\Requests\Lesson\UpdateLessonRequest;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Lesson::where('is_avaliable', true)->get();
        return response()->json(['lessons' => LessonResource::collection($lessons)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLessonRequest $request)
    {
        $data = $request->validated();

        $lesson = new Lesson();

        $lesson->course_id = $data['course_id'];
        $lesson->name = $data['name'];
        $lesson->desc = $data['desc'];
        $lesson->duration = $data['duration'];
        $lesson->is_avaliable = $data['is_avaliable'] ?? true;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $lesson->image = $path;
        }

        $lesson->save();

        return response()->json([
            'message' => 'Lesson added successfully',
            'lesson' => $lesson
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lesson = Lesson::find($id);
        if ($lesson) {
            return response()->json($lesson, '200');
        } else {
            return 'the lesson not found';
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, string $id)
    {
        $data = $request->validated();

        $lesson = Lesson::findOrFail($id);
        $lesson->name = $data['name'];
        $lesson->desc = $data['desc'];
        $lesson->duration = $data['duration'];
        $lesson->video_url = $data['video_url'];
        $lesson->is_avaliable = $data['is_avaliable'] ?? true;


        if ($request->hasFile('image')) {

            if ($lesson->image) {
                Storage::disk('public')->delete($lesson->image);
            }


            $path = $request->file('image')->store('uploads', 'public');
            $lesson->image = $path;
        }


        $lesson->save();

        return response()->json([
            'message'  => 'lesson updated successfully',
            'lesson' => $lesson
        ], 200);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lesson = Lesson::find($id);
        if ($lesson) {
            $lesson->delete();
            return response()->json('the lesson is deleted', 200);
        } else {
            return response()->json('the lesson is not found');
        }
    }
}
