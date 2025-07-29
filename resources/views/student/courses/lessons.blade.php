@extends('layouts.main')

@section('content')
    <h2>Lessons for {{ $course->title }}</h2>

<ul>
@forelse($lessons as $lesson)
    <li>
        <strong>{{ $lesson->title }}</strong> - {{ $lesson->duration }}
        @if($lesson->video_url)
            <br><a href="{{ $lesson->video_url }}" target="_blank">Watch Video</a>
        @endif
    </li>
@empty
    <li>No lessons available.</li>
@endforelse
</ul>

<a href="{{ route('student.courses.index') }}">⬅ Back to courses</a>
@endsection




