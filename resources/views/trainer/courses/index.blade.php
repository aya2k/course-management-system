@extends('layouts.main')

{{-- @section('content')
    <h2>My Courses</h2>

<a href="{{ route('trainer.courses.create') }}">+ Add Course</a>
<a href="{{ route('trainer.lessons.index', $course) }}">Manage Lessons</a>

<ul>
@foreach($courses as $course)
    <li>
        {{ $course->title }}
        <a href="{{ route('trainer.courses.edit', $course) }}">Edit</a>
        <form method="POST" action="{{ route('trainer.courses.destroy', $course) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </li>
@endforeach
</ul>
@endsection --}}







