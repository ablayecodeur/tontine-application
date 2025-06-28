<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tontine;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // ← cette ligne est importante

class SuperAdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('super_admin');
    // }

    // Dashboard Super Admin
    public function dashboard()
    {
        $stats = [
            'users_count' => User::count(),
            'managers_count' => User::where('role', 'manager')->count(),
            'participants_count' => User::where('role', 'participant')->count(),
            'tontines_count' => Tontine::count(),
            'active_tontines' => Tontine::where('status', 'active')->count()
        ];

        return view('super_admin.dashboard', compact('stats'));
    }

    // Gestion des utilisateurs
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('super_admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('super_admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users',
            'role' => 'required|in:manager,participant,super_admin',
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => $validated['role'],
            'password' => bcrypt($validated['password'])
        ]);

        return redirect()->route('super_admin.users')->with('success', 'Utilisateur créé avec succès');
    }

    public function editUser(User $user)
    {
        return view('super_admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|string|unique:users,phone,'.$user->id,
            'role' => 'required|in:manager,participant,super_admin'
        ]);

        $user->update($validated);

        return redirect()->route('super_admin.users')->with('success', 'Utilisateur mis à jour');
    }

    public function destroyUser(User $user)
    {
        // Empêcher la suppression de soi-même
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte');
        }

        $user->delete();
        return back()->with('success', 'Utilisateur supprimé');
    }

    // Gestion des tontines
    public function tontines()
    {
        $tontines = Tontine::with(['manager', 'participants'])->latest()->paginate(10);
        return view('super_admin.tontines.index', compact('tontines'));
    }

    public function editTontine(Tontine $tontine)
    {
        $managers = User::where('role', 'manager')->get();
        return view('super_admin.tontines.edit', compact('tontine', 'managers'));
    }

    public function updateTontine(Request $request, Tontine $tontine)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount_per_participant' => 'required|numeric|min:1000',
            'max_participants' => 'required|integer|min:2',
            'manager_id' => 'required|exists:users,id',
            'is_active' => 'required|boolean'
        ]);

        $tontine->update($validated);

        return redirect()->route('super_admin.tontines')->with('success', 'Tontine mise à jour');
    }

    public function destroyTontine(Tontine $tontine)
    {
        $tontine->delete();
        return back()->with('success', 'Tontine supprimée');
    }

    public function contactMessages()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('super_admin.contact_messages.index', compact('messages'));
    }

    public function showContactMessage(ContactMessage $message)
    {
        // Marquer comme lu
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('super_admin.contact_messages.show', compact('message'));
    }

    public function destroyContactMessage(ContactMessage $message)
    {
        $message->delete();
        return back()->with('success', 'Message supprimé avec succès');
    }
}
