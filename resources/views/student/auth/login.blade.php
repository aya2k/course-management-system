@extends('layouts.main')
<!DOCTYPE html>
<head>
    <title>Student Login</title>
</head>
@section('content')
    <h2>Student Login</h2>

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('student.login') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form> 

    <p style="margin-top: 15px;">
        Don't have an account? 
        <a href="{{ route('student.register') }}" style="color: #007BFF;">Register here</a>
    </p>
@endsection









  