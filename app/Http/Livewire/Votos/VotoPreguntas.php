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
    }

    public function guardarCalificaciones()
    {
        try {
            DB::beginTransaction();
            $i = 0;
            foreach ($this->preguntas as $pregunta) {
                Log::debug($pregunta->id);
                $calificacion = $this->calificaciones[$i];

                $respuesta = new Respuesta();
                $respuesta->user_id = Auth::id();
                $respuesta->participante_id = $this->participante->id;
                $respuesta->pregunta_id = $pregunta->id;
                $respuesta->calificacion = intval($calificacion);
                Log::debug($respuesta);
                $respuesta->save();

                $i++;
            }
            DB::commit();
            return redirect()->route('votos.participante', $this->encuesta);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.votos.voto-preguntas');
    }
}
