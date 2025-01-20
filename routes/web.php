<?php

use Fpdf\Fpdf;
use App\Http\Controllers\chatController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    return view('welcome');
    // return view('test');
});
Route::get('/test', [dashboardController::class, 'test'])->name('test');
Route::get('/tehsils', function(){
    $tehsils = DB::table('tehsils')->get(['ID', 'Teh_name']);
    return response()->json($tehsils);
    
});

Route::get('/districts', function(){
    $districts = DB::table('districts')->get(['ID', 'Dis_name']);
    return response()->json($districts);
});
Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/createnew', [dashboardController::class, 'createnew'])->middleware(['auth', 'isIndividual'])->name('createnew');
Route::post('/storenew', [dashboardController::class, 'storenew'])->middleware(['auth', 'isIndividual'])->name('storenew');
Route::get('/editnew/{id}', [dashboardController::class, 'editnew'])->middleware(['auth', 'isIndividual'])->name('editnew');
Route::post('/updatenew/{id}', [dashboardController::class, 'updatenew'])->middleware(['auth', 'isIndividual'])->name('updatenew');
Route::get('/applyverification', [dashboardController::class, 'applyverification'])->middleware(['auth', 'isIndividual'])->name('applyverification');
Route::post('/submitverifiation', [dashboardController::class, 'submitverification'])->middleware(['auth', 'isIndividual'])->name('submitverification');
Route::get('/editverification/{id}', [dashboardController::class, 'editverification'])->middleware(['auth', 'isIndividual'])->name('editverification');
Route::put('/updateverificationapp/{id}', [dashboardController::class, 'updateverificationapp'])->middleware(['auth', 'isIndividual'])->name('updateverificationapp');
Route::get('/editorgverification/{id}', [dashboardController::class, 'editorgverification'])->middleware(['auth', 'isOrganization'])->name('editorgverification');
Route::put('/updatorgverificationapp/{id}', [dashboardController::class, 'updateorgverificationapp'])->middleware(['auth', 'isOrganization'])->name('updateorgverificationapp');
Route::get('/applyorgverification', [dashboardController::class, 'applyorgverification'])->middleware(['auth', 'isOrganization'])->name('applyorgverification');
Route::post('/submitorgverifiation', [dashboardController::class, 'submitorgverification'])->middleware(['auth', 'isOrganization'])->name('submitorgverification');
Route::post('/updatestatus/{id}', [dashboardController::class, 'updatestatus'])->middleware(['auth', 'authorized'])->name('updatestatus');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'authorized')->group(function () {
    Route::get('/users/create', [userController::class, 'newuser'])->name('newuser');
    Route::get('/users', [userController::class, 'usersgrid'])->name('users.grid');
    Route::put('/user/update/{id}', [userController::class, 'update'])->name('users.update');
    Route::get('/users/edit/{id}', [userController::class, 'edit'])->name('users.edit');
    Route::post('/users/store', [userController::class, 'store'])->name('users.store');


    Route::get('/applications/chat/{id}', [chatController::class, 'index'])->withoutMiddleware('authorized')->name('chat');

    Route::post('/applications/submitchat/{id}', [chatController::class, 'submitchat'])->withoutMiddleware('authorized')->name('submitchat');
    
});
require __DIR__.'/auth.php';
