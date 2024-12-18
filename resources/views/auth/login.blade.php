<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talk! | Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div class="header-nonstick">
        <h1 class="talk" style="margin-bottom: 10px">Talk!</h1>
    </div>

    <div class="container" style="padding-top: 20px;">
        <div class="post" style="text-align: center; border-color: white; max-width: 400px; margin: auto;">
            <h2>Login</h2>

            <form method="POST" action="{{ route('login') }}" style="margin-top: 20px;">
                @csrf

                <div style="margin-bottom: 15px; text-align: left;">
                    <label for="email" style="display: block; font-weight: bold; margin-bottom: 5px;">
                        Email:
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        class="form-entry" 
                        placeholder="Enter your email" 
                        required>
                </div>

                <div style="margin-bottom: 15px; text-align: left;">
                    <label for="password" style="display: block; font-weight: bold; margin-bottom: 5px;">
                        Password:
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        class="form-entry" 
                        placeholder="Enter your password" 
                        required>
                </div>

                <button 
                    type="submit" 
                    class="home-account-button"
                    style="width: 100%; padding: 10px; margin-top: 10px;">
                    Login
                </button>
            </form>

            <p style="margin-top: 15px; color: gray;">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-500">
                    Register here
                </a>
            </p>
        </div>
    </div>
</body>
</html>
