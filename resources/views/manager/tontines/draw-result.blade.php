@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-green-600 py-4 px-6">
            <h1 class="text-white text-xl font-bold">Résultat du tirage - {{ $tontine->name }}</h1>
        </div>

        <div class="p-6 text-center">
            <div class="mb-6">
                <p class="text-lg mb-2">Le gagnant est:</p>
                <p class="text-2xl font-bold text-green-600">{{ $winner->user->name }}</p>
                <p class="text-gray-600">{{ $winner->user->phone }}</p>
            </div>

            <div class="bg-gray-100 p-4 rounded mb-6">
                <p class="font-semibold">Montant à recevoir:</p>
                <p class="text-xl">{{ number_format($tontine->amount_per_participant * ($tontine->activeParticipants()->count() - 1), 2) }} FCFA</p>
            </div>

            <a href="{{ route('manager.tontines.show', $tontine) }}"
               class="inline-block bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700">
                Retour à la tontine
            </a>
        </div>
    </div>
</div>
@endsection
