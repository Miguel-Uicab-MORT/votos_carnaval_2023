<?php

namespace App\Http\Livewire\Encuestas;

use App\Models\Pregunta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PreguntaCreate extends Component
{
    public $modalEncuesta = false;

    public $encuesta_id;
    public $nombre_pregunta;

    protected $rules = [
        'nombre_pregunta' => 'required',
    ];

    public function mount($encuesta_id)
    {
        $this->encuesta_id = $encuesta_id;
    }

    public function showModalEncuesta()
    {
        Log::debug($this->encuesta_id);
        if ($this->modalEncuesta) {
            $this->modalEncuesta = false;
        } else {
            $this->modalEncuesta = true;
        }
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            Pregunta::create([
                'encuesta_id' => $this->encuesta_id,
                'nombre_pregunta' => $this->nombre_pregunta,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        $this->reset(['nombre_pregunta']);

        $this->emit('render');
        $this->emit('alert-success', 'Pregunta creada con éxito');
        $this->showModalEncuesta();
    }

    public function render()
    {
        return view('livewire.encuestas.pregunta-create');
    }
}
