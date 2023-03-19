<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante Pago</title>
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
            margin: 0;
            font-size: 1.0rem; /* Letras lg */
            padding: 0.2rem;
            text-align: center;
            font-weight: bold;
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

        .table{
            border-collapse: collapse;
            border-spacing: 0;
            border: 1px solid black;
            width: 100%;
        }

        .tables thead th {
            font-size: 0.5rem; /* Letras md */
            font-weight: bold;
            text-align: center;
        }

        .tables tbody td {
            font-size: 0.5rem; /* Letras sm */
            font-weight: bold;
            padding: 0.5rem;
            text-align: center;
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
        <div class="text-center">
            CARNVAL ZIHUATANEJO 2023
        </div>
        <div class="text-center">
            EVALUACIÓN DEL JUEZ {{$usuario->name}}
        </div>
        <div class="text-center">
            FORMATO DE RESULTADOS DEL JURADO
        </div>
    </div>

    <table class="tables">
        <thead>
        <tr>
            <th>No</th>
            <th>Participante</th>
            @foreach($preguntas as $pregunta)
                <th colspan>{{ $pregunta->nombre_pregunta }}</th>
            @endforeach
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
            @foreach($participantes as $participante)
                <tr>
                    <td>{{ $participante->posicion }}</td>
                    <td>{{ $participante->nombre }}</td>
                    @if($participante->tipo == 2)
                        @if($participante->respuestas->count() > 0)
                        @php($total = 0)
                        @foreach($participante->respuestas as $respuesta)
                            <td>{{ $respuesta->calificacion }}</td>
                            @php($total += $respuesta->calificacion)
                        @endforeach
                        <td>{{ $total }}</td>
                    @else
                            <td colspan="{{ $preguntas->count() + 1 }}">No hay respuestas</td>
                        @endif
                    @else
                        <td colspan="{{ $preguntas->count() + 1 }}">PARTICIPANTE DE EXHIBICIÓN</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <table class="table">
            <tbody>
                <tr>
                    <td>Fecha</td>
                    <td>{{now()->format('d-m-Y')}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Lugar</td>
                    <td>Zihuatanejo de Azueta Guerrero</td>
                    <td>Firma del juez</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
</body>

</html>
