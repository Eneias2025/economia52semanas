<?php
/*
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\DepositoController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [PlanoController::class, 'index'])->name('dashboard');
    Route::get('/plano', [PlanoController::class, 'index'])->name('plano.index');
    Route::get('/plano/create', [PlanoController::class, 'create'])->name('plano.create');
    Route::post('/plano', [PlanoController::class, 'store'])->name('plano.store');
    Route::post('/depositar/{deposito}', [PlanoController::class, 'depositar'])->name('depositar');
    Route::patch('/deposito/{id}/marcar', [DepositoController::class, 'marcarComoFeito'])->name('deposito.marcar');
    Route::patch('/deposito/{id}/desfazer', [DepositoController::class, 'desfazer'])->name('deposito.desfazer');

    Route::get('/plano/create', [PlanoController::class, 'create'])->name('plano.create');
    Route::post('/plano', [PlanoController::class, 'store'])->name('plano.store');
    Route::delete('/plano/{plano}', [PlanoController::class, 'destroy'])->name('plano.destroy');




});

require __DIR__.'/auth.php';
