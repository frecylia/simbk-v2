<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS (dari CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS (tambahkan custom styles) -->

    <!-- Optional: Add inline styles if needed -->
    <style>
        /* Custom styling */
        body {
            background-color: #f8f9fa;
            font-family: 'Nunito', sans-serif;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #d1e7ff !important;
        }

        .dropdown-menu {
            background-color: #007bff;
            color: white;
        }

        .dropdown-item:hover {
            background-color: #0056b3;
        }

        .py-4 {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        /* Custom page title */
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

               
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                {{-- <h1>Selamat datang di Sistem Bimbingan dan Konseling</h1> --}}
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS (dari CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

{{-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Tes Peminatan Kejuruan MAN 1 Bandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS dari formulir yang sudah dibuat sebelumnya */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }
        /* Tambahkan CSS lainnya dari kode sebelumnya */
    </style>
</head>
<body>
    <div class="container py-4">
        @yield('content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html> --}}