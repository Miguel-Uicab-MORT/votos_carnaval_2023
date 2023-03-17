<div class="container mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Concurso de: ' . $encuesta->nombre_encuesta) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex items-center">
            <x-input type="text" class="flex-1" placeholder="Buscar aspecto a calificar" wire:model="search" />
            @livewire('encuestas.pregunta-create', ['encuesta_id' => $encuesta->id], key($encuesta->id))
        </div>

        <div class="py-5">
            <table class="tables">
                <thead>
                    <tr>
                        <th>Aspecto a calificar</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                @if(count($preguntas))
                    <tbody>
                        @foreach($preguntas as $pregunta)
                            <tr>
                                <td>{{ $pregunta->nombre_pregunta }}</td>
                                <td class="flex justify-end">
                                    <x-danger-button wire:click="$emit('destroy',{{ $pregunta->id }})" wire:loading.attr="disabled">
                                        Eliminar
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                {{ $preguntas->links() }}
                            </td>
                        </tr>
                    </tfoot>
                @else
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-center">No hay registros</td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

        @push('scripts')
            <script>
                Livewire.on('alert-success', function(message) {
                    Swal.fire(
                        'Acción exitosa',
                        message,
                        'success'
                    )
                })
                Livewire.on('destroy', item => {
                    Swal.fire({
                        title: '¿Está seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '¡Si, bórralo!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('encuestas.encuesta-show', 'delete', item)
                            Swal.fire(
                                '¡Eliminado!',
                                'Su archivo ha sido eliminado.',
                                'success'
                            )
                        }
                    })
                })

            </script>
        @endpush
</div>
