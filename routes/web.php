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

Route::get('/', function () {
    return view('auth.login');
});

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

            /// Route pour effectuer un tirage au sort
    Route::get('tontines/{tontine}/draw', [TontineController::class, 'draw'])
    ->name('manager.tontines.draw');

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
        Route::post('tontines/{tontine}/draw', [TontineController::class, 'drawWinner'])->name('tontines.draw');

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
