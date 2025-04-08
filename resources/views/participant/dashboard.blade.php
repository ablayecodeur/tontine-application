@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tableau de bord Participant</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <h4>Mes Tontines</h4>
                            @if($participations->isEmpty())
                                <p>Vous ne participez à aucune tontine pour le moment.</p>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Montant</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($participations as $participation)
                                        <tr>
                                            <td>{{ $participation->tontine->name }}</td>
                                            <td>{{ number_format($participation->tontine->amount_per_participant, 2) }} FCFA</td>
                                            <td>
                                                <span class="badge bg-{{ $participation->status === 'active' ? 'success' : 'warning' }}">
                                                    {{ $participation->status === 'active' ? 'Actif' : 'En attente' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary">Voir</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="col-md-4">
                            @include('shared.notifications')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
