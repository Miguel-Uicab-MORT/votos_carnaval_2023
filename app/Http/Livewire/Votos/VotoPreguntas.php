<?php

namespace App\Http\Livewire\Votos;

use App\Models\Participante;
use App\Models\Respuesta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class VotoPreguntas extends Component
{

    public $encuesta;
    public $participante;
    public $calificaciones = [];
    public $preguntas = [];
    public function mount(Participante $participante)
    {
        $this->participante = $participante;
        $this->encuesta = $participante->encuesta;
        $this->preguntas = $this->encuesta->preguntas;
        $this->calificaciones = array_fill(0, count($this->preguntas), 1);

        $resueltas = Respuesta::where('user_id', Auth::id())
            ->where('participante_id', $this->participante->id)
            ->get();

        $i = 0;
        if ($resueltas) {
            foreach ($resueltas as $resuelta) {
                $this->calificaciones[$i] = $resuelta->calificacion;
                $i++;
            }
        }

    }

    public function guardarCalificaciones()
    {
        try {
            DB::beginTransaction();
            $i = 0;
            foreach ($this->preguntas as $pregunta) {
                $calificacion = $this->calificaciones[$i];

                if ($calificacion > 10) {
                    $calificacion = 10;
                } elseif ($calificacion < 0 || $calificacion == null) {
                    $calificacion = 0;
                }

                $respuesta = Respuesta::where('user_id', Auth::id())
                    ->where('participante_id', $this->participante->id)
                    ->where('pregunta_id', $pregunta->id)
                    ->first();

                if ($respuesta) {
                    $respuesta->calificacion = intval($calificacion);
                    $respuesta->save();
                    $i++;
                } else {
                    $respuesta = new Respuesta();
                    $respuesta->user_id = Auth::id();
                    $respuesta->participante_id = $this->participante->id;
                    $respuesta->pregunta_id = $pregunta->id;
                    $respuesta->calificacion = intval($calificacion);
                    $respuesta->save();
                    $i++;
                }
            }
            DB::commit();
            return redirect()->route('votos.participante', $this->encuesta);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
    }

    public function volver()
    {
        return redirect()->route('votos.participante', $this->encuesta);
    }
    public function render()
    {
        return view('livewire.votos.voto-preguntas');
    }
}
