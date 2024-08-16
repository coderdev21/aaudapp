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
    $certificate = Certificate::where('id', $id->id)->get();

    $pdf = Pdf::loadView('pdf.pazysalvo', ['certificate' => $certificate])->setPaper('legal', 'portrait');
    //return $pdf->download(); lo cambie por stream para que no se descargara.
    foreach ($certificate as $item) {
      $filename = 'AAUD-' . $item->control_number . '.pdf';
      return $pdf->stream($filename);
    }
  }
}
