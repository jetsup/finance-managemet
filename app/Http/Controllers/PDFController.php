<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;



class PDFController extends Controller
{
    public function generatePDF()
    {
        dd(request());
        $pdf = Pdf::loadView('admin/reports-view', ["notifications" => getNotificationsCount()]);
        $pdf->setPaper('A4');
        return $pdf->stream('reports.pdf');
        // return SnappyPdf::loadHTML($html)->download($filename);
    }
}
