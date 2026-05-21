<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Agenda Diaria de Citas</title>
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
            border-b: 2px solid #eab308;
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
                <p>Agenda Profesional Diaria</p>
            </div>

            <div class="email-body">
                <h2>¡Hola, {{ $barbero->name }}!</h2>
                <p>
                    Te saludamos desde el sistema central de la Barbería. A continuación, te compartimos tu planificación para el día de hoy.
                </p>

                @if($citas->count() > 0)
                    <div class="highlight-box">
                        <p>
                            🔥 Tienes un total de <span style="color: #eab308; font-size: 18px;">{{ $citas->count() }}</span> citas agendadas para hoy.
                        </p>
                    </div>
                    <p>
                        Para tu comodidad, hemos adjuntado a este correo un <strong>documento PDF con un diseño profesional y detallado</strong> que contiene la lista de clientes, horarios, teléfonos y servicios solicitados para hoy. Te sugerimos descargarlo o imprimirlo para llevar un expediente impecable de tus servicios.
                    </p>
                @else
                    <div class="highlight-box" style="border-left-color: #ef4444;">
                        <p style="color: #fca5a5;">
                            📅 Hoy no tienes citas programadas en tu agenda.
                        </p>
                    </div>
                    <p>
                        ¡Aprovecha este día para descansar, afilar tus herramientas de trabajo o promocionar tus servicios y crear nuevos estilos para tu catálogo!
                    </p>
                @endif

                <div style="text-align: center; margin-top: 35px;">
                    <a href="{{ route('login') }}" class="agenda-btn">Ir a mi Panel de Control</a>
                </div>
            </div>

            <div class="footer">
                &copy; {{ date('Y') }} Barbería. Todos los derechos reservados.
            </div>
        </div>
    </div>
</body>
</html>
