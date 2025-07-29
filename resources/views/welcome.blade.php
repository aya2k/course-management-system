@extends('layouts.main')

@section('content')
    <style>
        .welcome-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
            padding: 30px;
            background-color: #f7f7f7;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .welcome-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .welcome-container a {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            font-size: 16px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .welcome-container a:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="welcome-container">
        <h2>Welcome to the Course Management System</h2>
        <p>Are you a trainer or a student?</p>

        <a href="{{ route('trainer.login') }}">I’m a Trainer</a>
        <a href="{{ route('student.login') }}">I’m a Student</a>
    </div>
@endsection
