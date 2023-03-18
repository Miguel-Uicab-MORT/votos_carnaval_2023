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
            font-size: 0.8rem; /* Letras md */
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
            EVALUACIÓN DE {{$encuesta->nombre_encuesta}}
        </div>
        <div class="text-center">
            FORMATO DE RESULTADOS DEL JURADO
        </div>
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
                @foreach($encuesta->users as $user)
                    <th>{{ $user->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($participantes->sortBy(function($participante) {return -1 * $participante->respuestas->sum('calificacion');}) as $participante)
                <tr>
                    <td>{{ $participante->posicion }}</td>
                    <td>{{ $participante->nombre }}</td>
                    @foreach($encuesta->users as $user)
                        <td>{{ $participante->respuestas->where('user_id', $user->id)->sum('calificacion') }}</td>
                    @endforeach
                    <td>{{ $participante->respuestas->sum('calificacion') }}</td>
                    <td>{{ $loop->iteration }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
</body>

</html>
