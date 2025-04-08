<div class="card">
    <div class="card-header">
        Notifications
        @if($unreadNotifications > 0)
            <span class="badge bg-danger">{{ $unreadNotifications }}</span>
        @endif
    </div>
    <div class="card-body">
        @forelse(auth()->user()->notifications->take(5) as $notification)
            <div class="alert alert-{{ $notification->is_read ? 'light' : 'info' }}">
                <h6>{{ $notification->message }}</h6>
                <small>{{ $notification->created_at->diffForHumans() }}</small>
                @if(!$notification->is_read)
                    <form method="POST" action="{{ route('notifications.read', $notification) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-link">Marquer comme lu</button>
                    </form>
                @endif
            </div>
        @empty
            <p>Aucune notification</p>
        @endforelse
    </div>
</div>
