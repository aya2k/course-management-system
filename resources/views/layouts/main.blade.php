<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Management System</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        header, footer {
            background: #003366;
            color: white;
            padding: 10px 20px;
        }

        main {
            padding: 20px;
        }

        a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }
    </style>
</head>
<body>

    @include('components.header')

    <main class="container">
        @yield('content')
    </main>

    @include('components.footer')

</body>
</html>
