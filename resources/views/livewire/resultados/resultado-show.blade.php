<div class="container mx-auto">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resultados de: '. $participante->nombre) }}
        </h2>
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
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach

                </tbody>
            </table>

        </x-table>
    </div>
</div>
