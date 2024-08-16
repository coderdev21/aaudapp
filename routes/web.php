<?php

use App\Http\Controllers\PdfController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/pdf/generate/certificate/{record}', [PdfController::class, 'CertificateRecords'])->name('pdf.pazysalvo');

/* Route::prefix('generate-pdf')->name('generate-pdf.')
    ->group(function () {
        Route::controller(PdfController::class)->group(function () {
            Route::get('incident-report/{id}', 'incidentReport')->name('incident.report'); // Incident Reports
        });
    }); */

Route::get('/pdf/generate/certificate/{id}', [PdfController::class,'CertificateRecords'])->name('pdf.pazysalvo');
