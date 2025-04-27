<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PowerPulse') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fc;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .content-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-top: 1.5rem;
        }
        .btn {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }
        .btn-secondary {
            background-color: #6b7280;
        }
        .btn-success {
            background-color: #10b981;
        }
        .btn-danger {
            background-color: #ef4444;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')
</head>
<body>
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="container py-4">
                <h2 class="font-semibold text-xl text-gray-800">
                    @yield('header')
                </h2>
            </div>
        </header>

        <!-- Page Content -->
        <main class="container py-4">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="content-container">
                @yield('content')
            </div>
        </main>
        
        <footer class="bg-white shadow mt-6 py-4">
            <div class="container text-center text-gray-600">
                &copy; {{ date('Y') }} PowerPulse Feedback Management System
            </div>
        </footer>
    </div>
</body>
</html>