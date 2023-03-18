<?php

namespace App\Http\Controllers;
use App\Models\Encuesta;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class PrinterController extends Controller
{
    public function ganadores($encuesta_id)
    {
        $encuesta = \App\Models\Encuesta::find($encuesta_id);
        $participantes = \App\Models\Participante::where('encuesta_id', $encuesta->id)->get();
        $pdf = \PDF::loadView('reportes.ganadores', compact('participantes', 'encuesta')); // genera el PDF
        return $pdf->stream('hoja_resultados.pdf'); // devuelve el PDF para su descarga
    }

    public function resultados(User $usuario)
    {
        $encuestas = Encuesta::find($usuario->encuesta_id);
        $preguntas = Pregunta::where('encuesta_id', $encuestas->id)->get();
        $participantes = \App\Models\Participante::where('encuesta_id', $encuestas->id)->get();
        $pdf = \PDF::loadView('reportes.resultados', compact('usuario', 'encuestas', 'preguntas', 'participantes')); // genera el PDF
        return $pdf->stream('hoja_resultados.pdf'); // devuelve el PDF para su descarga
    }
}
