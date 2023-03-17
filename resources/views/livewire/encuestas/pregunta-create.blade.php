<div>
    <x-button wire:click="showModalEncuesta()">
        Agregar Aspecto A Calificar
    </x-button>

    <x-dialog-modal wire:model="modalEncuesta">
        <x-slot name="title">
            <div class="flex justify-between">
                <div class="text-lg font-bold">
                    Crear Aspecto a calificar
                </div>
                <div>
                    <button wire:click="showModalEncuesta()">
                        <i class="fas fa-times-circle"></i>
                    </button>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="nombre_pregunta" value="{{ __('Nombre') }}" />
                <x-input id="nombre_pregunta" class="block mt-1 w-full" type="text" wire:model="nombre_pregunta" />
                @error('nombre_pregunta') <span class="error">{{ $message }}</span> @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="showModalEncuesta()">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="store()">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
