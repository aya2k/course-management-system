@extends('layouts.main')
<head>
    <title>Trainer Login</title>
</head>
@section('content')
     <h2>Trainer Login</h2>

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('trainer.login') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form> 
@endsection




