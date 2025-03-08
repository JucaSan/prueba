
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans inicio__bg">
    <div class="container">
        <!-- Logo -->
        <img src="{{ asset('img/logos-cov-03.svg') }}" alt="Logo de la empresa" class="logo">

        <!-- Texto de bienvenida -->
        <div class="welcome-text">
            Bienvenido a nuestra plataforma
        </div>

        <!-- Botón de inicio de sesión -->
        @if (Route::has('login'))
            <nav class="login-button">
                @auth
                    <a href="{{ route('home') }}" class="text-white">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-white">
                        Iniciar sesión
                    </a>
                @endauth
            </nav>
        @endif
    </div>
</body>
</html>
