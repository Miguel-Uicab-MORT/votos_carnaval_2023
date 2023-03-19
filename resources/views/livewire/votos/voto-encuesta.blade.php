<div class="container mx-auto">
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Eventos') }}
                </h2>
            </div>
            <div>
                <x-btn-print-ticket href="{{route('dashboard')}}">
                    {{ __('Regresar') }}
                </x-btn-print-ticket>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 py-10">
        @foreach($encuestas as $encuesta)
            <a href="{{route('votos.participante', $encuesta)}}" class="p-5 flex justify-center items-center shadow-lg rounded-md bg-white">
                {{$encuesta->nombre_encuesta}}
            </a>
        @endforeach
    </div>
</div>
