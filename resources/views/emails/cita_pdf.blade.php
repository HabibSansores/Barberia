<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmación de Cita</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #2d3748;
            margin: 0;
            padding: 40px;
            background-color: #ffffff;
        }
        .receipt-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            position: relative;
            background-color: #ffffff;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #1a202c;
        }
        .header p {
            margin: 0;
            color: #718096;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            color: #2b6cb0;
            margin-bottom: 25px;
            text-align: center;
        }
        .details-table {
            width: 100%;
            margin-bottom: 40px;
            border-collapse: collapse;
        }
        .details-table td {
            padding: 16px 20px;
            font-size: 16px;
            border-bottom: 1px solid #edf2f7;
        }
        .details-table td.label {
            font-weight: bold;
            color: #4a5568;
            width: 35%;
            background-color: #f7fafc;
        }
        .details-table td.value {
            color: #2d3748;
            font-weight: 500;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #a0aec0;
            font-size: 13px;
        }
        .footer-line {
            height: 1px;
            background-color: #edf2f7;
            margin-bottom: 20px;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            background-color: #ebf8ff;
            color: #2b6cb0;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="receipt-card">
        <div class="header">
            <h1>BARBERÍA</h1>
            <p>Comprobante de Reservación</p>
        </div>

        <div class="title">Detalles de la Cita</div>

        <table class="details-table">
            <tr>
                <td class="label">Cliente</td>
                <td class="value">{{ $cita->nombre_cliente }}</td>
            </tr>
            <tr>
                <td class="label">Teléfono</td>
                <td class="value">{{ $cita->telefono }}</td>
            </tr>
            @if($cita->email)
            <tr>
                <td class="label">Correo Electrónico</td>
                <td class="value">{{ $cita->email }}</td>
            </tr>
            @endif
            @if($cita->servicio)
            <tr>
                <td class="label">Servicio</td>
                <td class="value">{{ $cita->servicio }}</td>
            </tr>
            @endif
            @if($cita->barbero)
            <tr>
                <td class="label">Barbero</td>
                <td class="value">{{ $cita->barbero }}</td>
            </tr>
            @endif
            <tr>
                <td class="label">Fecha</td>
                <td class="value">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="label">Hora</td>
                <td class="value">{{ \Carbon\Carbon::parse($cita->hora)->format('g:i A') }}</td>
            </tr>
            <tr>
                <td class="label">Estado de Cita</td>
                <td class="value">
                    <span class="status-badge">{{ $cita->estado }}</span>
                </td>
            </tr>
        </table>

        <div class="footer">
            <div class="footer-line"></div>
            <p>Por favor, llega 5 minutos antes de tu cita programada.</p>
            <p>¡Gracias por tu preferencia!</p>
        </div>
    </div>
</body>
</html>
