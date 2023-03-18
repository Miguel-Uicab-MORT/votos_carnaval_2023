<?php

namespace App\Http\Livewire\Resultados;

use App\Models\Participante;
use Livewire\Component;

class ResultadoShow extends Component
{

    public $participante;

    public function mount(Participante $participante)
    {
        $this->participante = $participante;
    }

    public function render()
    {
        return view('livewire.resultados.resultado-show');
    }
}
