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
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-gray-500">Messages non lus</h3>
            <p class="text-2xl font-bold">{{ App\Models\ContactMessage::where('is_read', false)->count() }}</p>
            <a href="{{ route('super_admin.contact_messages') }}" class="text-sm text-blue-600 hover:text-blue-800 mt-2 inline-block">
                Voir tous les messages
            </a>
        </div>
    </div>
    <!-- Ajoutez une section pour les derniers messages -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Derniers messages</h2>

        @php
            $recentMessages = App\Models\ContactMessage::latest()->take(5)->get();
        @endphp

        @if($recentMessages->isEmpty())
            <p class="text-gray-500">Aucun message récent</p>
        @else
            <div class="space-y-4">
                @foreach($recentMessages as $message)
                <div class="border-b border-gray-200 pb-4 {{ !$message->is_read ? 'bg-blue-50 p-3 rounded' : '' }}">
                    <div class="flex justify-between">
                        <h3 class="font-medium">{{ $message->name }} - {{ $message->subject }}</h3>
                        <span class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($message->message, 100) }}</p>
                    <a href="{{ route('super_admin.contact_messages.show', $message) }}" class="text-sm text-blue-600 hover:text-blue-800 mt-2 inline-block">
                        Voir le message complet
                    </a>
                </div>
                @endforeach
            </div>
        @endif
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
