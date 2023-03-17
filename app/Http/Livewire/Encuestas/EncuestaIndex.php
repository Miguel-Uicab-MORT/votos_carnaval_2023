<?php

namespace App\Http\Livewire\Encuestas;

use App\Models\Encuesta;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EncuestaIndex extends Component
{
    use WithPagination;

    protected $listeners = ['render', 'delete'];

    public $search;

    public $editModal = false, $concurso, $estado_encuesta;
    public $rules = [
        'concurso.nombre_encuesta' => 'required',
        'concurso.estado' => 'required',
    ];

    public function changeEstado(Encuesta $encuesta)
    {
        try {
            DB::beginTransaction();

            if ($encuesta->estado) {
                $encuesta->estado = Encuesta::Cerrada;
            } else {
                $encuesta->estado = Encuesta::Abierta;
            }

            $encuesta->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        $this->emit('render');
        $this->emit('alert-success', 'Estado de la encuesta cambiada con éxito');
    }

    public function edit(Encuesta $encuesta)
    {
        $this->concurso = $encuesta;
        $this->estado_encuesta = $encuesta->estado;
        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->concurso->estado = $this->estado_encuesta;
            $this->concurso->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        $this->editModal = false;
        $this->emit('render');
        $this->emit('alert-success', 'Encuesta actualizada con éxito');
    }

    public function show(Encuesta $encuesta)
    {
        return redirect()->route('encuestas.show', $encuesta);
    }

    public function delete(Encuesta $encuesta)
    {
        $encuesta->delete();
        $this->emit('render');
        $this->emit('alert-success', 'Encuesta eliminada con éxito');
    }

    public function render()
    {
        $encuestas = Encuesta::where('nombre_encuesta', 'LIKE', '%' . $this->search . '%')
            ->paginate(15);
        return view('livewire.encuestas.encuesta-index', compact('encuestas'));
    }
}
