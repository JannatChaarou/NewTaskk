
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
    <div class="auth-register"> 
        
        
        <div class="auth-container-register">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="width: 125px; height: 125px; border-radius: 50%;">
        
             <h2 class="title-Auth">Create an Account and Start Organizing Your Tasks!</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <input type="text" name="name" id="name" placeholder="Your Name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="email" name="email" id="email" placeholder="Your Email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <div>
                    <button type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
