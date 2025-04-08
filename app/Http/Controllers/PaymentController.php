<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\Notification;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = auth()->user()->payments()
                        ->with('participant.tontine')
                        ->latest()
                        ->get();

        return view('participant.payments', compact('payments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tontine_id' => 'required|exists:tontines,id',
            'method' => 'required|in:wave,orange_money,cash',
            'transaction_number' => 'required_if:method,wave,orange_money'
        ]);

        $tontine = Tontine::findOrFail($validated['tontine_id']);

        // Créer la participation
        $participant = Participant::create([
            'user_id' => auth()->id(),
            'tontine_id' => $tontine->id,
            'status' => 'pending'
        ]);

        // Enregistrer le paiement
        $payment = Payment::create([
            'participant_id' => $participant->id,
            'method' => $validated['method'],
            'transaction_number' => $validated['transaction_number'] ?? null,
            'amount' => $tontine->amount_per_participant,
            'status' => 'pending'
        ]);

        // Notifier le gérant
        Notification::create([
            'user_id' => $tontine->manager_id,
            'type' => 'payment_request',
            'message' => 'Nouveau paiement en attente pour la tontine: '.$tontine->name,
            'notifiable_id' => $payment->id,
            'notifiable_type' => Payment::class
        ]);

        return redirect()->route('participant.dashboard')
            ->with('success', 'Paiement enregistré avec succès! En attente de validation.');
    }

    public function verify(Payment $payment)
    {
        $this->authorize('verify', $payment);

        $payment->markAsVerified();

        // Notifier le participant
        Notification::create([
            'user_id' => $payment->participant->user_id,
            'type' => 'payment_verified',
            'message' => 'Votre paiement pour la tontine '.$payment->participant->tontine->name.' a été validé',
            'notifiable_id' => $payment->id,
            'notifiable_type' => Payment::class
        ]);

        return back()->with('success', 'Paiement validé avec succès');
    }
}
