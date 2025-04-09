<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tontine Manager') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-blue-800 text-white shadow-md">
            <div class="container mx-auto px-4 py-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <a href="{{ url('/') }}" class="text-xl font-bold">TontineManager</a>
                        @auth
                            <a href="{{ auth()->user()->isManager() ? route('manager.dashboard') : route('participant.dashboard') }}"
                               class="px-3 py-2 rounded hover:bg-blue-700">
                                Dashboard
                            </a>
                        @endauth
                    </div>

                    <div class="flex items-center space-x-4">
                        @auth
                            <span class="text-sm">Bonjour, {{ auth()->user()->name }}</span>
                            <a href="{{ route('notifications') }}" class="relative p-2">
                                🔔
                                @if(auth()->user()->unreadNotifications()->count() > 0)
                                    <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ auth()->user()->unreadNotifications()->count() }}
                                    </span>
                                @endif
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="px-3 py-2 rounded hover:bg-blue-700">Déconnexion</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="px-3 py-2 rounded hover:bg-blue-700">Connexion</a>
                            <a href="{{ route('register') }}" class="px-3 py-2 rounded hover:bg-blue-700">Inscription</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="container mx-auto px-4 py-6">
            @yield('content')
        </main>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="fixed bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded shadow-lg">
            {{ session('error') }}
        </div>
    @endif
</body>
</html>
