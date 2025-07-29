@extends('layouts.main')
<head>
    <title>Student Register</title>
</head>
@section('content')
    <h2>Student Register</h2>

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('student.register') }}">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form> 

    
@endsection




    