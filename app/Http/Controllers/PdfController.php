<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Car;

class PdfController extends Controller
{
    public function generatePdf($id)
    {
        $car = Car::findOrFail($id);

        $pdf = Pdf::loadView('pdf.autogegevens', compact('car'));

        return $pdf->download('auto-' . $car->license_plate . '.pdf');
    }
}
