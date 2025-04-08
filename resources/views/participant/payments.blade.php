@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-800 py-4 px-6">
            <h1 class="text-white text-xl font-bold">Mes Paiements</h1>
        </div>

        <div class="p-6">
            @if($payments->isEmpty())
                <p class="text-gray-500">Aucun paiement enregistré.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Tontine</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Montant</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Méthode</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Statut</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $payment->participant->tontine->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ number_format($payment->amount, 2) }} FCFA</td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    @if($payment->method === 'wave')
                                        Wave
                                    @elseif($payment->method === 'orange_money')
                                        Orange Money
                                    @else
                                        Espèces
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        {{ $payment->status === 'verified' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $payment->status === 'verified' ? 'Validé' : 'En attente' }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $payment->created_at->format('d/m/Y H:i') }}</td>
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
