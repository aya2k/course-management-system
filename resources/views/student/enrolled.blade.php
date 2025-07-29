@extends('layouts.main')

@section('content')

<form method="POST" action="{{ route('student.courses.enroll', $course) }}" style="display: inline;">
    @csrf
    <button type="submit" style="background: none; border: none; color: blue; text-decoration: underline; cursor: pointer;">
        Enroll
    </button>
</form>



   
@endsection
