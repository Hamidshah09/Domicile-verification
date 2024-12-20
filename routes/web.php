<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/createnew', [dashboardController::class, 'createnew'])->middleware(['auth', 'verified'])->name('createnew');
Route::post('/storenew', [dashboardController::class, 'storenew'])->middleware(['auth', 'verified'])->name('storenew');
Route::get('/applyverification', [dashboardController::class, 'applyverification'])->middleware(['auth', 'verified'])->name('applyverification');
Route::post('/submitverifiation', [dashboardController::class, 'submitverification'])->middleware(['auth', 'verified'])->name('submitverification');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
