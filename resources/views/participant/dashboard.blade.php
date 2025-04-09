<!-- resources/views/participant/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<!-- Header Navigation Participant -->
<header class="bg-white shadow-sm mb-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex space-x-8">
        <!-- Logo / Accueil -->
        <a href="{{ route('participant.dashboard') }}" class="flex items-center text-green-600 font-bold">
          <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
          </svg>
          TontineParticipant
        </a>

        <!-- Liens Principaux -->
        <nav class="hidden sm:flex space-x-8">
          <a href="{{ route('participant.tontines') }}"
             class="inline-flex items-center px-1 pt-1 border-b-2 border-green-500 text-sm font-medium text-gray-900">
            Tontines disponibles
          </a>
          <a href="{{ route('participant.payments') }}"
             class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-sm font-medium text-gray-500 hover:text-gray-700">
            Mes Paiements
          </a>
          <a href="{{ route('notifications') }}"
             class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-sm font-medium text-gray-500 hover:text-gray-700 relative">
            Alertes
            @if(auth()->user()->unreadNotifications->count() > 0)
              <span class="absolute -top-1 -right-4 inline-block w-5 h-5 bg-red-600 text-white text-xs rounded-full flex items-center justify-center">
                {{ auth()->user()->unreadNotifications->count() }}
              </span>
            @endif
          </a>
        </nav>
      </div>

      <!-- Menu utilisateur -->
      <div class="hidden sm:ml-6 sm:flex sm:items-center">
        <div class="relative">
          <button class="flex items-center text-sm rounded-full focus:outline-none group">
            <span class="mr-3 text-sm text-gray-700 group-hover:text-green-600">
              {{ Auth::user()->name }}
            </span>
            <div class="relative">
              <svg class="h-8 w-8 rounded-full bg-green-100 text-green-600 p-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
          </button>

          <!-- Dropdown menu -->
          <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 hidden" style="z-index: 1000;">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">
                <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Déconnexion
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Contenu principal -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
  @include('shared.notifications')

  @yield('participant-content') <!-- Section pour le contenu spécifique -->
</main>
@endsection

@push('scripts')
<script>
// Gestion du menu dropdown
document.addEventListener('DOMContentLoaded', function() {
  const profileButton = document.querySelector('header button');
  const dropdownMenu = document.querySelector('header .relative + .hidden');

  profileButton.addEventListener('click', function(e) {
    e.stopPropagation();
    dropdownMenu.classList.toggle('hidden');
  });

  document.addEventListener('click', function() {
    dropdownMenu.classList.add('hidden');
  });
});
</script>
@endpush
