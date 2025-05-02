@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-800 py-4 px-6">
            <h1 class="text-white text-xl font-bold">Tirage au sort - {{ $tontine->name }}</h1>
        </div>

        <div class="p-6">
            @if($tontine->activeParticipants()->count() < 2)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
                    <p>Vous devez avoir au moins 2 participants actifs pour effectuer un tirage.</p>
                </div>
                <a href="{{ route('manager.tontines.show', $tontine) }}"
                   class="block text-center bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Retour
                </a>
            @else
                <p class="mb-4">Êtes-vous sûr de vouloir effectuer un tirage au sort pour cette tontine?</p>

                <div class="bg-gray-100 p-4 rounded mb-4">
                    <h2 class="font-semibold mb-2">Participants éligibles:</h2>
                    <ul class="list-disc pl-5">
                        @foreach($tontine->activeParticipants as $participant)
                            <li>{{ $participant->user->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <form method="POST" action="{{ route('manager.tontines.perform-draw', $tontine) }}">
                    @csrf
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('manager.tontines.show', $tontine) }}"
                           class="text-gray-600 hover:text-gray-800">
                            Annuler
                        </a>
                        <button type="submit"
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Effectuer le tirage
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
