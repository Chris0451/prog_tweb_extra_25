<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>
<body class="{{ request()->is('login') ? 'login-page' : '' }}">
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">

        {{-- Il contenuto dinamico della pagina (login, register, ecc.) --}}
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
