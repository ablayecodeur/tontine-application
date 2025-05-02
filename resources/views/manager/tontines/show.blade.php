@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-800 py-4 px-6 flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">Détails de la tontine: {{ $tontine->name }}</h1>
            <div class="flex space-x-2">
                <a href="{{ route('manager.tontines.edit', $tontine) }}"
                   class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                    Modifier
                </a>
                <form method="POST" action="{{ route('manager.tontines.destroy', $tontine) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tontine?')">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h2 class="text-lg font-semibold mb-2">Informations</h2>
                    <ul class="space-y-2">
                        <li><strong>Montant par participant:</strong> {{ number_format($tontine->amount_per_participant, 2) }} FCFA</li>
                        <li><strong>Participants:</strong> {{ $tontine->activeParticipants()->count() }} / {{ $tontine->max_participants }}</li>
                        <li><strong>Date de création:</strong> {{ $tontine->created_at->format('d/m/Y') }}</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-lg font-semibold mb-2">Actions</h2>
                    <div class="space-y-2">
                         <a href="{{ route('manager.tontines.draw', $tontine) }}"
                            class="block bg-green-600 text-white px-4 py-2 rounded text-center hover:bg-green-700">
                            Effectuer un tirage
                        </a>
                        <a href="{{ route('manager.participants.create', ['tontine_id' => $tontine->id]) }}"
                           class="block bg-blue-600 text-white px-4 py-2 rounded text-center hover:bg-blue-700">
                            Ajouter un participant
                        </a>
                    </div>
                </div>
            </div>

            <h2 class="text-lg font-semibold mb-4">Participants</h2>
            @if($tontine->participants->isEmpty())
                <p class="text-gray-500">Aucun participant pour le moment.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Nom</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Email</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Téléphone</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Statut</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tontine->participants as $participant)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $participant->user->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $participant->user->email }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $participant->user->phone }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        {{ $participant->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $participant->status === 'active' ? 'Actif' : 'En attente' }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    @if($participant->status === 'pending')
                                        <form method="POST" action="{{ route('manager.participants.approve', $participant) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-800">Approuver</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
