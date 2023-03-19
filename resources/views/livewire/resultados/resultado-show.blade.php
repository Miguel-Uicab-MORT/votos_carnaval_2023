<div class="container mx-auto">
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Resultados de: '. $participante->nombre) }}
                </h2>
            </div>
            <div>
                <x-btn-print-ticket href="{{route('resultados.index')}}">
                    {{ __('Regresar') }}
                </x-btn-print-ticket>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <x-table>
            <table class="tables">
                <thead>
                    <th>
                        Aspecto a calificar
                    </th>
                    @foreach($usuarios as $usuario)
                        <th>
                            {{ $usuario->name }}
                        </th>
                    @endforeach
                </thead>
                <tbody>
                @foreach($preguntas as $pregunta)
                    <tr>
                        <td>
                            {{ $pregunta->nombre_pregunta }}
                        </td>
                        @foreach($usuarios as $usuario)
                            <td class="text-center">
                                @foreach($respuestas as $respuesta)
                                    @if($respuesta->user_id == $usuario->id && $respuesta->pregunta_id == $pregunta->id)
                                        {{ $respuesta->calificacion }}
                                        <x-secondary-button wire:click="edit({{$respuesta}})">
                                            Editar
                                        </x-secondary-button>
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                    <tr>
                        <td>
                            <b>CALIFICACIÓN FINAL</b>
                        </td>
                        @foreach($usuarios as $usuario)
                            <td class="text-center">
                                @php
                                    $calificacion = 0; // reiniciar la variable para cada usuario
                                @endphp
                                @foreach($respuestas as $respuesta)
                                    @if($respuesta->user_id == $usuario->id)
                                        @php
                                            $calificacion += $respuesta->calificacion;
                                        @endphp
                                    @endif
                                @endforeach
                                {{ $calificacion }}
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </x-table>
    </div>

    <x-dialog-modal wire:model="modalEdit">
        <x-slot name="title">
            Editar calificación
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="calificacion" :value="__('Calificación')" />
                <x-input id="calificacion" class="block mt-1 w-full" type="number" min="1" max="10" wire:model="calificacion_selected" />
                @error('calificacion') <span class="error">{{ $message }}</span> @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalEdit', false)">
                Cancelar
            </x-secondary-button>

            <x-button class="ml-2" wire:click="update">
                Actualizar
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
