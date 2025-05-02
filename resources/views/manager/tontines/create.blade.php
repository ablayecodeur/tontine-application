@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-800 py-4 px-6">
                <h1 class="text-white text-xl font-bold">Créer une nouvelle tontine</h1>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('manager.tontines.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom de la tontine</label>
                        <input id="name" type="text"
                               class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                               name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="amount_per_participant" class="block text-gray-700 text-sm font-bold mb-2">
                            Montant par participant (FCFA)
                        </label>
                        <input id="amount_per_participant" type="number" step="0.01"
                               class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('amount_per_participant') border-red-500 @enderror"
                               name="amount_per_participant" value="{{ old('amount_per_participant') }}" required>
                        @error('amount_per_participant')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="max_participants" class="block text-gray-700 text-sm font-bold mb-2">
                            Nombre maximum de participants
                        </label>
                        <input id="max_participants" type="number"
                               class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('max_participants') border-red-500 @enderror"
                               name="max_participants" value="{{ old('max_participants') }}" required min="2">
                        @error('max_participants')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">
                            Date de début de la tontine
                        </label>
                        <input id="start_date" type="date"
                               class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('start_date') border-red-500 @enderror"
                               name="start_date" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="{{ route('manager.dashboard') }}" class="text-gray-600 mr-4 hover:text-gray-800">
                            Annuler
                        </a>
                        <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Créer la tontine
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
