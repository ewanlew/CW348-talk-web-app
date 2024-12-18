<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talk! | Home</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div class="header-nonstick">
        <h1 class="talk" style="margin-bottom: 10px">Talk!</h1>
    </div>

    <div class="container" style="padding-top: 20px">
        @if(Auth::check())

            <div class="post" style="text-align: center; border-color: white;">
                <h2>Hello, {{ Auth::user()->name }}!</h2>
            </div>


            <div class="grid-container">

                <div class="grid-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="home-logout-button">Logout</button>
                    </form>
                </div>


                <div class="grid-item">
                    <form method="GET" action="{{ route('timeline') }}">
                        <button type="submit" class="home-timeline-button">Timeline</button>
                    </form>
                </div>
            </div>
        @else

            <div class="post" style="text-align: center; border-color: white;">
                <h3>
                    You are not logged in! Sign in or register.
                </h3>
            </div>
            <div class="grid-container">
                <div class="grid-item">
                    <form method="GET" action="{{ route('login') }}">
                        @csrf
                        <button type="submit" class="home-account-button">Sign in</button>
                    </form>
                </div> 

                <div class="grid-item">
                    <form method="GET" action="{{ route('register') }}">
                        @csrf
                        <button type="submit" class="home-account-button">Register</button>
                    </form>
                </div> 
            </div>
        @endif
    </div>
</body>
</html>
