<div class="container mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Concurso de: ' . $encuesta->nombre_encuesta) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex items-center mb-5">
            <x-input type="text" class="flex-1" placeholder="Buscar aspecto a calificar" wire:model="search" />
            @livewire('encuestas.pregunta-create', ['encuesta_id' => $encuesta->id], key($encuesta->id))
        </div>

        <x-table>
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
                                    <x-secondary-button wire:click="edit({{ $pregunta->id }})" wire:loading.attr="disabled">
                                        Editar
                                    </x-secondary-button>
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
        </x-table>
    </div>

    <x-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Editar pregunta
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Aspecto a calificar" />
                <x-input type="text" class="w-full" wire:model="aspecto.nombre_pregunta" />
                <x-input-error for="nombre_pregunta" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open_edit', false)" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                Actualizar
            </x-button>
        </x-slot>
    </x-dialog-modal>

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
