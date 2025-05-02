@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Tableau de bord Participant</h1>
        <p class="text-gray-600">Bienvenue, {{ auth()->user()->name }}</p>

        @if($unreadNotifications > 0)
        <div class="mt-2">
            <a href="{{ route('notifications') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <span class="bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center mr-2">
                    {{ $unreadNotifications }}
                </span>
                Nouvelle(s) notification(s)
            </a>
        </div>
        @endif
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Mes Tontines -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Mes Tontines</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['my_tontines_count'] }}</p>
                </div>
            </div>
        </div>

        <!-- Paiements validés -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Paiements validés</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['payments_made'] }}</p>
                </div>
            </div>
        </div>

        <!-- Paiements en attente -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Paiements en attente</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['pending_payments'] }}</p>
                </div>
            </div>
        </div>

        <!-- Montant total -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total investi</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ number_format($stats['total_amount'], 2) }} FCFA</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tontines disponibles -->
    @if($availableTontines->count() > 0)
    <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
    </div>
    @endif
</div>
@endsection
