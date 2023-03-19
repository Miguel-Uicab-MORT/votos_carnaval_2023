<div class="container mx-auto">
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Resultados') }}
            </h2>
            <div>
                <x-btn-print-ticket href="{{route('dashboard')}}">
                    {{ __('Regresar') }}
                </x-btn-print-ticket>
            </div>
        </div>
    </x-slot>

    <div class="p-5">
            <div>
                <x-btn-print-ticket  href="{{route('ganadores', $id_encuesta)}}" >
                    Resultado por Jueces
                </x-btn-print-ticket>
                <x-button class="ml-2" wire:click="filterResult" >
                    Descargar resultados
                </x-button>
            </div>
        </div>

        <div class="flex items-center p-4">
            <span class="font-bold text-gray-700">{{ __('Concurso') }}</span>
            <select class="flex-1 ml-3 form-input-select" wire:model="id_encuesta">
                @foreach($concursos as $concurso)
                    <option value="{{ $concurso->id }}">{{ $concurso->nombre_encuesta }}</option>
                @endforeach
            </select>
        </div>


        @foreach($encuestas as $encuesta)
            <div class="p-5 bg-white shadow-lg rounded-lg">
                <div class="flex justify-between">
                    <div class="flex">
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-700">{{ __('Concurso: '.$encuesta->nombre_encuesta) }}</span>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-700">{{ $encuesta->participantes->count() }}</span>
                            <span class="text-sm text-gray-500">Participantes</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 sm:gap-4 md:grid-cols-4 md:gap-6 py-5">
                @foreach($encuesta->participantes->sortByDesc(function($participante) { return $participante->respuestas->sum('calificacion');}) as $participante)
                    <div class="bg-white rounded-md shadow-lg p-3">
                        <div class="flex">
                            <div class="flex flex-col">
                                <span class="text-md font-bold text-gray-500">Particpante:</span>
                                <span class="text-sm text-gray-700">{{ $participante->nombre }}</span>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex flex-col">
                                <span class="text-md font-bold text-gray-500">Posición:</span>
                                <span class="text-sm text-gray-700">{{ $participante->posicion }}</span>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex flex-col">
                                <span class="text-md font-bold text-gray-500">Representante:</span>
                                <span class="text-sm text-gray-700">{{ $participante->representante }}</span>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex flex-col">
                                <span class="text-md font-bold text-gray-500">Organización:</span>
                                <span class="text-sm text-gray-700">{{ $participante->organizacion }}</span>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex flex-col">
                                <span class="text-md font-bold text-gray-500">Puntaje:</span>
                                <span class="font-bold text-gray-700">{{ $participante->respuestas->sum('calificacion') }}</span>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <x-button wire:click="show({{$participante}})" wire:loading.attr="disabled">
                                Ver
                            </x-button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <x-dialog-modal wire:model="openFilterResultModal">
        <x-slot name="title">
            {{ __('Filtro de reporte de resultados') }}
        </x-slot>
        <x-slot name="content">
                <div class="flex flex-col">
                    <x-label for="id_encuesta" :value="__('Votante')" />
                    <select class="form-input-select flex-1" wire:model="id_user">
                        <option value="">Seleccione un votante</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('openFilterResultModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-secondary-button>
            <x-button class="ml-2" wire:click="filterResultByUser" wire:loading.attr="disabled">
                {{ __('Filtrar') }}
            </x-button>

        </x-slot>
    </x-dialog-modal>
</div>
