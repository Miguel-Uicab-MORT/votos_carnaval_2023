<div class="container mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-md text-gray-800 leading-tight">
            {{ __('Usted está calificando al participante: ') }}
            <span class="font-bold text-gray-700">{{ $participante->nombre }}</span>
        </h2>
        <div class="flex justify-between font-semibold text-md text-gray-800 leading-tight">
            <div class="flex-col">
                <div>{{ __('Representa a: ') }}</div>
                <span class="font-bold text-gray-700">{{ $participante->representante }}</span>
            </div>
            <div class="flex-col">
                <div>{{ __('Su tematica es: ') }}</div>
                <span class="font-bold text-gray-700">{{ $participante->tematica }}</span>
            </div>
        </div>

        <h2 class="flex justify-between font-semibold text-md text-gray-800 leading-tight mt-2">
            <div class="flex-col">
                <div>{{ __('Partipan: ') }}</div>
                <span class="font-bold text-gray-700">{{ $participante->numero_participantes }}</span>
            </div>
            <div class="flex-col">
                <div>{{ __('Con la canción: ') }}</div>
                <span class="font-bold text-gray-700">{{ $participante->musica }}</span>
            </div>

            <div class="flex-col">
                <div>{{ __('Con duración: ') }}</div>
                <span class="font-bold text-gray-700">{{ $participante->duracion }}</span>
            </div>
        </h2>

        <h2 class="flex justify-between font-semibold text-md text-gray-800 leading-tight mt-2">
            <div class="flex-col">
                <div>{{ __('Reseña de la comparsa: ') }}</div>
                <span class="font-bold text-gray-700">{{ $participante->descripcion }}</span>
            </div>
        </h2>

    </x-slot>

    <div class="py-10">
        <div class="bg-white shadow-lg rounded-md p-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="flex justify-center items-center">
                    <h1 class="text-xl font-bold">Aspecto a calificar</h1>
                </div>
                <div class="flex justify-center items-center">
                    <h1 class="text-xl font-bold">Calificación</h1>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach($preguntas as $index => $pregunta)
                    <div class="flex justify-center items-center">
                        <label for="pregunta-{{$pregunta->id}}">{{$pregunta->nombre_pregunta}}</label>
                    </div>
                    <div class="flex justify-center items-center" wire:key="pregunta-{{$pregunta->id}}">
                        <select class="form-input-select" wire:model="calificaciones.{{$index}}">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-end items-center">
                <x-button class="mt-4" wire:click="guardarCalificaciones" wire:loading.attr="disabled">
                    {{ __('Guardar') }}
                </x-button>
            </div>
        </div>
    </div>

</div>
