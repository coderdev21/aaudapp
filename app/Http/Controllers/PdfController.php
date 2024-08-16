<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
   public function CertificateRecords(Certificate $id)
  {
    //dd($id);
     $certificate = Certificate::where('id', $id->id)->get();
    $pdf = Pdf::loadView('pdf.example', ['certificate' => $certificate]);
    return $pdf->download();
  }
}
