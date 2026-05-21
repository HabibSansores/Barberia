<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recordatorio de Cita</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f7;
            color: #51545e;
            margin: 0;
            padding: 0;
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
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .email-header {
            background-color: #1a1a1a;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 800;
            color: #f5b800;
            letter-spacing: 2px;
        }
        .email-header p {
            margin: 6px 0 0;
            color: #aaa;
            font-size: 13px;
        }
        .reminder-badge {
            background-color: #fff8e1;
            border: 1px solid #f5b800;
            border-radius: 8px;
            padding: 12px 20px;
            text-align: center;
            margin-bottom: 24px;
        }
        .reminder-badge span {
            font-size: 15px;
            font-weight: 700;
            color: #b45309;
        }
        .email-body {
            padding: 30px;
        }
        .email-body p {
            font-size: 15px;
            line-height: 1.7;
            margin-top: 0;
            margin-bottom: 16px;
        }
        .cita-details {
            background-color: #0f0f0f;
            border-radius: 10px;
            padding: 20px 24px;
            margin-bottom: 24px;
        }
        .cita-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .cita-details td {
            padding: 7px 0;
            font-size: 14px;
            border-bottom: 1px solid #222;
        }
        .cita-details tr:last-child td {
            border-bottom: none;
        }
        .cita-details td.label {
            font-weight: 700;
            color: #f5b800;
            width: 35%;
        }
        .cita-details td.value {
            color: #e2e8f0;
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

            {{-- Header --}}
            <div class="email-header">
                <h1>✂️ BARBERÍA</h1>
                <p>Recordatorio automático de cita</p>
            </div>

            <div class="email-body">

                {{-- Badge de recordatorio --}}
                <div class="reminder-badge">
                    <span>⏰ Tu cita es MAÑANA</span>
                </div>

                <p>Hola <strong>{{ $cita->nombre_cliente }}</strong>,</p>
                <p>
                    Este es un recordatorio de que tienes una cita programada para <strong>mañana</strong>.
                    Por favor, preséntate a tiempo o comunícate con nosotros si necesitas cancelar o reagendar.
                </p>

                {{-- Detalles de la cita --}}
                <div class="cita-details">
                    <table>
                        <tr>
                            <td class="label">Servicio:</td>
                            <td class="value">{{ $cita->servicio }}</td>
                        </tr>
                        <tr>
                            <td class="label">Barbero:</td>
                            <td class="value">{{ $cita->barbero }}</td>
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
                            <td class="value">{{ $cita->estado }}</td>
                        </tr>
                    </table>
                </div>

                <p>¡Te esperamos! 💈</p>
            </div>

            <div class="footer">
                &copy; {{ date('Y') }} Barbería. Este correo fue enviado automáticamente.
            </div>
        </div>
    </div>
</body>
</html>
