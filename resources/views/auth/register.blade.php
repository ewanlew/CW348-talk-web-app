<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talk! | Register</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="header-nonstick">
    <h1 class="talk" style="margin-bottom: 10px">Talk!</h1>
</div>

    <div class="container" style="padding-top: 20px;">
    <div class="post" style="text-align: center; border-color: white; max-width: 400px; margin: auto;">
        <h2>Register</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name">Name:</label>
                <input tabindex="1" type="text" name="name" class="form-entry" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input tabindex="2" type="email" name="email" class="form-entry" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input tabindex="3" type="password" name="password" class="form-entry" required>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input tabindex="4" type="password" name="password_confirmation" class="form-entry" required>
            </div>

            <div>
                <button tabindex="5" type="submit" class="home-account-button" style="margin-top: 10px;">Register</button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 10px; text-align: left;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>

        <p style="margin-top: 15px; color: white;">
                Got an account? 
                <a href="{{ route('login') }}" tabindex="6" class="text-blue-400 hover:text-blue-500">
                    Sign in here
                </a>
            </p>
    </div>
</div>
</body>
</html>
