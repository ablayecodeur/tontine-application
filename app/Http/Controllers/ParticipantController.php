<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use App\Models\Participant;
use App\Models\Payment;
use App\Models\Notification;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $participations = $user->participations()->with('tontine')->get();
        $tontines = Tontine::whereDoesntHave('participants', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('participant.dashboard', [
            'participations' => $participations,
            'tontines' => $tontines,
            'unreadNotifications' => $user->unreadNotifications()->count()
        ]);
    }

    public function tontines()
    {
        $tontines = Tontine::withCount(['activeParticipants'])
            ->whereDoesntHave('participants', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();

        return view('participant.tontines', compact('tontines'));
    }

    public function joinTontine(Request $request)
    {
        $request->validate([
            'tontine_id' => 'required|exists:tontines,id',
            'payment_method' => 'required|in:wave,orange_money,cash',
            'transaction_number' => 'required_if:payment_method,wave,orange_money'
        ]);

        $tontine = Tontine::findOrFail($request->tontine_id);

        $participant = Participant::create([
            'user_id' => auth()->id(),
            'tontine_id' => $tontine->id,
            'status' => 'pending'
        ]);

        if ($request->payment_method !== 'cash') {
            Payment::create([
                'participant_id' => $participant->id,
                'method' => $request->payment_method,
                'transaction_number' => $request->transaction_number,
                'amount' => $tontine->amount_per_participant,
                'status' => 'pending'
            ]);
        }

        // Notification au gérant
        Notification::create([
            'user_id' => $tontine->manager_id,
            'type' => 'participation_request',
            'message' => 'Nouvelle demande de participation à votre tontine: '.$tontine->name,
            'notifiable_id' => $participant->id,
            'notifiable_type' => Participant::class
        ]);

        return redirect()->route('participant.dashboard')
            ->with('success', 'Demande de participation envoyée!');
    }
}
