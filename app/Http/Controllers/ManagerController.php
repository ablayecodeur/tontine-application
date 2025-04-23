<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use App\Models\Participant;
use App\Models\Payment;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // Statistiques principales
        $stats = [
            'tontines_count' => $user->managedTontines()->count(),
            'active_participants' => Participant::whereIn('tontine_id', $user->managedTontines()->pluck('id'))
                                    ->where('status', 'active')
                                    ->count(),
            'pending_payments' => Payment::whereIn('participant_id',
                                        Participant::whereIn('tontine_id', $user->managedTontines()->pluck('id'))
                                        ->pluck('id'))
                                    ->where('status', 'pending')
                                    ->count(),
            'total_collected' => Payment::whereIn('participant_id',
                                        Participant::whereIn('tontine_id', $user->managedTontines()->pluck('id'))
                                        ->pluck('id'))
                                    ->where('status', 'verified')
                                    ->sum('amount'),
        ];

        // Dernières tontines
        $tontines = $user->managedTontines()
                    ->withCount(['activeParticipants', 'pendingParticipants'])
                    ->latest()
                    ->take(5)
                    ->get();

        // Participants en attente
        $pendingParticipants = Participant::whereIn('tontine_id', $user->managedTontines()->pluck('id'))
                                ->where('status', 'pending')
                                ->with(['user', 'tontine'])
                                ->latest()
                                ->take(5)
                                ->get();

        // Paiements récents
        $recentPayments = Payment::whereIn('participant_id',
                                    Participant::whereIn('tontine_id', $user->managedTontines()->pluck('id'))
                                    ->pluck('id'))
                                ->with(['participant.user', 'participant.tontine'])
                                ->latest()
                                ->take(5)
                                ->get();

        return view('manager.dashboard', compact(
            'stats',
            'tontines',
            'pendingParticipants',
            'recentPayments'
        ));
    }

    // app/Http/Controllers/ManagerController.php

    public function participants()
    {
        $tontines = auth()->user()->managedTontines()->pluck('id');

        $participants = Participant::whereIn('tontine_id', $tontines)
                        ->with(['user', 'tontine'])
                        ->latest()
                        ->paginate(10);

        return view('manager.participants.index', compact('participants'));
    }

    public function createParticipant(){
        return view('manager.participants.create');
    }

        // app/Http/Controllers/ManagerController.php

        public function approveParticipant(Participant $participant)
        {
            // Vérification des droits
            if ($participant->tontine->manager_id !== auth()->id()) {
                abort(403, 'Action non autorisée');
            }

            // Mise à jour du participant
            $participant->update(['status' => 'active']); // Utilisez 'approved' au lieu de 'active'

            // Mise à jour ou création du paiement
            $payment = $participant->payment()->firstOrNew();
            $payment->fill([
                'status' => 'verified',
                'verified_by' => auth()->id(),
                'verified_at' => now()
            ])->save();

            // Notification
            Notification::create([
                'user_id' => $participant->user_id,
                'type' => 'participation_approved',
                'title' => 'Participation approuvée',
                'message' => 'Votre participation à "'.$participant->tontine->name.'" a été approuvée',
                'notifiable_id' => $participant->id,
                'notifiable_type' => Participant::class
            ]);

            return back()->with('success', 'Participant approuvé');
        }

    // app/Http/Controllers/ManagerController.php

public function storeParticipant(Request $request)
{
    $validated = $request->validate([
        'tontine_id' => 'required|exists:tontines,id',
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|unique:users,email',
        'phone' => 'required|string|max:20|unique:users,phone',
        'payment_method' => 'required|in:cash,wave,orange_money',
        'transaction_reference' => 'required_if:payment_method,wave,orange_money'
    ]);

    // Vérifier que l'utilisateur est bien le gérant de la tontine
    $tontine = Tontine::findOrFail($validated['tontine_id']);
    if ($tontine->manager_id !== auth()->id()) {
        abort(403, 'Vous ne gérez pas cette tontine');
    }

    // Créer ou trouver l'utilisateur
    $user = User::firstOrCreate(
        ['phone' => $validated['phone']],
        [
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'password' => bcrypt(Str::random(10)),
            'role' => 'participant'
        ]
    );

    // Créer la participation
    $participant = Participant::create([
        'user_id' => $user->id,
        'tontine_id' => $tontine->id,
        'status' => 'active' // Auto-approuvé si créé par le gérant
    ]);

    // Enregistrer le paiement
    if ($validated['payment_method'] !== 'cash') {
        Payment::create([
            'participant_id' => $participant->id,
            'method' => $validated['payment_method'],
            'transaction_number' => $validated['transaction_reference'],
            'amount' => $tontine->amount_per_participant,
            'status' => 'verified' // Auto-validé si créé par le gérant
        ]);
    }

    return redirect()->route('manager.tontines.show', $tontine)
        ->with('success', 'Participant ajouté avec succès');
}
}
