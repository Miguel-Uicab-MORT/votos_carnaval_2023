<?php

namespace App\Http\Livewire\Participantes;

use App\Models\Participante;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipanteIndex extends Component
{
    use WithPagination;

    protected $listeners = ['render', 'delete'];
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $participantes = Participante::where('nombre', 'LIKE', "%{$this->search}%")
            ->orderBy('nombre')
            ->paginate(10);

        return view('livewire.participantes.participante-index', compact('participantes'));
    }
}