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
            height: 15%;
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

<header>
    <div class="logo">
        <img src="{{asset('/recursos/img/LIFE_STYLE_GYM_LOGO.jpg')}}" alt="Logo del negocio">
    </div>
    <div class="info-negocio">
        <h2><strong>LIFE STYLE GYM</strong></h2>
        <p>C. 106 43, Barrio de Sta Lucía, </p>
        <p>24020 Campeche, Camp.</p>
        <p><strong>Celular: 981 147 1407</strong></p>
    </div>
    <div style="clear: both;"></div>
</header>
<main>
    <div>
        <h3 class="text-center">
            Tarjeta de cliente
        </h3>
    </div>

    <table class="tables">
        <thead>
        <th>
            CLIENTE
        </th>
        <th>
            TIPO DE PAGO
        </th>
        <th>
            FECHA DE PAGO
        </th>
        </thead>

        <tfoot>
        <tr>
            <td colspan="3" class="text-center">
                <strong>AVISO</strong>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center text-sm">
                <strong>
                    En tu próxima visita con este código QR podrás marcar tu entrada y salida, esto para reforzar medidas
                    sanitarias y mejor control del acceso a este espacio, agradecemos tu cooperación y comprensión.
                </strong>
            </td>
        </tr>
        </tfoot>
    </table>
</main>
</body>

</html>
