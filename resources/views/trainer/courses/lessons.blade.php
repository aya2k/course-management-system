@extends('layouts.main')



@section('content')
    <h2>Manage Lessons for: {{ $course->title }}</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <h3>Existing Lessons</h3>
    <ul>
        @forelse($lessons as $lesson)
            <li style="margin-bottom: 10px;">
                <strong>{{ $lesson->title }}</strong> ({{ $lesson->duration }})
                <form action="{{ route('trainer.lessons.destroy', [$course->id, $lesson->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">❌ Delete</button>
                </form>
            </li>
        @empty
            <p>No lessons added yet.</p>
        @endforelse
    </ul>
<style>
    .course-form {
        max-width: 600px;
        margin: 30px auto;
        padding: 25px;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: sans-serif;
    }

    .course-form h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .course-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    .course-form input,
    .course-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .course-form textarea {
        resize: vertical;
        min-height: 100px;
    }

    .course-form .checkbox-group {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .course-form .checkbox-group input {
        width: auto;
        margin-right: 8px;
    }

    .course-form button {
        background-color: #007BFF;
        color: white;
        padding: 10px 20px;
        border: none;
        width: 100%;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .course-form button:hover {
        background-color: #0056b3;
    }
</style>
    <hr>

    <h3>Add New Lesson</h3>
    <form method="POST" action="{{ route('trainer.lessons.store', $course) }}" class="course-form">
        @csrf

         <h2>Create New Course</h2>

    <label for="name"> Name</label>
    <input name="name" id="name" placeholder=" Name">


    <label for="desc">Description</label>
    <textarea name="desc" id="desc" placeholder="Course Description"></textarea>

    <label for="duration">Duration</label>
    <input type="time" name="duration" id="duration">

    <label for="video_url">Video URL</label>
     <input type="url" name="video_url" placeholder="Video URL (optional)"><br>

    <div class="checkbox-group">
        <input type="checkbox" name="is_avaliable" value="1" id="is_avaliable">
        <label for="is_avaliable" style="margin: 0;">Available</label>
    </div>

    <button type="submit">Add Lesson</button>
</form>
@endsection


