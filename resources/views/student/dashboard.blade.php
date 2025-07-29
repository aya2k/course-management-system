@extends('layouts.main')

@section('content')

    <h2>Welcome, {{ auth('student_web')->user()->name }}</h2>

<a href="{{ route('student.courses.index') }}">Browse Courses</a>

<form action="{{ route('student.logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
@endsection






