<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Talk!')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 mb-4">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('home') }}" class="text-blue-400 text-2xl font-bold">Talk!</a>
            <div>
                @auth
                    <a href="{{ route('posts.timeline') }}" class="text-gray-300 hover:text-white">Timeline</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-white ml-4">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-300 hover:text-white ml-4">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto px-4">
        @yield('content')
    </div>

</body>
</html>
