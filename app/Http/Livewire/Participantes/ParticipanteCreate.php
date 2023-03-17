<?php

namespace App\Http\Livewire\Participantes;

use App\Models\Encuesta;
use App\Models\Participante;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ParticipanteCreate extends Component
{
    public $createModal = false;

    public $nombre, $encuesta_id, $representante, $organizacion, $telefono, $tematica, $numero_participantes, $musica, $duracion, $descripcion;

    public function showCreateModal()
    {
        if ($this->createModal) {
            $this->createModal = false;
        } else {
            $this->createModal = true;
        }
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'encuesta_id' => 'required',
            'representante' => 'required',
            'organizacion' => 'required',
            'telefono' => 'required',
            'tematica' => 'required',
            'descripcion' => 'required',
        ]);

        try {
            DB::beginTransaction();

            Participante::create([
                'nombre' => $this->nombre,
                'encuesta_id' => $this->encuesta_id,
                'representante' => $this->representante,
                'organizacion' => $this->organizacion,
                'telefono' => $this->telefono,
                'tematica' => $this->tematica,
                'descripcion' => $this->descripcion,
                'numero_participantes' => $this->numero_participantes,
                'musica' => $this->musica,
                'duracion' => $this->duracion,
            ]);

            $this->emit('alert-success', 'Participante creado con éxito');
            $this->reset(['nombre', 'encuesta_id', 'createModal']);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        $this->emit('render');
    }

    public function render()
    {
        $encuestas = Encuesta::where('estado', Encuesta::Abierta)->get();

        return view('livewire.participantes.participante-create', compact('encuestas'));
    }
}
