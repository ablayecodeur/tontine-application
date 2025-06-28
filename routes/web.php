<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TontineController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ContactController;
use App\Models\User;
use App\Models\Tontine;
use App\Models\Participant;
use App\Models\Payment;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [App\Http\Controllers\HomeController::class, 'accueil'])->name('accueil');
Route::get('/tontines', [App\Http\Controllers\TontineController::class, 'publicIndex'])->name('tontines.public');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Redirection après connexion
    Route::get('/home', [DashboardController::class, 'redirect'])->name('home');

    // Routes du gérant
    Route::prefix('manager')->middleware('manager')->group(function () {
        Route::get('dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');

        // Page de confirmation (affiche draw.blade.php)
    Route::get('tontines/{tontine}/draw', [TontineController::class, 'showDrawPage'])
    ->name('manager.tontines.draw');

    // Action réelle du tirage (traitement POST)
    Route::post('tontines/{tontine}/draw', [TontineController::class, 'performDraw'])
    ->name('manager.tontines.perform-draw');

    Route::post('participants', [ManagerController::class, 'storeParticipant'])
        ->name('manager.participants.store');

    Route::post('participants/{participant}/approve', [ManagerController::class, 'approveParticipant'])
        ->name('manager.participants.approve');

        // Gestion des tontines
        // Route resource pour les tontines
        Route::resource('tontines', TontineController::class)->names([
            'index' => 'manager.tontines.index',
            'create' => 'manager.tontines.create',
            'store' => 'manager.tontines.store',
            'show' => 'manager.tontines.show',
            'edit' => 'manager.tontines.edit',
            'update' => 'manager.tontines.update',
            'destroy' => 'manager.tontines.destroy'
        ]);
        //Route::post('tontines/{tontine}/draw', [TontineController::class, 'drawWinner'])->name('tontines.draw');

        // Gestion des participants
        Route::get('participants', [ManagerController::class, 'participants'])->name('manager.participants.index');
        Route::get('participants/create', [ManagerController::class, 'createParticipant'])->name('manager.participants.create');
        Route::post('participants', [ManagerController::class, 'storeParticipant'])->name('manager.participants.store');
        Route::post('participants/{participant}/approve', [ManagerController::class, 'approveParticipant'])->name('manager.participants.approve');

        // Gestion des paiements
        Route::post('payments/{payment}/verify', [PaymentController::class, 'verify'])->name('payments.verify');
    });

    // Routes du participant
    Route::prefix('participant')->middleware('participant')->group(function () {
        Route::get('dashboard', [ParticipantController::class, 'dashboard'])->name('participant.dashboard');
        Route::get('tontines', [ParticipantController::class, 'tontines'])->name('participant.tontines');
        Route::post('tontines/join', [ParticipantController::class, 'joinTontine'])->name('participant.tontines.join');
        Route::get('payments', [PaymentController::class, 'index'])->name('participant.payments');
        Route::post('payments', [PaymentController::class, 'store'])->name('participant.payments.store');
    });

    // Routes communes
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
});


// Routes Super Admin
Route::prefix('admin')->middleware(['auth', 'super_admin'])->group(function () {
    Route::get('dashboard', [SuperAdminController::class, 'dashboard'])->name('super_admin.dashboard');

    // Gestion des utilisateurs
    Route::get('users', [SuperAdminController::class, 'users'])->name('super_admin.users');
    Route::get('users/create', [SuperAdminController::class, 'createUser'])->name('super_admin.users.create');
    Route::post('users', [SuperAdminController::class, 'storeUser'])->name('super_admin.users.store');
    Route::get('users/{user}/edit', [SuperAdminController::class, 'editUser'])->name('super_admin.users.edit');
    Route::put('users/{user}', [SuperAdminController::class, 'updateUser'])->name('super_admin.users.update');
    Route::delete('users/{user}', [SuperAdminController::class, 'destroyUser'])->name('super_admin.users.destroy');

    // Gestion des tontines
    Route::get('tontines', [SuperAdminController::class, 'tontines'])->name('super_admin.tontines');
    Route::get('tontines/{tontine}/edit', [SuperAdminController::class, 'editTontine'])->name('super_admin.tontines.edit');
    Route::put('tontines/{tontine}', [SuperAdminController::class, 'updateTontine'])->name('super_admin.tontines.update');
    Route::delete('tontines/{tontine}', [SuperAdminController::class, 'destroyTontine'])->name('super_admin.tontines.destroy');

    Route::get('contact-messages', [SuperAdminController::class, 'contactMessages'])->name('super_admin.contact_messages');
    Route::get('contact-messages/{message}', [SuperAdminController::class, 'showContactMessage'])->name('super_admin.contact_messages.show');
    Route::delete('contact-messages/{message}', [SuperAdminController::class, 'destroyContactMessage'])->name('super_admin.contact_messages.destroy');
});
