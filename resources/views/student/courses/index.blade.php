@extends('layouts.main')

@section('content')
    <h2>Available Courses</h2>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color: red">{{ session('error') }}</p>
@endif

@foreach($courses as $course)
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom:10px;">
        <h3>{{ $course->title }}</h3>
        <p>{{ $course->desc }}</p>
        <p><strong>Duration:</strong> {{ $course->duration }}</p>
        <p><strong>Price:</strong> ${{ $course->price }}</p>

        <form method="POST" action="{{ route('student.courses.enroll', $course) }}">
            @csrf
            <button type="submit">Enroll</button>
        </form>
    </div>
@endforeach
@endsection


