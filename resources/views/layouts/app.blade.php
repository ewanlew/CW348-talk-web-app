<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Talk!')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" rel="preload" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <nav>
        <div class="header-nonstick">
            <h1 class="talk">Talk!</h1>
            <span>Welcome back, {{ Auth::user()->name }}!</span>
            <div style="display: flex; gap: 10px; align-items: center;">

                <!-- Home -->
                <form method="GET" action="{{ route('timeline') }}">
                    @csrf
                    <button tabindex="1" title="Home" alt="Home" type="submit" class="logout-button">
                        <span class="material-symbols-outlined">
                            home
                        </span>
                    </button>
                </form>

                <!-- Profile -->
                <form method="GET" action="{{ route('user.show', Auth::id()) }}">
                    <button tabindex="2" title="Profile" alt="Profile" type="submit" class="logout-button">
                        <span class="material-symbols-outlined">
                            person
                        </span>
                    </button>
                </form>


                <!-- Notifications -->
                <form method="GET" action="{{ route('notifications', Auth::id()) }}">
                    <button tabindex="3" title="Notifications" alt="Notifications" type="submit" class="logout-button">
                        <span class="material-symbols-outlined">
                            notifications
                        </span>
                    </button>
                </form>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button tabindex="4" title="Sign Out" alt="Sign Out" type="submit" class="logout-button">
                        <span class="material-symbols-outlined">
                            logout
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mx-auto px-4">
        @yield('content')
    </div>
</body>
</html>
