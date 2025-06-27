@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Modifier la Tontine: {{ $tontine->name }}</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('super_admin.tontines.update', $tontine) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom de la tontine</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $tontine->name) }}" required
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="manager_id" class="block text-sm font-medium text-gray-700">Manager</label>
                    <select name="manager_id" id="manager_id" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @foreach($managers as $manager)
                            <option value="{{ $manager->id }}" {{ $tontine->manager_id == $manager->id ? 'selected' : '' }}>
                                {{ $manager->name }} ({{ $manager->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="amount_per_participant" class="block text-sm font-medium text-gray-700">Montant par participant (FCFA)</label>
                    <input type="number" name="amount_per_participant" id="amount_per_participant"
                           value="{{ old('amount_per_participant', $tontine->amount_per_participant) }}" required min="1000"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="max_participants" class="block text-sm font-medium text-gray-700">Nombre maximum de participants</label>
                    <input type="number" name="max_participants" id="max_participants"
                           value="{{ old('max_participants', $tontine->max_participants) }}" required min="2"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="is_active" class="block text-sm font-medium text-gray-700">Statut</label>
                    <select name="is_active" id="is_active" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="1" {{ $tontine->is_active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$tontine->is_active ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('super_admin.tontines') }}" class="btn btn-outline-primary mr-3">
                    Annuler
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
