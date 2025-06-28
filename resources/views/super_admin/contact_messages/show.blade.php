@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Message de {{ $message->name }}</h1>
        <a href="{{ route('super_admin.contact_messages') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left mr-2"></i> Retour
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Nom</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $message->name }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Email</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $message->email }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Sujet</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $message->subject }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Date</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $message->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-sm font-medium text-gray-500">Message</h3>
            <div class="mt-1 p-4 bg-gray-50 rounded-md">
                <p class="text-sm text-gray-900 whitespace-pre-line">{{ $message->message }}</p>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="mailto:{{ $message->email }}?subject=RE: {{ $message->subject }}" class="btn btn-primary">
                <i class="fas fa-reply mr-2"></i> Répondre
            </a>
            <form action="{{ route('super_admin.contact_messages.destroy', $message) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash mr-2"></i> Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
