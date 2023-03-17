<div>
    <x-button wire:click="showModal()">
        {{ __('Crear Encuesta') }}
    </x-button>

    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            {{ __('Crear Concurso') }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="mb-4">
                    <x-label value="Nombre" />
                    <x-input type="text" class="w-full" wire:model="nombre_encuesta" />
                    <x-input-error for="nombre_encuesta" />
                </div>
                <div class="mb-4">
                    <x-label value="Estado" />
                    <label for="default-toggle" x-data="{ estado: @entangle('estado') }" class="inline-flex relative items-center cursor-pointer">
                        <input type="checkbox" value="1" x-model="estado" name="estado" wire:model="estado" id="default-toggle" class="sr-only peer">
                        <div class="form-input-check peer"></div>
                        <span class="form-input-check-label" x-show="!estado">No</span>
                        <span class="form-input-check-label" x-show="estado">Si</span>
                    </label>
                    <x-input-error for="descripcion_encuesta" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showModal', false)">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-button class="disabled:opacity-25" wire:click="store" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
