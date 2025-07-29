@extends('layouts.main')



@section('content')
    <h2>Welcome, {{ auth('trainer_web')->user()->name }}</h2>

    <div style="margin: 20px 0;">
        <a href="{{ route('trainer.courses.create') }}">
            <button style="padding: 10px; background: #0066cc; color: white; border: none;">
                + Add New Course
            </button>
        </a>
    </div>

    <h3>Your Courses</h3>

    @if($courses->count())
        <ul>
            @foreach($courses as $course)
                <li style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
                    <a href="{{ route('trainer.lessons.index', $course) }}" style="font-size: 18px; color: #007BFF; text-decoration: none;">
                        <strong>{{ $course->name }}</strong>
                    </a><br>

                    <small style="color: #555;">{{ $course->desc }}</small><br>

                    <p style="margin-top: 8px;"><strong>Enrolled Students:</strong> {{ $course->enrolledStudentCount() }}</p>
               
                   <a href="{{ route('trainer.courses.edit', $course) }}">✏️Edit</a>
                   
                   

                    <form action="{{ route('trainer.courses.destroy', $course) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">🗑️ Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>You have no courses yet.</p>
    @endif

@endsection













