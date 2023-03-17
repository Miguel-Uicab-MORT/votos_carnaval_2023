<div>
    <x-button wire:click="showCreateModal" wire:loading.attr="disabled">
        Nuevo participante
    </x-button>

    <x-dialog-modal wire:model="createModal">
        <x-slot name="title">
            Nuevo participante
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6">
                <div class="">
                    <x-label for="nombre" :value="__('Nombre*')" />
                    <x-input id="nombre" class="block mt-1 w-full" type="text" wire:model="nombre" />
                    @error('nombre') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="encuesta_id" :value="__('Concurso*')" />
                    <select wire:model="encuesta_id" class="block mt-1 w-full form-input-select">
                        <option value="">Seleccione una encuesta</option>
                        @foreach($encuestas as $encuesta)
                            <option value="{{ $encuesta->id }}">{{ $encuesta->nombre_encuesta }}</option>
                        @endforeach
                    </select>
                    @error('encuesta_id') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="representante" :value="__('Representante*')" />
                    <x-input id="representante" class="block mt-1 w-full" type="text" wire:model="representante" />
                    @error('representante') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="organiazcion" :value="__('Organización*')" />
                    <x-input id="organiazcion" class="block mt-1 w-full" type="text" wire:model="organiazcion" />
                    @error('organiazcion') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="telefono" :value="__('Telefono*')" />
                    <x-input id="telefono" class="block mt-1 w-full" type="text" wire:model="telefono" />
                    @error('telefono') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="tematica" :value="__('Tematica*')" />
                    <x-input id="tematica" class="block mt-1 w-full" type="text" wire:model="tematica" />
                    @error('tematica') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="numero_participantes" :value="__('Número de participantes')" />
                    <x-input id="numero_participantes" class="block mt-1 w-full" type="number" wire:model="numero_participantes" />
                    @error('numero_participantes') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="musica" :value="__('Música')" />
                    <x-input id="musica" class="block mt-1 w-full" type="text" wire:model="musica" />
                    @error('musica') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="">
                    <x-label for="duracion" :value="__('Duración')" />
                    <x-input id="duracion" class="block mt-1 w-full" type="text" wire:model="duracion" />
                    @error('duracion') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-2">
                    <x-label for="descripcion" :value="__('Descripción*')" />
                    <x-input id="descripcion" class="block mt-1 w-full" type="text" wire:model="descripcion" />
                    @error('descripcion') <span class="error">{{ $message }}</span> @enderror
                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('createModal')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <x-button wire:click="store">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
