<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()
                              ->latest()
                              ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        //$this->authorize('update', $notification);

        $notification->markAsRead();

        return back()->with('success', 'Notification marquée comme lue');
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications()->update(['is_read' => true]);

        return back()->with('success', 'Toutes les notifications marquées comme lues');
    }
}
