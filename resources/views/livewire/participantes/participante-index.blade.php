<div class="container mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex items-center">
            <x-input type="text" class="flex-1" placeholder="Buscar participante" wire:model="search" />
            <div class="ml-2">
                @livewire('participantes.participante-create')
            </div>
        </div>

        <div class="py-5">
            <table class="tables">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Evento</th>
                        <th>Representante</th>
                        <th>Telefono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                @if(count($participantes))
                    <tbody>
                        @foreach($participantes as $participante)
                            <tr>
                                <td>{{ $participante->nombre }}</td>
                                <td>{{ $participante->encuesta->nombre_encuesta }}</td>
                                <td>{{ $participante->representante }}</td>
                                <td>{{ $participante->telefono }}</td>
                                <td class="flex justify-end">
                                    <x-danger-button wire:click="$emit('destroy',{{ $participante->id }})" wire:loading.attr="disabled">
                                        Eliminar
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                {{ $participantes->links() }}
                            </td>
                        </tr>
                    </tfoot>
                @else
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <div class="flex justify-center">
                                    <span>No hay registros</span>
                                </div>
                            </td>
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
                        Livewire.emitTo('participantes.participante-index', 'delete', item)
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
