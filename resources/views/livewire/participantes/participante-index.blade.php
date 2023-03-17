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
                                    <x-button wire:click="edit({{ $participante->id }})"
                                        wire:loading.attr="disabled">
                                        Editar
                                    </x-button>
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

    <x-dialog-modal wire:model="editModal">
        <x-slot name="title">
            Editar participante
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-1 gap-3 md:grid-cols-2 md:gap-6">
                <div class="">
                    <x-label for="nombre" :value="__('Nombre*')" />
                    <x-input id="nombre" class="block mt-1 w-full" type="text" wire:model="participante.nombre" />
                    @error('nombre') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="encuesta_id" :value="__('Concurso*')" />
                    <select wire:model="participante.encuesta_id" class="block mt-1 w-full form-input-select">
                        <option value="">Seleccione una encuesta</option>
                        @foreach($encuestas as $encuesta)
                            <option value="{{ $encuesta->id }}">{{ $encuesta->nombre_encuesta }}</option>
                        @endforeach
                    </select>
                    @error('encuesta_id') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="representante" :value="__('Representante*')" />
                    <x-input id="representante" class="block mt-1 w-full" type="text" wire:model="participante.representante" />
                    @error('representante') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="organizacion" :value="__('Organización*')" />
                    <x-input id="organizacion" class="block mt-1 w-full" type="text" wire:model="participante.organizacion" />
                    @error('organizacion') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="telefono" :value="__('Telefono*')" />
                    <x-input id="telefono" class="block mt-1 w-full" type="text" wire:model="participante.telefono" />
                    @error('telefono') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="tematica" :value="__('Tematica*')" />
                    <x-input id="tematica" class="block mt-1 w-full" type="text" wire:model="participante.tematica" />
                    @error('tematica') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="numero_participantes" :value="__('Número de participantes')" />
                    <x-input id="numero_participantes" class="block mt-1 w-full" type="number" wire:model="participante.numero_participantes" />
                    @error('numero_participantes') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="musica" :value="__('Música')" />
                    <x-input id="musica" class="block mt-1 w-full" type="text" wire:model="participante.musica" />
                    @error('musica') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="duracion" :value="__('Duración')" />
                    <x-input id="duracion" class="block mt-1 w-full" type="text" wire:model="participante.duracion" />
                    @error('duracion') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2">
                    <x-label for="descripcion" :value="__('Descripción*')" />
                    <x-input id="descripcion" class="block mt-1 w-full" type="text" wire:model="participante.descripcion" />
                    @error('descripcion') <span class="error">{{ $message }}</span> @enderror
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('editModal', false)">
                {{ __('Cancelar') }}
            </x-secondary-button>
            <x-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
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
