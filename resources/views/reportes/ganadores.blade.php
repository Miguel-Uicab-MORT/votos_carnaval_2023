<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultados de comparsa</title>
    <style>
        * {
            margin: 5;
            padding: 5;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Estilos para el encabezado */
        header {
            padding: 10px;
        }

        /* Estilos para el logo */
        .logo {
            float: left;
        }

        .logo img {
            height: 5%;
            width: auto;
        }

        /* Estilos para la información del negocio */
        .info-negocio {
            float: right;
            text-align: right;
        }

        .info-negocio p {
            margin: 0;
            line-height: 1;
        }
        .text-center {
            text-align: center;
        }

        .text-sm {
            font-size: small;
        }

        .justify-center-img {
            display: inline-block;
            vertical-align: middle;
        }

        .tables {
            border-collapse: collapse;
            border-spacing: 0;
            border: 1px solid black;
            width: 100%;
        }

        table, th, td {
            border: 1px solid;
        }

        .tables thead th {
            font-size: 1.2rem; /* Letras md */
            font-weight: bold;
            text-align: center;
        }

        .tables tbody td {
            font-size: .8 rem; /* Letras sm */
            font-weight: bold;
            padding: 0.5rem;
        }

        .tables tbody td:first-child,
        .tables tbody td:last-child {
            background-color: black;
            color: white;
        }

        .tables tbody td:not(:first-child):not(:last-child) {
            background-color: white;
            color: black;
        }
    </style>
</head>

<body>

<main>
    <div>
        <h3 class="text-center">
            CARNVAL ZIHUATANEJO 2023
        </h3>
        <h3 class="text-center">
            EVALUACIÓN DE {{$encuesta->nombre_encuesta}}
        </h3>
        <h3 class="text-center">
            FORMATO DE RESULTADOS DEL JURADO
        </h3>
    </div>

    <table class="tables">
        <thead>
            <tr>
                <th rowspan="2">N°</th>
                <th rowspan="2">COMPARSA</th>
                <th colspan="4">JUEZ</th>
                <th rowspan="2">SUMA</th>
                <th rowspan="2">LUGAR</th>
            </tr>
            <tr>
                <th>KAREN VEGA LUCAS</th>
                <th>LAURA CANO</th>
                <th>GABRIELA MENDOZA</th>
                <th>MISAEL LANDA</th>
            </tr>
        </thead>
        <tbody>
            @foreach($participantes->sortBy('posicion') as $participante)
                <tr>
                    <td>{{ $participante->posicion }}</td>
                    <td>{{ $participante->nombre }}</td>
                    @php
                        $grupos_respuestas = $participante->respuestas->groupBy('user_id')->take(4);
                    @endphp

                    @for($i = 1; $i <= 4; $i++)
                        @if(isset($grupos_respuestas[$i]))
                            @php
                                $suma_calificaciones = $grupos_respuestas[$i]->sum('calificacion');
                            @endphp
                            <td>{{ $suma_calificaciones }}</td>
                        @else
                            <td>0</td>
                        @endif
                    @endfor
                    <td>{{ $participante->respuestas->sum('calificacion') }}</td>
                    <td>{{ $participante->posicion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
</body>

</html>
