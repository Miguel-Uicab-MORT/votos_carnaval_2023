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
        $participantes = Participante::whereNotIn('id', function ($query) {
            $query->select('participante_id')
                ->from('respuestas')
                ->where('user_id', $this->user_id)
                ->groupBy('participante_id');
        })->get();
        return view('livewire.votos.voto-participante', compact('participantes'));
    }
}
