<?php

namespace App\Http\Livewire\Encuestas;

use App\Models\Encuesta;
use App\Models\Pregunta;
use Livewire\Component;
use Livewire\WithPagination;

class EncuestaShow extends Component
{
    use WithPagination;

    protected $listeners = ['render', 'delete'];

    public $search;

    public $encuesta;

    public $open_edit = false, $aspecto;
    public $rules = [
        'aspecto.nombre_pregunta' => 'required'
    ];

    public function mount(Encuesta $encuesta)
    {
        $this->encuesta = $encuesta;
    }

    public function delete(Pregunta $pregunta)
    {
        $pregunta->delete();
        $this->emit('render');
        $this->emit('alert-success', 'Pregunta eliminada con éxito');
    }

    public function edit(Pregunta $pregunta)
    {
        $this->aspecto = $pregunta;
        $this->validate();
        $this->open_edit = true;
    }

    public function update()
    {
        $this->validate();
        $this->aspecto->save();
        $this->open_edit = false;
        $this->emit('render');
        $this->emit('alert-success', 'Pregunta actualizada con éxito');
    }

    public function render()
    {
        $preguntas = Pregunta::where('encuesta_id', $this->encuesta->id)
            ->where('nombre_pregunta', 'LIKE', '%' . $this->search . '%')
            ->paginate(15);
        return view('livewire.encuestas.encuesta-show', compact('preguntas'));
    }
}
