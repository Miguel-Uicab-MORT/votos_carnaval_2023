<?php

namespace App\Http\Livewire\Resultados;

use App\Models\Participante;
use Livewire\Component;
use PDF;

class ResultadoIndex extends Component
{
    public $id_encuesta = 1;
    public $concursos = [];
    public function mount()
    {
        $this->concursos = \App\Models\Encuesta::all();
    }

    public function show(Participante $participante)
    {
        return redirect()->route('resultados.show', $participante);
    }

    public function render()
    {
        $encuestas = \App\Models\Encuesta::where('id', $this->id_encuesta)->get();
        return view('livewire.resultados.resultado-index', compact('encuestas'));
    }
}
