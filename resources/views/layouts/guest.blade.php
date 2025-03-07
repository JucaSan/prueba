<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="containerCSS">
        <!-- Lado izquierdo: Imagen -->
        <div class="left-side"></div>

        <!-- Lado derecho: Formulario de login -->
        <div class="right-side">
            {{ $slot }} <!-- Aquí se inyectará el contenido del formulario -->
        </div>
    </div>
</body>
</html>