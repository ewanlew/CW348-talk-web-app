<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Talk!')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <nav class="bg-gray-800 p-4 mb-4">
        <div class="header-nonstick">
            <h1 class="talk">Talk!</h1>
            <span>Welcome back, {{ Auth::user()->name }}!</span>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mx-auto px-4">
        @yield('content')
    </div>
</body>
</html>
