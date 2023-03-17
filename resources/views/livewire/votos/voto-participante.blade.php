<div class="container mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participantes') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 py-10">
        @foreach($participantes as $participante)
            <a href="{{route('votos.preguntas', $participante)}}" class="p-5 flex justify-center items-center shadow-lg rounded-md bg-white">
                {{$participante->nombre}}
            </a>
        @endforeach
    </div>
</div>
