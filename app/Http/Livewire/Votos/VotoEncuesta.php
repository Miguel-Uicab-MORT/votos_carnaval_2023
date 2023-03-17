<?php

namespace App\Http\Livewire\Votos;

use App\Models\Encuesta;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VotoEncuesta extends Component
{

    public function render()
    {
        $user = User::find(Auth::id());

        $encuestas = $user->encuesta()->get();

        return view('livewire.votos.voto-encuesta', compact('encuestas'));
    }
}
