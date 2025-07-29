@extends('layouts.main')

@section('content')
    <h2>My Enrolled Courses</h2>

    @forelse ($courses as $course)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <strong>{{ $course->title }}</strong><br>
            <small>{{ $course->desc }}</small><br>
            <p>Duration: {{ $course->duration }}</p>
        </div>
    @empty
        <p>You are not enrolled in any courses yet.</p>
    @endforelse
@endsection
