<?php

namespace App\Http\Livewire\Resultados;

use App\Http\Controllers\PrinterController;
use App\Models\Participante;
use App\Models\User;
use Livewire\Component;
use PDF;

class ResultadoIndex extends Component
{
    public $id_encuesta = 1;
    public $concursos = [];
    public $id_user, $openFilterResultModal = false, $usuarios = [];
    public function mount()
    {
        $this->concursos = \App\Models\Encuesta::all();
        $this->usuarios = \App\Models\User::whereNotIn('id', [1,2])->get();
    }

    public function filterResult()
    {
        $this->openFilterResultModal = true;
    }

    public function filterResultByUser()
    {
        $this->id_encuesta = $this->id_user;
        $this->openFilterResultModal = false;

        $reporte = new PrinterController();
        $user = User::find($this->id_user);

        return redirect()->route('resultados', $user);

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
