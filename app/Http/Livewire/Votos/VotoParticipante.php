<?php

namespace App\Http\Livewire\Votos;

use App\Models\Encuesta;
use App\Models\Participante;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VotoParticipante extends Component
{
    public $encuesta;
    public $user_id;

    public function mount(Encuesta $encuesta)
    {
        $this->user_id = Auth::id();
        $this->encuesta = $encuesta;
    }

    public function render()
    {
        $participantes = Participante::where('encuesta_id', $this->encuesta->id)
            ->where('tipo', Participante::PARTICIPANTE)
            ->get();
        return view('livewire.votos.voto-participante', compact('participantes'));
    }
}
