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
            text-align: center;
        }

        .text-sm {
            font-size: small;
        }

        .justify-center-img {
            display: inline-block;
            vertical-align: middle;
        }

        .tables thead {
            background: #e1effe;
        }
    </style>
</head>

<body>

<main>
    <div>
        <h3 class="text-center">
            Tarjeta de cliente
        </h3>
    </div>

    <table class="tables">
        <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Carro</th>
            <th colspan="4">Jueces</th>
            <th rowspan="2">Suma</th>
            <th rowspan="2">Lugar</th>
        </tr>
        <tr>
            <th>Juez 1</th>
            <th>Juez 2</th>
            <th>Juez 3</th>
            <th>Juez 4</th>
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
        <tfoot>
        </tfoot>
    </table>
</main>
</body>

</html>
