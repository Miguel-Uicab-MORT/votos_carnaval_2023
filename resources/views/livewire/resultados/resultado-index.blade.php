<div class="container mx-auto">
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Resultados') }}
            </h2>
    </x-slot>

    <div class="p-5">

        <div class="flex justify-between">
            <x-btn-print-ticket  href="{{route('ganadores')}}" >
                Descargar Ganadores
            </x-btn-print-ticket>
            <x-btn-print-ticket class="ml-2" href="{{route('resultados')}}" >
                Descargar resultados
            </x-btn-print-ticket>
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
                                <span class="text-md font-bold text-gray-500">Representante:</span>
                                <span class="text-sm text-gray-700">{{ $participante->representante }}</span>
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
</div>
