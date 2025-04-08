@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-800 py-4 px-6">
            <h1 class="text-white text-xl font-bold">Tontines disponibles</h1>
        </div>

        <div class="p-6">
            @if($tontines->isEmpty())
                <p class="text-gray-500">Aucune tontine disponible pour le moment.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($tontines as $tontine)
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="bg-gray-100 px-4 py-3 border-b">
                            <h3 class="font-semibold text-lg">{{ $tontine->name }}</h3>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-700 mb-2">
                                <span class="font-medium">Montant:</span>
                                {{ number_format($tontine->amount_per_participant, 2) }} FCFA
                            </p>
                            <p class="text-gray-700 mb-2">
                                <span class="font-medium">Participants:</span>
                                {{ $tontine->activeParticipants()->count() }}/{{ $tontine->max_participants }}
                            </p>
                            <p class="text-gray-700 mb-4">
                                <span class="font-medium">Gérée par:</span>
                                {{ $tontine->manager->name }}
                            </p>

                            <button onclick="document.getElementById('join-form-{{ $tontine->id }}').classList.toggle('hidden')"
                                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                                Rejoindre
                            </button>

                            <div id="join-form-{{ $tontine->id }}" class="hidden mt-4 p-4 bg-gray-50 rounded">
                                <form method="POST" action="{{ route('participant.tontines.join') }}">
                                    @csrf
                                    <input type="hidden" name="tontine_id" value="{{ $tontine->id }}">

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2">Méthode de paiement</label>
                                        <select name="payment_method" class="form-select w-full" required>
                                            <option value="">Choisir...</option>
                                            <option value="wave">Wave</option>
                                            <option value="orange_money">Orange Money</option>
                                            <option value="cash">Espèces</option>
                                        </select>
                                    </div>

                                    <div class="mb-4" id="transaction-number-field">
                                        <label class="block text-gray-700 text-sm font-bold mb-2">Numéro de transaction</label>
                                        <input type="text" name="transaction_number" class="form-input w-full">
                                    </div>

                                    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                                        Soumettre la demande
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethodSelects = document.querySelectorAll('select[name="payment_method"]');

        paymentMethodSelects.forEach(select => {
            select.addEventListener('change', function() {
                const transactionField = this.closest('form').querySelector('#transaction-number-field');
                if (this.value === 'wave' || this.value === 'orange_money') {
                    transactionField.style.display = 'block';
                    transactionField.querySelector('input').setAttribute('required', 'required');
                } else {
                    transactionField.style.display = 'none';
                    transactionField.querySelector('input').removeAttribute('required');
                }
            });
        });
    });
</script>
@endsection
