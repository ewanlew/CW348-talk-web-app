<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talk! | Home</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="talk">Talk!</h1>

        @if(Auth::check())
        <div class="header" style="display: flex; justify-content: space-between; align-items: center;">
            <span>Hello, {{ Auth::user()->name }}!</span>
            <a href="{{ route('posts.timeline') }}">Go to my timeline</a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
            @csrf
        <button type="submit">Logout</button>
    </form>
</div>

        @else
            <div class="header">
                <p style="text-align:left; padding:10px">
                    You are not logged in! Register or sign in.
                    <span style="float:right; margin-right:10px;">
                        <a href="{{ route('login') }}">Login</a> |
                        <a href="{{ route('register') }}">Register</a>
                    </span>
                </p>
            </div>
        @endif
    </div>
</body>
</html>
