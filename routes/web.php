<?php
use EvoSys21\PdfLib\Multicell;
use EvoSys21\PdfLib\Fpdf\Pdf; // Pdf extends FPDF
use Fpdf\Fpdf;

use App\Http\Controllers\chatController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/createnew', [dashboardController::class, 'createnew'])->middleware(['auth', 'verified'])->name('createnew');
Route::post('/storenew', [dashboardController::class, 'storenew'])->middleware(['auth', 'verified'])->name('storenew');
Route::get('/applyverification', [dashboardController::class, 'applyverification'])->middleware(['auth', 'isIndividual'])->name('applyverification');
Route::get('/applyorgverification', [dashboardController::class, 'applyorgverification'])->middleware(['auth', 'isOrganization'])->name('applyorgverification');
Route::post('/submitverifiation', [dashboardController::class, 'submitverification'])->middleware(['auth', 'isIndividual'])->name('submitverification');
Route::post('/submitorgverifiation', [dashboardController::class, 'submitorgverification'])->middleware(['auth', 'isOrganization'])->name('submitorgverification');
Route::post('/updatestatus/{id}', [dashboardController::class, 'updatestatus'])->middleware(['auth', 'verified'])->name('updatestatus');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/users/create', [userController::class, 'newuser'])->name('newuser');
    Route::get('/users', [userController::class, 'usersgrid'])->name('users.grid');
    Route::put('/user/update/{id}', [userController::class, 'update'])->name('users.update');
    Route::get('/users/edit/{id}', [userController::class, 'edit'])->name('users.edit');
    Route::post('/users/store', [userController::class, 'store'])->name('users.store');


    Route::get('/applications/chat/{id}', [chatController::class, 'index'])->name('chat');

    Route::post('/applications/submitchat/{id}', [chatController::class, 'submitchat'])->name('submitchat');
    Route::get('/applications/certificate',function(){


// create the Pdf Object

// require 'vendor/autoload.php';

// Create a new PDF instance
$pdf = new Fpdf();

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', 'B', 16);

// Add a cell with text
$pdf->Cell(40, 10, 'Hello, World!');

// Output the PDF to the browser


// do some pdf initialization settings
// $pdf->SetMargins(20, 20, 20);


// create the Multicell Object
$path = storage_path('app/public/certificates/test.pdf');
$pdf->Output('F', $path);
    });
});
require __DIR__.'/auth.php';
