<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Consolidado de Citas</title>
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
            padding: 40px 0;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #121212;
            border: 1px solid #1a1a1a;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .email-header {
            background-color: #080808;
            padding: 35px 30px;
            text-align: center;
            border-bottom: 2px solid #eab308;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            color: #eab308;
            letter-spacing: 3px;
        }
        .email-header p {
            margin: 8px 0 0;
            color: #888;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .email-body {
            padding: 40px 30px;
        }
        .email-body h2 {
            color: #ffffff;
            font-size: 20px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .email-body p {
            font-size: 15px;
            line-height: 1.8;
            margin-top: 0;
            margin-bottom: 24px;
            color: #a0aec0;
        }
        .highlight-box {
            background-color: #181818;
            border-left: 4px solid #eab308;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .highlight-box p {
            margin: 0;
            color: #e2e8f0;
            font-weight: 600;
        }
        .agenda-btn {
            display: inline-block;
            background-color: #eab308;
            color: #000000;
            font-weight: 700;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-size: 15px;
            text-align: center;
            transition: all 0.2s ease;
        }
        .footer {
            text-align: center;
            padding: 25px;
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

            {{-- Header --}}
            <div class="email-header">
                <h1>BARBERÍA</h1>
                <p>Reporte Consolidado de Administración</p>
            </div>

            <div class="email-body">
                <h2>¡Hola, {{ $admin->name }}!</h2>
                <p>
                    Te compartimos el resumen gerencial y la planificación de citas de todos los barberos programadas para el día de hoy.
                </p>

                @if($citas->count() > 0)
                    <div class="highlight-box">
                        <p>
                            🔥 Se tienen un total de <span style="color: #eab308; font-size: 18px;">{{ $citas->count() }}</span> citas agendadas en total para el día de hoy en la barbería.
                        </p>
                    </div>
                    <p>
                        Hemos adjuntado a este correo el <strong>documento PDF oficial consolidado</strong> con un formato sumamente profesional y detallado. El reporte incluye la hora, el nombre del cliente con su correo y teléfono, el servicio reservado y **el barbero específico asignado para cada cita**.
                    </p>
                @else
                    <div class="highlight-box" style="border-left-color: #ef4444;">
                        <p style="color: #fca5a5;">
                            📅 Hoy no se tienen citas programadas en la barbería.
                        </p>
                    </div>
                    <p>
                        ¡Es un gran día para realizar mantenimiento, revisar las métricas de rendimiento y planificar estrategias de marketing para el resto de la semana!
                    </p>
                @endif

                <div style="text-align: center; margin-top: 35px;">
                    <a href="{{ route('login') }}" class="agenda-btn">Ir al Panel de Administración</a>
                </div>
            </div>

            <div class="footer">
                &copy; {{ date('Y') }} Barbería. Todos los derechos reservados.
            </div>
        </div>
    </div>
</body>
</html>
