<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Pages principales Livewire
use App\Livewire\Pages\HomeIndex;
use App\Livewire\Pages\Documents;
use App\Livewire\Pages\About;

// Militaires CRUD
use App\Livewire\Militaire\MilList;
use App\Livewire\Militaire\MilForm;
use App\Livewire\Militaire\MilShow;
use App\Livewire\Militaire\MilEdit;
use App\Livewire\Militaire\MilWiki;
use App\Livewire\Militaire\ListRetraiteMilitaires;
use App\Livewire\Militaire\MilDecede;


// Documents CRUD
use App\Livewire\Pages\DocumentsCreate;
use App\Livewire\Pages\DocumentsEdit;
use App\Livewire\Pages\DocumentsShow;

// Commandement & Haut état-major
use App\Livewire\Pages\Comdt\Cemg;
use App\Livewire\Pages\Comdt\CemgAdjtOpsRens;
use App\Livewire\Pages\Comdt\CemgAdjtAdmLog;

// Santé militaire
use App\Livewire\Pages\Sante\SanteIndex;
use App\Livewire\Pages\Sante\Details\SanteShow;

// Commandants Suprêmes
use App\Livewire\Pages\Commandants\Index as CommandantsIndex;
use App\Livewire\Pages\Commandants\Show as CommandantsShow;

// Profils utilisateurs
use App\Livewire\Users\Profile\Show as UserProfileShow;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Superadmin\Dashboard as SuperAdminDashboard;
use App\Livewire\Superviseur\Dashboard as SuperviseurDashboard;
use App\Livewire\Agent\Dashboard as AgentDashboard;
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\CheckpointAccess;

use App\Livewire\Militaire\Communication;
use App\Livewire\Militaire\Drones;
use App\Livewire\Militaire\Logistique;

use App\Livewire\Chat\Chat;
use App\Livewire\Chat\FriendRequest;

Route::middleware(['auth'])->group(function () {
    Route::get('/friends', FriendRequest::class)->name('friends.index');
    Route::get('/chat', Chat::class)->name('chat.index');
});

Route::get('/militaire/communication-securisee', Communication::class)->name('militaire.communication');
Route::get('/militaire/technologies-drones', Drones::class)->name('militaire.drones');
Route::get('/militaire/modernisation-logistique', Logistique::class)->name('militaire.logistique');


// Page de checkpoint à la racine
Route::get('/checkpoint', CheckpointAccess::class)->name('checkpoint.form');



Route::get('/', HomeIndex::class)->name('home');



Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
});

Route::middleware(['auth', 'role:super_admin'])->group(function(){
    Route::get('/superadmin/dashboard', SuperAdminDashboard::class)->name('superadmin.dashboard');
});

Route::middleware(['auth', 'role:superviseur'])->group(function(){
    Route::get('/superviseur/dashboard', SuperviseurDashboard::class)->name('superviseur.dashboard');
});

Route::middleware(['auth', 'role:agent'])->group(function(){
    Route::get('/agent/dashboard', AgentDashboard::class)->name('agent.dashboard');
});


/*
|--------------------------------------------------------------------------
| PAGE PUBLIQUES
|--------------------------------------------------------------------------
*/

// Page About (publique)
Route::get('/about/{slug}', About::class)->name('about.fardc');

// Profil public d’un utilisateur
Route::get('/users/profile/{id}', UserProfileShow::class)->name('profile.show');

Route::get('/retraites', ListRetraiteMilitaires::class)->name('mil.retraite');


/*
|--------------------------------------------------------------------------
| TABLEAU DE BORD (connecté & vérifié)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/operation-militaire-secrete-2025', HomeIndex::class)->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| MILITAIRES — CRUD complet (connecté & rôle)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('mil')->group(function () {
    Route::get('/military', MilList::class)->name('mil.list');
    Route::get('/create', MilForm::class)->name('mil.create');
    Route::get('/{slug}', MilShow::class)->name('militaire.show');
    Route::get('/{slug}/edit', MilEdit::class)->name('militaire.edit');
    Route::get('/{slug}/wiki', MilWiki::class)->name('militaire.wiki');
    Route::get('/militaires/d-e-c-e-d-es', MilDecede::class)->name('mil.decede');

});

/*
|--------------------------------------------------------------------------
| DOCUMENTS — CRUD (connecté & rôle)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin|officier|archiviste'])->group(function () {
    Route::get('/documents', Documents::class)->name('documents.index');
    Route::get('/documents/create', DocumentsCreate::class)->name('documents.create');
    Route::get('/documents/{slug}', DocumentsShow::class)->name('documents.show');
    Route::get('/documents/{document}/edit', DocumentsEdit::class)->name('documents.edit');
});

/*
|--------------------------------------------------------------------------
| SANTÉ MILITAIRE (connecté & rôle)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin|medecin'])->group(function () {
    Route::get('/sante', SanteIndex::class)->name('sante.index');
    Route::get('/sante/{slug}', SanteShow::class)->name('sante.show');
});

/*
|--------------------------------------------------------------------------
| HAUT COMMANDEMENT (connecté & rôle)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin|haut_commandement'])->group(function () {
    Route::get('/cemg', Cemg::class)->name('cemg');
    Route::get('/cemg-adjoint-operations-renseignements', CemgAdjtOpsRens::class)->name('cemg.adjt.ops.rens');
    Route::get('/cemg-adjoint-administration-logistique', CemgAdjtAdmLog::class)->name('cemg.adjt.adm.log');
});

/*
|--------------------------------------------------------------------------
| COMMANDANTS SUPRÊMES (connecté & rôle)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin|haut_commandement'])->group(function () {
    Route::get('/commandants', CommandantsIndex::class)->name('commandants.index');
    Route::get('/commandants/{slug}', CommandantsShow::class)->name('commandants.show');
});

/*
|--------------------------------------------------------------------------
| PROFIL UTILISATEUR (connecté)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| ROUTE DE SECOURS (404)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return view('errors.404'); // Crée resources/views/errors/404.blade.php
});