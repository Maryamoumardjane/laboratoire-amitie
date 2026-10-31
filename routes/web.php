<?php

use Illuminate\Support\Facades\Route;
use App\Models\Examen;
use App\Models\RendezVous;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ResultatController;
use App\Http\Controllers\TemoignageController;

// ===== ACCUEIL =====
Route::get('/', function () {
    $examens = Examen::all();
    return view('accueil', compact('examens'));
})->name('accueil');

// ===== APROPOS =====
Route::get('/apropos', function () {
    return view('apropos');
});

// ===== CONTACT =====
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// ===== EXAMENS =====
Route::get('/examens', [ExamenController::class, 'index']);
Route::get('/examens/create', [ExamenController::class, 'create']);
Route::post('/examens', [ExamenController::class, 'store']);
Route::get('/examens/{id}/edit', [ExamenController::class, 'edit']);
Route::put('/examens/{id}', [ExamenController::class, 'update']);
Route::delete('/examens/{id}', [ExamenController::class, 'destroy']);
Route::get('/admin/examens', [ExamenController::class, 'indexAdmin']);

// ===== RENDEZ-VOUS =====
Route::get('/rendezvous', [RendezVousController::class, 'index']);
Route::get('/admin/rendezvous', [RendezVousController::class, 'index']);
Route::get('/rendezvous/create', [RendezVousController::class, 'create']);
Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
Route::get('/rendezvous/{id}/edit', [RendezVousController::class, 'edit']);
Route::put('/rendezvous/{id}', [RendezVousController::class, 'update']);
Route::delete('/rendezvous/{id}', [RendezVousController::class, 'destroy']);
Route::put('/rendezvous/{id}/statut', [RendezVousController::class, 'updateStatut']);


// ===== EVENTS CALENDRIER =====
Route::get('/rendezvous/events', function () {
    return \App\Models\RendezVous::all()->map(function ($rdv) {
        return [
            'title' => $rdv->nom,
            'start' => $rdv->date_rdv . 'T' . $rdv->heure_rdv,
        ];
    });
});
Route::get('/admin/events', [RendezVousController::class, 'events']);

// ===== ADMIN DASHBOARD =====
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// ===== PATIENTS =====
Route::get('/admin/patients', [PatientController::class, 'index']);
Route::get('/admin/patients/create', [PatientController::class, 'create']);
Route::post('/admin/patients', [PatientController::class, 'store']);
Route::get('/admin/patients/{id}/edit', [PatientController::class, 'edit']);
Route::put('/admin/patients/{id}', [PatientController::class, 'update']);
Route::delete('/admin/patients/{id}', [PatientController::class, 'destroy']);

// ===== RÉSULTATS =====
Route::get('/admin/resultats', [ResultatController::class, 'index']);
Route::get('/admin/resultats/create', [ResultatController::class, 'create']);
Route::post('/admin/resultats', [ResultatController::class, 'store']);
Route::get('/resultats/telecharger', [ResultatController::class, 'telecharger']);
Route::post('/resultats/verifier', [ResultatController::class, 'verifier']);

// ===== TÉMOIGNAGES =====
Route::post('/temoignages', [TemoignageController::class, 'store'])->name('temoignages.store');
Route::get('/admin/temoignages', [TemoignageController::class, 'index']);
Route::put('/admin/temoignages/{id}/approuver', [TemoignageController::class, 'approuver']);
Route::delete('/admin/temoignages/{id}', [TemoignageController::class, 'destroy']);

// ===== CONTACTS ADMIN ===== ✅ ajout
Route::get('/admin/contacts', [ContactController::class, 'adminIndex']);
Route::put('/admin/contacts/{id}/lu', [ContactController::class, 'marquerLu']);
Route::delete('/admin/contacts/{id}', [ContactController::class, 'destroy']);


Route::get('/test-whatsapp', function () {
    $result = \App\Services\WhatsappService::send('+237675858239', 'Test WhatsApp depuis le vrai numéro 🏥');
    dd($result);
});

Route::get('/test-wa2', function () {
    dd(
        env('WHATSAPP_PHONE_NUMBER_ID'),
        env('WHATSAPP_TOKEN')
    );
});