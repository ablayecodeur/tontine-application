@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tableau de bord Super Admin</h1>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-gray-500">Utilisateurs</h3>
            <p class="text-2xl font-bold">{{ $stats['users_count'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-gray-500">Managers</h3>
            <p class="text-2xl font-bold">{{ $stats['managers_count'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-gray-500">Participants</h3>
            <p class="text-2xl font-bold">{{ $stats['participants_count'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-gray-500">Tontines</h3>
            <p class="text-2xl font-bold">{{ $stats['tontines_count'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-gray-500">Tontines actives</h3>
            <p class="text-2xl font-bold">{{ $stats['active_tontines'] }}</p>
        </div>
    </div>

    <!-- Liens rapides -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('super_admin.users') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
            <h2 class="text-xl font-semibold text-blue-600 mb-2">Gestion des utilisateurs</h2>
            <p class="text-gray-600">Gérer tous les utilisateurs du système</p>
        </a>
        <a href="{{ route('super_admin.tontines') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
            <h2 class="text-xl font-semibold text-blue-600 mb-2">Gestion des tontines</h2>
            <p class="text-gray-600">Voir et modifier toutes les tontines</p>
        </a>
    </div>
</div>
@endsection
