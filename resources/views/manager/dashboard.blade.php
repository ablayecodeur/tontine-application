@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Tableau de bord du Gérant</h1>
        <p class="text-gray-600">Bienvenue, {{ auth()->user()->name }}</p>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Tontines actives</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['tontines_count'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Participants</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['active_participants'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Paiements en attente</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $stats['pending_payments'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total collecté</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ number_format($stats['total_collected'], 2) }} FCFA</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dernières tontines -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Vos dernières tontines</h2>
            <a href="{{ route('manager.tontines.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Voir tout</a>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($tontines as $tontine)
            <div class="px-6 py-4 hover:bg-gray-50">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-medium text-gray-800">{{ $tontine->name }}</h3>
                        <p class="text-sm text-gray-600">
                            {{ $tontine->active_participants_count }} participants actifs |
                            {{ $tontine->pending_participants_count }} en attente
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">{{ number_format($tontine->amount_per_participant, 2) }} FCFA</p>
                        <a href="{{ route('manager.tontines.show', $tontine) }}" class="text-sm text-blue-600 hover:text-blue-800">Détails</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="px-6 py-4 text-center text-gray-500">
                Aucune tontine créée pour le moment
            </div>
            @endforelse
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Participants en attente -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Demandes en attente</h2>
                <a href="{{ route('manager.participants.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Voir tout</a>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($pendingParticipants as $participant)
                <div class="px-6 py-4 hover:bg-gray-50">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-medium text-gray-800">{{ $participant->user->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $participant->tontine->name }}</p>
                        </div>
                        <div>
                            <form method="POST" action="{{ route('manager.participants.approve', $participant) }}" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700">
                                    Approuver
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-4 text-center text-gray-500">
                    Aucune demande en attente
                </div>
                @endforelse
            </div>
        </div>

        <!-- Paiements récents -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Paiements récents</h2>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Voir tout</a>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($recentPayments as $payment)
                <div class="px-6 py-4 hover:bg-gray-50">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-medium text-gray-800">{{ $payment->participant->user->name }}</h3>
                            <p class="text-sm text-gray-600">
                                {{ $payment->participant->tontine->name }} |
                                {{ strtoupper($payment->method) }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold">{{ number_format($payment->amount, 2) }} FCFA</p>
                            <span class="inline-block px-2 py-1 text-xs rounded-full
                                {{ $payment->status === 'verified' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $payment->status === 'verified' ? 'Validé' : 'En attente' }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-4 text-center text-gray-500">
                    Aucun paiement récent
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
