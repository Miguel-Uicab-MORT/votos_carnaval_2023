<div class="container mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Concursos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex items-center mb-5">
            <x-input type="text" class="flex-1" placeholder="Buscar concruso" wire:model="search" />
            <div class="ml-2">
                @livewire('encuestas.encuesta-create')
            </div>
        </div>

        <x-table>
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
                                    <x-secondary-button wire:click="changeEstado({{$encuesta->id}})" wire:loading.attr="disabled">
                                        Activar/Desactivar
                                    </x-secondary-button>
                                    <x-button wire:click="edit({{ $encuesta->id }})" wire:loading.attr="disabled">
                                        Editar
                                    </x-button>
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
        </x-table>
    </div>

    <x-dialog-modal wire:model="editModal">
        <x-slot name="title">
            Editar concurso
        </x-slot>
        <x-slot name="content">
            <div class="py-5">
                <x-label for="concurso.nombre_encuesta" :value="__('Nombre del concurso')" />
                <x-input id="concurso.nombre_encuesta" class="block mt-1 w-full" type="text" wire:model="concurso.nombre_encuesta" />
                @error('concurso.nombre_encuesta') <span class="error">{{ $message }}</span> @enderror
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('editModal', false)">
                {{ __('Cancelar') }}
            </x-secondary-button>
            <x-button wire:click="update" wire:loading.attr="disabled">
                {{ __('Actualizar') }}
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
