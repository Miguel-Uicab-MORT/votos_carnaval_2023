<?php

namespace App\Http\Livewire\Encuestas;

use App\Models\Encuesta;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EncuestaCreate extends Component
{
    public $showModal = false;
    public $nombre_encuesta, $estado = true;

    public function showModal()
    {
        if ($this->showModal) {
            $this->showModal = false;
        } else{
            $this->showModal = true;
        }
    }

    public function store()
    {
        if ($this->estado) {
            $estado = Encuesta::Abierta;
        } else {
            $estado = Encuesta::Cerrada;
        }
        $this->validate([
            'nombre_encuesta' => 'required',
        ]);

        try {
            DB::beginTransaction();

            Encuesta::create([
                'nombre_encuesta' => $this->nombre_encuesta,
                'estado' => $estado,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        $this->showModal = false;
        $this->emit('render');
        $this->emit('alert-success', 'Encuesta creada con éxito');
    }

    public function render()
    {
        return view('livewire.encuestas.encuesta-create');
    }
}
