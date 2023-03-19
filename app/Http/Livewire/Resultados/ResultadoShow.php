<?php

namespace App\Http\Livewire\Resultados;

use App\Models\Encuesta;
use App\Models\Participante;
use App\Models\Respuesta;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ResultadoShow extends Component
{

    protected $listeners = ['render' => 'render'];
    public $participante;

    public $modalEdit = false, $respuesta_selected, $calificacion_selected;

    public function mount(Participante $participante)
    {
        $this->participante = $participante;
    }

    public function edit(Respuesta $respuesta)
    {
        $this->respuesta_selected = $respuesta;
        $this->calificacion_selected = $respuesta->calificacion;
        $this->modalEdit = true;
    }

    public function update()
    {
        $this->respuesta_selected->calificacion = $this->calificacion_selected;
        $this->respuesta_selected->save();
        $this->modalEdit = false;
        $this->reset(['respuesta_selected', 'calificacion_selected']);
        $this->emit('render');
    }

    public function render()
    {
        $respuestas = $this->participante->respuestas;
        $encuesta = $this->participante->encuesta;
        $preguntas = $this->participante->encuesta->preguntas;
        $usuarios = $encuesta->users;
        return view('livewire.resultados.resultado-show', compact('respuestas', 'encuesta', 'preguntas', 'usuarios'));
    }
}
