@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-primary-700">Toutes les Tontines</h1>

            <div class="mt-4 md:mt-0">
                <a href="{{ route('register') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i> Créer une tontine
                </a>
            </div>
        </div>

        <!-- Barre de recherche et filtres -->
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
            <form action="{{ route('tontines.public') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <input type="text" name="search" placeholder="Rechercher une tontine..."
                               class="w-full px-4 py-2 border rounded-md"
                               value="{{ request('search') }}">
                    </div>
                    <div>
                        <select name="amount" class="w-full px-4 py-2 border rounded-md">
                            <option value="">Trier par montant</option>
                            <option value="asc" {{ request('amount') == 'asc' ? 'selected' : '' }}>Moins cher</option>
                            <option value="desc" {{ request('amount') == 'desc' ? 'selected' : '' }}>Plus cher</option>
                        </select>
                    </div>
                    <div>
                        <select name="participants" class="w-full px-4 py-2 border rounded-md">
                            <option value="">Trier par participants</option>
                            <option value="asc" {{ request('participants') == 'asc' ? 'selected' : '' }}>Moins de participants</option>
                            <option value="desc" {{ request('participants') == 'desc' ? 'selected' : '' }}>Plus de participants</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end space-x-2">
                    <button type="submit" class="btn btn-primary px-6">
                        <i class="fas fa-filter mr-2"></i> Filtrer
                    </button>
                    <a href="{{ route('tontines.public') }}" class="btn btn-outline-primary px-6">
                        <i class="fas fa-sync-alt mr-2"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        <!-- Liste des tontines -->
        @if($tontines->isEmpty())
            <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                <i class="fas fa-info-circle text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700">Aucune tontine trouvée</h3>
                <p class="text-gray-500 mt-2">Essayez de modifier vos critères de recherche</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tontines as $tontine)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $tontine->name }}</h3>
                            <span class="bg-primary-100 text-primary-800 text-xs px-2 py-1 rounded-full">
                                {{ $tontine->active_participants_count }} participants
                            </span>
                        </div>

                        <div class="flex items-center text-gray-600 mb-4">
                            <i class="fas fa-money-bill-wave mr-2 text-primary-600"></i>
                            <span>{{ number_format($tontine->amount_per_participant, 0, ',', ' ') }} FCFA / participant</span>
                        </div>

                        <div class="flex items-center text-gray-600 mb-4">
                            <i class="fas fa-calendar-alt mr-2 text-primary-600"></i>
                            <span>Créée le {{ $tontine->created_at->format('d/m/Y') }}</span>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-500 mb-4">
                                Connectez-vous pour voir plus de détails et participer
                            </p>
                            <div class="flex space-x-2">
                                <a href="{{ route('login') }}" class="btn btn-outline-primary flex-1 text-center">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Connexion
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-primary flex-1 text-center">
                                    <i class="fas fa-user-plus mr-2"></i> Inscription
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $tontines->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
