<?php

namespace App\Http\Livewire\Votos;

use App\Models\Encuesta;
use Livewire\Component;

class VotoEncuesta extends Component
{
    public function render()
    {
        $encuestas = Encuesta::where('estado', Encuesta::Abierta)->get();

        return view('livewire.votos.voto-encuesta', compact('encuestas'));
    }
}
