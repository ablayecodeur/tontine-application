@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-800 py-4 px-6 flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">Tous les participants</h1>
            <a href="{{ route('manager.participants.create') }}"
               class="bg-white text-blue-800 px-4 py-2 rounded text-sm hover:bg-gray-100">
                Ajouter un participant
            </a>
        </div>

        <div class="p-6">
            @if($participants->isEmpty())
                <p class="text-gray-500">Aucun participant enregistré.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Nom</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Tontine</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Email</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Téléphone</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Statut</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participants as $participant)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $participant->user->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $participant->tontine->name }}</td>
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

                <div class="mt-4">
                    {{ $participants->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
