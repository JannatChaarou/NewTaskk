
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>
<body>
    <div class="body-Auth">      
       
        
        <div class="auth-container"> <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="width: 150px; height: 150px; border-radius: 50%;">
        
        <h2 class="title-Auth">Stay Organized, Achieve More: Your Tasks, Your Way!</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <input type="email" name="email" id="email"  placeholder="Enter your email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit">Login</button>
                </div>
                <div class="lien">
                    <a href="{{ route('register') }}" class="register-link">Don't have an account? Register</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
