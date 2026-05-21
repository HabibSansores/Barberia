<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nueva Cita Agendada</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #0c0c0c;
            color: #e2e8f0;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }
        .email-wrapper {
            width: 100%;
            background-color: #0c0c0c;
            padding: 30px 0;
        }
        .email-content {
            max-width: 570px;
            margin: 0 auto;
            background-color: #121212;
            border: 1px solid #1a1a1a;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        }
        .email-header {
            background-color: #080808;
            padding: 30px;
            text-align: center;
            border-bottom: 2px solid #eab308;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            color: #eab308;
            letter-spacing: 2px;
        }
        .email-body {
            padding: 30px;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            margin-top: 0;
            margin-bottom: 20px;
            color: #a0aec0;
        }
        .cita-details {
            background-color: #181818;
            border-left: 4px solid #eab308;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 0 8px 8px 0;
        }
        .cita-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .cita-details td {
            padding: 6px 0;
            font-size: 15px;
        }
        .cita-details td.label {
            font-weight: bold;
            color: #eab308;
            width: 35%;
        }
        .cita-details td.value {
            color: #ffffff;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #718096;
            background-color: #080808;
            border-top: 1px solid #1a1a1a;
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
                <p>Hola <strong>{{ $barbero->name }}</strong>,</p>
                <p>Te notificamos que se ha registrado una nueva cita asignada a tu nombre. Adjunto a este correo encontrarás el comprobante oficial de la cita en formato PDF.</p>
                
                <div class="cita-details">
                    <table>
                        <tr>
                            <td class="label">Cliente:</td>
                            <td class="value">{{ $cita->nombre_cliente }}</td>
                        </tr>
                        <tr>
                            <td class="label">Teléfono Cliente:</td>
                            <td class="value">{{ $cita->telefono }}</td>
                        </tr>
                        <tr>
                            <td class="label">Correo Cliente:</td>
                            <td class="value">{{ $cita->email ?? 'Sin correo' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Servicio:</td>
                            <td class="value">{{ $cita->servicio }}</td>
                        </tr>
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
                            <td class="value" style="font-weight: bold;">{{ $cita->estado }}</td>
                        </tr>
                    </table>
                </div>

                <p>Por favor, revisa tu agenda diaria en tu panel de control para organizar tus tiempos correspondientes.</p>
                <p>¡Mucho éxito con el servicio!</p>
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} Barbería. Todos los derechos reservados.
            </div>
        </div>
    </div>
</body>
</html>
