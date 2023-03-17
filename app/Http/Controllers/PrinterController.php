<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PDF;

class PrinterController extends Controller
{
    public function ganadores($encuesta_id)
    {
        $encuesta = \App\Models\Encuesta::find($encuesta_id);
        $participantes = \App\Models\Participante::where('encuesta_id', $encuesta->id)->get();
        $pdf = \PDF::loadView('reportes.ganadores', compact('participantes', 'encuesta')); // genera el PDF
        return $pdf->download('hoja_resultados.pdf'); // devuelve el PDF para su descarga
    }

    public function resultados()
    {
        $encuestas = \App\Models\Encuesta::find(2);
        $participantes = \App\Models\Participante::where('encuesta_id', $encuestas->id)->get();
        $pdf = \PDF::loadView('reportes.resultados', compact('encuestas')); // genera el PDF
        return $pdf->download('hoja_resultados.pdf'); // devuelve el PDF para su descarga
    }
}
