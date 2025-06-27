<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tontine Manager') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            600: '#1e40af',
                            700: '#1e3a8a',
                            800: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-blue-800 text-white shadow-md">
            <div class="container mx-auto px-4 py-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <a href="{{ url('/') }}" class="text-xl font-bold flex items-center">
                            <i class="fas fa-hand-holding-usd mr-2"></i>
                            TontineManager
                        </a>
                        @auth
                            <a href="{{ auth()->user()->isManager() ? route('manager.dashboard') : route('participant.dashboard') }}"
                               class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                            </a>

                            @if(auth()->user()->isSuperAdmin())
                                <a href="{{ route('super_admin.dashboard') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                    <i class="fas fa-tachometer-alt mr-1"></i> Super Admin
                                </a>
                            @endif

                            <!-- Menu spécifique au manager -->
                            @if(auth()->user()->isManager())
                                <a href="{{ route('manager.tontines.index') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                    <i class="fas fa-users mr-1"></i> Mes Tontines
                                </a>
                                <a href="{{ route('manager.participants.index') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                    <i class="fas fa-user-friends mr-1"></i> Participants
                                </a>
                            @endif

                            <!-- Menu spécifique au participant -->
                            @if(auth()->user()->isParticipant())
                                <a href="{{ route('participant.tontines') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                    <i class="fas fa-users mr-1"></i> Mes Tontines
                                </a>
                                <a href="{{ route('participant.payments') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                    <i class="fas fa-money-bill-wave mr-1"></i> Paiements
                                </a>
                            @endif
                        @endauth
                    </div>

                    <div class="flex items-center space-x-4">
                        @auth
                            <div class="hidden md:flex items-center space-x-4">
                                <span class="text-sm">Bonjour, {{ auth()->user()->name }}</span>
                                <div class="relative">
                                    <a href="{{ route('notifications') }}" class="p-2 hover:bg-blue-700 rounded-full transition duration-300">
                                        <i class="fas fa-bell"></i>
                                        @if(auth()->user()->unreadNotifications()->count() > 0)
                                            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                                {{ auth()->user()->unreadNotifications()->count() }}
                                            </span>
                                        @endif
                                    </a>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                        <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
                                    </button>
                                </form>
                            </div>

                            <!-- Menu mobile -->
                            <div class="md:hidden">
                                <button id="mobile-menu-button" class="p-2 focus:outline-none">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-sign-in-alt mr-1"></i> Connexion
                            </a>
                            <a href="{{ route('register') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-user-plus mr-1"></i> Inscription
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Menu mobile (hidden by default) -->
                @auth
                <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4">
                    <div class="flex flex-col space-y-2">
                        <span class="text-sm py-2 border-b border-blue-700">Bonjour, {{ auth()->user()->name }}</span>

                        @if(auth()->user()->isManager())
                            <a href="{{ route('manager.tontines.index') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-users mr-2"></i> Mes Tontines
                            </a>
                            <a href="{{ route('manager.participants.index') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-user-friends mr-2"></i> Participants
                            </a>
                        @endif

                        @if(auth()->user()->isParticipant())
                            <a href="{{ route('participant.tontines') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-users mr-2"></i> Mes Tontines
                            </a>
                            <a href="{{ route('participant.payments') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-money-bill-wave mr-2"></i> Paiements
                            </a>
                        @endif

                        <a href="{{ route('notifications') }}" class="px-3 py-2 rounded hover:bg-blue-700 transition duration-300 flex items-center">
                            <i class="fas fa-bell mr-2"></i> Notifications
                            @if(auth()->user()->unreadNotifications()->count() > 0)
                                <span class="ml-auto bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ auth()->user()->unreadNotifications()->count() }}
                                </span>
                            @endif
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 rounded hover:bg-blue-700 transition duration-300">
                                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow container mx-auto px-4 py-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-blue-800 text-white py-4">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; {{ date('Y') }} TontineManager. Tous droits réservés.</p>
            </div>
        </footer>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="fixed bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded shadow-lg flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Script for mobile menu -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
