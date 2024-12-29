<?php

use Fpdf\Fpdf;
use App\Http\Controllers\chatController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    return view('welcome');
    // return view('test');
});

Route::get('/dashboard', [dashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/createnew', [dashboardController::class, 'createnew'])->middleware(['auth', 'verified'])->name('createnew');
Route::post('/storenew', [dashboardController::class, 'storenew'])->middleware(['auth', 'verified'])->name('storenew');
Route::get('/applyverification', [dashboardController::class, 'applyverification'])->middleware(['auth', 'isIndividual'])->name('applyverification');
Route::get('/applyorgverification', [dashboardController::class, 'applyorgverification'])->middleware(['auth', 'isOrganization'])->name('applyorgverification');
Route::post('/submitverifiation', [dashboardController::class, 'submitverification'])->middleware(['auth', 'isIndividual'])->name('submitverification');
Route::post('/submitorgverifiation', [dashboardController::class, 'submitorgverification'])->middleware(['auth', 'isOrganization'])->name('submitorgverification');
Route::post('/updatestatus/{id}', [dashboardController::class, 'updatestatus'])->middleware(['auth', 'authorized'])->name('updatestatus');

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

        $pdf = new Fpdf(); 
        $pdf->AddPage(); 
        $pdf->SetFont('Arial', 'B', 12); 
        $pdf->Cell(0, 6, 'GOVERNMENT OF PAKISTAN',0,1,'C');
        $pdf->Cell(0, 6, 'OFFICE OF THE DEPUTY COMMISSIONER',0,1,'C');
        $pdf->Cell(0, 6, 'ISLAMABAD CAPITAL TERRITORY',0,1,'C'); 
        $pdf->Cell(0, 6, '****',0,1,'C');
        
        $pdf->SetFont('Arial','', 12); 
        $pdf->Cell(50, 6, 'No.123/Domicile/CFC',0,0,'L');
        $pdf->Cell(0, 6, 'Dated: '.\Carbon\Carbon::now()->toDateString(),0,1,'R');

        $pdf->SetFont('Arial', 'BU', 12); 
        $pdf->Cell(0, 6, 'TO WHOM IT MAY CONCERN',0,1,'C');
        $signature = public_path(). '/images/signature.jpeg';
        $pdf->Ln(8); 
        
        // Add multi-cell text 
        $pdf->SetFont('Arial','', 12); 
        $pdf->MultiCell(0, 10, '                 It is verified that Domicile Certificate issued to Mr. Hamid Ullah Shah s/o Jehangir Shah having CNIC No.4221-456465464-7 is geninue and is issued from this office.'); 
        
        $pdf->Image($signature, 130, 75, 50); 
        $pdf->Ln(20);
        $pdf->SetFont('Arial','B', 12); 
        $pdf->Cell(105, 6, '',0,0);
        $pdf->Cell(0, 6, 'Assistant Commissioner (Saddar)',0,1);
        
        $pdf->Cell(125, 6, '',0,0);
        $pdf->Cell(0, 6, 'Islamabad',0,1);

        // Output the PDF directly to the browser 
        
        $pdf_path = storage_path('app\public\certificates\test2.pdf');
        $pdf->Output('F', $pdf_path);
        
    });
});
require __DIR__.'/auth.php';
