<?php

use App\Http\Controllers\PdfController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pdf/generate/certificate/{id}', [PdfController::class,'CertificateRecords'])->name('pdf.pazysalvo');

// Ruta para probar que la aplicación puede enviar correos
Route::get('/test-mail', function () {
  Mail::raw('Hola, este es un correo de prueba', function ($message) {
      $message->to('osanjur@gmail.com')->subject('Correo de Prueba');
  });

  return 'El correo se envio!!';
});
