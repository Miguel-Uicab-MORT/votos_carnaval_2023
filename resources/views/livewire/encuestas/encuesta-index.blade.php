<div class="container mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Concursos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex items-center">
            <x-input type="text" class="flex-1" placeholder="Buscar concruso" wire:model="search" />
            <div class="ml-2">
                @livewire('encuestas.encuesta-create')
            </div>
        </div>

        <div class="py-5">
            <table class="tables">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                @if(count($encuestas))
                    <tbody>
                        @foreach($encuestas as $encuesta)
                            <tr>
                                <td>{{ $encuesta->nombre_encuesta }}</td>
                                <td>
                                    @switch($encuesta->estado)
                                        @case(1)
                                            <span>Activo</span>
                                            @break
                                        @case(2)
                                            <span>Inactivo</span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="flex justify-end">
                                    <x-secondary-button wire:click="show({{$encuesta->id}})" wire:loading.attr="disabled">
                                        Ver
                                    </x-secondary-button>
                                    <x-danger-button wire:click="$emit('destroy',{{ $encuesta->id }})" wire:loading.attr="disabled">
                                        Eliminar
                                    </x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                {{ $encuestas->links() }}
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
                        Livewire.emitTo('encuestas.encuesta-index', 'delete', item)
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
