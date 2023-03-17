<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PDF;

class PrinterController extends Controller
{
    public function ganadores()
    {
        $encuestas = \App\Models\Encuesta::all();
        $pdf = \PDF::loadView('reportes.ganadores', compact('encuestas')); // genera el PDF
        return $pdf->download('hoja_resultados.pdf'); // devuelve el PDF para su descarga
    }

    public function resultados()
    {
        $encuestas = \App\Models\Encuesta::all();
        $pdf = \PDF::loadView('reportes.resultados', compact('encuestas')); // genera el PDF
        return $pdf->download('hoja_resultados.pdf'); // devuelve el PDF para su descarga
    }
}
