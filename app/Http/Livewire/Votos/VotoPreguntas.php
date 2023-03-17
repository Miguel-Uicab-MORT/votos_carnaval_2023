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
        foreach ($this->preguntas as $pregunta) {
            $this->validate([
                'calificaciones.' . ($pregunta->id-1) => 'required|numeric|min:0|max:10'
            ]);
        }
        try {
            DB::beginTransaction();
            foreach ($this->preguntas as $pregunta) {
                $calificacion = $this->calificaciones[$pregunta->id-1];
                if (is_null($calificacion))
                    $calificacion = 0;

                $respuesta = new Respuesta();
                $respuesta->user_id = Auth::id();
                $respuesta->participante_id = $this->participante->id;
                $respuesta->pregunta_id = $pregunta->id;
                $respuesta->calificacion = $calificacion;
                $respuesta->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
        return redirect()->route('votos.participante', $this->encuesta);
    }
    public function render()
    {
        return view('livewire.votos.voto-preguntas');
    }
}
