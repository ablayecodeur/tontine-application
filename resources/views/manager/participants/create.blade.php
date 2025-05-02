@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-800 py-4 px-6">
            <h1 class="text-white text-xl font-bold">
                @isset($tontine)
                    Ajouter un participant à: {{ $tontine->name }}
                @else
                    Ajouter un nouveau participant
                @endisset
            </h1>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ isset($tontine) ? route('manager.participants.store', ['tontine_id' => $tontine->id]) : route('manager.participants.store') }}">
                @csrf

                @if(isset($tontine))
                    <div class="mb-4">
                        <label for="tontine_id" class="block text-gray-700 text-sm font-bold mb-2">Tontine</label>
                        <select id="tontine_id" name="tontine_id" class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="">Sélectionner une tontine</option>
                            @foreach(auth()->user()->tontines as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom complet</label>
                    <input id="name" type="text" class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input id="email" type="email" class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="email">
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Téléphone</label>
                    <input id="phone" type="text" class="w-full border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="phone" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Méthode de paiement</label>
                    <div class="flex items-center space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio text-blue-600" name="payment_method" value="cash" checked>
                            <span class="ml-2">Espèces</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <a href="{{ isset($tontine) ? route('manager.tontines.show', $tontine) : route('manager.dashboard') }}"
                       class="text-gray-600 mr-4 hover:text-gray-800">
                        Annuler
                    </a>
                    <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
