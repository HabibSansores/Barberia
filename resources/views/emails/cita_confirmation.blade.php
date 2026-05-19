<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmación de Cita</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f7;
            color: #51545e;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            width: 100% !important;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f4f7;
            padding: 20px 0;
        }
        .email-content {
            max-width: 570px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .email-header {
            background-color: #1e293b;
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .email-body {
            padding: 30px;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .cita-details {
            background-color: #f8fafc;
            border-left: 4px solid #3b82f6;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 0 8px 8px 0;
        }
        .cita-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .cita-details td {
            padding: 5px 0;
            font-size: 15px;
        }
        .cita-details td.label {
            font-weight: bold;
            color: #334155;
            width: 30%;
        }
        .cita-details td.value {
            color: #475569;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #94a3b8;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="email-header">
                <h1>BARBERÍA</h1>
            </div>
            <div class="email-body">
                <p>Hola <strong>{{ $cita->nombre_cliente }}</strong>,</p>
                <p>Te confirmamos que tu cita ha sido registrada exitosamente en nuestro sistema. Adjunto a este correo encontrarás el recibo oficial en formato PDF con todos los detalles de tu reservación.</p>
                
                <div class="cita-details">
                    <table>
                        @if($cita->servicio)
                        <tr>
                            <td class="label">Servicio:</td>
                            <td class="value">{{ $cita->servicio }}</td>
                        </tr>
                        @endif
                        @if($cita->barbero)
                        <tr>
                            <td class="label">Barbero:</td>
                            <td class="value">{{ $cita->barbero }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="label">Fecha:</td>
                            <td class="value">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td class="label">Hora:</td>
                            <td class="value">{{ \Carbon\Carbon::parse($cita->hora)->format('g:i A') }}</td>
                        </tr>
                        <tr>
                            <td class="label">Estado:</td>
                            <td class="value">{{ $cita->estado }}</td>
                        </tr>
                    </table>
                </div>

                <p>Si necesitas reagendar o cancelar tu cita, por favor ponte en contacto con nosotros lo antes posible.</p>
                <p>¡Gracias por tu preferencia!</p>
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} Barbería. Todos los derechos reservados.
            </div>
        </div>
    </div>
</body>
</html>
