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
    <header class="">
        @if (Route::has('login'))
            <nav class="">
                @auth
                    <a
                        href="{{ route('home') }}"
                        class=""
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class=""
                    >
                        Iniciar sesión
                    </a>

                    {{-- @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class=""
                        >
                            Registrarse
                        </a>
                    @endif --}}
                @endauth
            </nav>
        @endif
    </header>
    <div>
        <img src="{{ asset('img/logos-cov-03.svg') }}" alt="Logo de la empresa">
    </div>
</body>
</html>