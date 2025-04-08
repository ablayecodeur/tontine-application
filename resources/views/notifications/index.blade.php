@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-800 py-4 px-6">
            <h1 class="text-white text-xl font-bold">Mes Notifications</h1>
        </div>

        <div class="p-6">
            @if($notifications->isEmpty())
                <p class="text-gray-500">Aucune notification.</p>
            @else
                <div class="space-y-4">
                    @foreach($notifications as $notification)
                    <div class="border rounded-lg overflow-hidden
                        {{ $notification->is_read ? 'bg-gray-50' : 'bg-blue-50 border-blue-200' }}">
                        <div class="p-4 flex justify-between items-start">
                            <div>
                                <p class="{{ $notification->is_read ? 'text-gray-700' : 'text-blue-800 font-medium' }}">
                                    {{ $notification->message }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                            @if(!$notification->is_read)
                            <form method="POST" action="{{ route('notifications.read', $notification) }}">
                                @csrf
                                <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm">
                                    Marquer comme lu
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
