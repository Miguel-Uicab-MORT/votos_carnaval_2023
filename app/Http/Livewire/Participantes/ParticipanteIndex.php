<?php

namespace App\Http\Livewire\Participantes;

use App\Models\Encuesta;
use App\Models\Participante;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipanteIndex extends Component
{
    use WithPagination;

    protected $listeners = ['render', 'delete'];
    public $search;
    public $encuestas=[];
    public $participante;
    public $editModal = false;
    public $rules = [
        'participante.nombre' => 'required',
        'participante.posicion' => 'required',
        'participante.representante' => 'required',
        'participante.organizacion' => 'nullable',
        'participante.telefono' => 'required',
        'participante.tematica' => 'required',
        'participante.descripcion' => 'nullable',
        'participante.encuesta_id' => 'required',
        'participante.numero_participantes' => 'nullable',
        'participante.musica' => 'nullable',
        'participante.duracion' => 'nullable',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit(Participante $participante)
    {
        $this->participante = $participante;
        $this->validate();
        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $this->participante->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
        $this->editModal = false;
        $this->emit('render');
        $this->emit('alert-success', 'Participante actualizado con éxito');
    }

    public function delete(Participante $participante)
    {
        $participante->delete();
        $this->emit('render');
        $this->emit('alert-success', 'Participante eliminado con éxito');
    }

    public function mount()
    {
        $this->encuestas = Encuesta::where('estado', Encuesta::Abierta)->get();
    }

    public function render()
    {
        $participantes = Participante::where('nombre', 'LIKE', "%{$this->search}%")
            ->orderBy('posicion', 'ASC')
            ->paginate(10);

        return view('livewire.participantes.participante-index', compact('participantes'));
    }
}
