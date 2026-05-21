<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte General Diario de Citas</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #2d3748;
            margin: 0;
            padding: 0;
            background-color: #f7fafc;
        }
        .header-bg {
            background-color: #0c0c0c;
            color: #ffffff;
            padding: 40px 50px 30px 50px;
            border-bottom: 4px solid #eab308;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-title {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 2px;
            color: #eab308;
            margin: 0;
        }
        .header-subtitle {
            font-size: 11px;
            color: #a0aec0;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 5px 0 0 0;
        }
        .header-date {
            text-align: right;
            font-size: 14px;
            color: #e2e8f0;
            font-weight: 500;
        }
        .content {
            padding: 40px 50px;
        }
        .admin-info {
            background-color: #ffffff;
            border: 1px solid #edf2f7;
            border-radius: 10px;
            padding: 20px 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        .admin-info-table {
            width: 100%;
        }
        .admin-label {
            font-size: 11px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }
        .admin-value {
            font-size: 16px;
            color: #1a202c;
            font-weight: bold;
            margin-top: 3px;
        }
        .stats-grid {
            width: 100%;
            margin-bottom: 35px;
        }
        .stat-card {
            background-color: #ffffff;
            border: 1px solid #edf2f7;
            border-radius: 10px;
            padding: 15px 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        .stat-label {
            font-size: 11px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }
        .stat-val {
            font-size: 24px;
            color: #eab308;
            font-weight: bold;
            margin-top: 5px;
        }
        .stat-val.total {
            color: #1a202c;
        }
        .stat-val.confirmadas {
            color: #2563eb;
        }
        .stat-val.completadas {
            color: #059669;
        }
        .citas-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border: 1px solid #edf2f7;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        .citas-table th {
            background-color: #f8fafc;
            color: #4a5568;
            text-align: left;
            padding: 15px 18px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #edf2f7;
        }
        .citas-table td {
            padding: 15px 18px;
            font-size: 13px;
            color: #2d3748;
            border-bottom: 1px solid #edf2f7;
        }
        .citas-table tr:last-child td {
            border-bottom: none;
        }
        .time-badge {
            background-color: #fef08a;
            color: #854d0e;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: bold;
            font-family: monospace;
            font-size: 11px;
        }
        .barber-badge {
            background-color: #0c0c0c;
            color: #eab308;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #eab308;
            display: inline-block;
            text-align: center;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-pendiente {
            background-color: #fef3c7;
            color: #d97706;
        }
        .status-confirmada {
            background-color: #dbeafe;
            color: #2563eb;
        }
        .status-completada {
            background-color: #d1fae5;
            color: #059669;
        }
        .status-cancelada {
            background-color: #fee2e2;
            color: #dc2626;
        }
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #0c0c0c;
            color: #a0aec0;
            padding: 25px 50px;
            text-align: center;
            font-size: 11px;
            border-top: 3px solid #eab308;
        }
        .footer-logo {
            font-weight: bold;
            color: #eab308;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }
    </style>
</head>
<body>

    {{-- Header Section --}}
    <div class="header-bg">
        <table class="header-table">
            <tr>
                <td>
                    <h1 class="header-title">BARBERÍA</h1>
                    <p class="header-subtitle">Reporte General Consolidado de Citas</p>
                </td>
                <td class="header-date">
                    Fecha de Emisión<br>
                    <span style="font-size: 16px; font-weight: bold; color: #eab308;">
                        {{ \Carbon\Carbon::now('America/Mexico_City')->isoFormat('LL') }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <div class="content">

        {{-- Professional Details --}}
        <div class="admin-info">
            <table class="admin-info-table">
                <tr>
                    <td style="width: 50%;">
                        <div class="admin-label">Administrador Receptor</div>
                        <div class="admin-value">{{ $admin->name }}</div>
                    </td>
                    <td style="width: 50%;">
                        <div class="admin-label">Nivel de Acceso</div>
                        <div class="admin-value">Control Gerencial y Supervisión General</div>
                    </td>
                </tr>
            </table>
        </div>

        {{-- Stats cards row --}}
        <table class="stats-grid">
            <tr>
                <td style="width: 25%; padding-right: 10px;">
                    <div class="stat-card">
                        <div class="stat-label">Total Citas</div>
                        <div class="stat-val total">{{ $citas->count() }}</div>
                    </div>
                </td>
                <td style="width: 25%; padding-right: 10px; padding-left: 10px;">
                    <div class="stat-card">
                        <div class="stat-label">Confirmadas</div>
                        <div class="stat-val confirmadas">
                            {{ $citas->filter(fn($c) => in_array(strtolower($c->estado), ['confirmada']))->count() }}
                        </div>
                    </div>
                </td>
                <td style="width: 25%; padding-right: 10px; padding-left: 10px;">
                    <div class="stat-card">
                        <div class="stat-label">Pendientes</div>
                        <div class="stat-val">
                            {{ $citas->filter(fn($c) => in_array(strtolower($c->estado), ['pendiente']))->count() }}
                        </div>
                    </div>
                </td>
                <td style="width: 25%; padding-left: 10px;">
                    <div class="stat-card">
                        <div class="stat-label">Completadas</div>
                        <div class="stat-val completadas">
                            {{ $citas->filter(fn($c) => strtolower($c->estado) === 'completada')->count() }}
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        {{-- Table List --}}
        <table class="citas-table">
            <thead>
                <tr>
                    <th style="width: 12%;">Hora</th>
                    <th style="width: 28%;">Cliente</th>
                    <th style="width: 15%;">Teléfono</th>
                    <th style="width: 18%;">Barbero Asignado</th>
                    <th style="width: 17%;">Servicio</th>
                    <th style="width: 10%; text-align: center;">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas->sortBy('hora') as $cita)
                    <tr>
                        <td>
                            <span class="time-badge">
                                {{ date('g:i A', strtotime($cita->hora)) }}
                            </span>
                        </td>
                        <td>
                            <div style="font-weight: bold; color: #1a202c;">{{ $cita->nombre_cliente }}</div>
                            @if($cita->email)
                                <div style="font-size: 11px; color: #718096; margin-top: 2px;">{{ $cita->email }}</div>
                            @else
                                <div style="font-size: 11px; color: #a0aec0; font-style: italic; margin-top: 2px;">Sin correo</div>
                            @endif
                        </td>
                        <td>
                            {{ $cita->telefono }}
                        </td>
                        <td>
                            <span class="barber-badge">
                                {{ $cita->barbero }}
                            </span>
                        </td>
                        <td style="color: #4a5568;">
                            {{ $cita->servicio }}
                        </td>
                        <td style="text-align: center;">
                            @php
                                $estadoLower = strtolower($cita->estado);
                                $badgeClass = match($estadoLower) {
                                    'pendiente' => 'status-pendiente',
                                    'confirmada' => 'status-confirmada',
                                    'completada' => 'status-completada',
                                    'cancelada' => 'status-cancelada',
                                    default => 'status-pendiente'
                                };
                            @endphp
                            <span class="status-badge {{ $badgeClass }}">
                                {{ $cita->estado }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{-- Footer --}}
    <div class="footer">
        <div class="footer-logo">BARBERÍA</div>
        <div>Este reporte consolidado fue generado de forma automática a las 8:00 AM. Por favor, reportar cualquier anomalía técnica.</div>
        <div style="margin-top: 5px;">&copy; {{ date('Y') }} Barbería. Desarrollado con excelencia.</div>
    </div>

</body>
</html>
