<header>
    <div class="container">
        <h1>Course Management System</h1>

        @php
            $trainer = Auth::guard('trainer_web')->user();
            $student = Auth::guard('student_web')->user();

            $hideLinks = in_array(Route::currentRouteName(), [
                'trainer.login', 'trainer.register',
                'student.login', 'student.register',
            ]);
        @endphp

        @if(!$hideLinks)
            @if($trainer)
                <a href="{{ route('trainer.dashboard') }}">My Courses</a>
                <form action="{{ route('trainer.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @elseif($student)
                <a href="{{ route('student.courses.index') }}">Available Courses</a>
                <a href="{{ route('student.my_courses') }}">My Courses</a>
                <form action="{{ route('student.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @endif
        @endif

    </div>
</header>

