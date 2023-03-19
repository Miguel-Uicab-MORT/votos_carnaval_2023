<?php

namespace App\Http\Livewire\Resultados;

use App\Models\Encuesta;
use App\Models\Participante;
use Livewire\Component;

class ResultadoShow extends Component
{

    public $participante, $encuesta, $preguntas, $usuarios;

    public function mount(Participante $participante)
    {
        $this->participante = $participante;
        $this->respuestas = $participante->respuestas;
        $this->encuesta = $participante->encuesta;
        $this->preguntas = $participante->encuesta->preguntas;
        $this->usuarios = $this->encuesta->users;

    }

    public function render()
    {
        return view('livewire.resultados.resultado-show');
    }
}
