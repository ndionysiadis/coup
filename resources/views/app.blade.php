<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

        <!-- Standard Favicon -->
        <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/>

        <!-- PNG Icons for Modern Browsers -->
        <link rel="icon" href="{{ asset('images/favicon-16x16.png') }}" sizes="16x16" type="image/png"/>
        <link rel="icon" href="{{ asset('images/favicon-32x32.png') }}" sizes="32x32" type="image/png"/>
        <link rel="icon" href="{{ asset('images/favicon-96x96.png') }}" sizes="96x96" type="image/png"/>

        <!-- Apple Touch Icon -->
        <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}" sizes="180x180">

        <!-- Android and Chrome (Manifest) -->
        <link rel="manifest" href="{{ asset('images/manifest.json') }}">

        <!-- Microsoft Tiles -->
        <meta name="msapplication-TileColor" content="#222222">
        <meta name="msapplication-TileImage" content="{{ asset('images/mstile-150x150.png') }}">

        <!-- Safari Pinned Tab Icon -->
        <link rel="mask-icon" href="{{ asset('images/safari-pinned-tab.svg') }}" color="#222222">
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased bg-gray-900">
        @inertia
    </body>
</html>
