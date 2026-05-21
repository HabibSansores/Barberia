<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Citas — Barbería</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1e293b; background: #fff; }
        .header { background: #0f0f0f; color: #f5b800; padding: 18px 24px; margin-bottom: 20px; }
        .header h1 { font-size: 20px; font-weight: 700; letter-spacing: 1px; }
        .header p  { font-size: 10px; color: #aaa; margin-top: 4px; }
        .meta { padding: 0 24px 12px; display: flex; justify-content: space-between; font-size: 10px; color: #64748b; border-bottom: 2px solid #f5b800; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; font-size: 10px; }
        thead th { background: #1e293b; color: #f5b800; padding: 8px 10px; text-align: left; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        tbody tr:nth-child(even) { background: #f8fafc; }
        tbody tr:nth-child(odd)  { background: #ffffff; }
        tbody td { padding: 7px 10px; border-bottom: 1px solid #e2e8f0; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 9px; font-weight: 700; text-transform: uppercase; }
        .badge-pendiente  { background: #fef3c7; color: #92400e; }
        .badge-confirmada { background: #dbeafe; color: #1e40af; }
        .badge-completada { background: #d1fae5; color: #065f46; }
        .badge-cancelada  { background: #fee2e2; color: #991b1b; }
        .footer { margin-top: 20px; text-align: center; font-size: 9px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 10px; }
        .totals { margin: 14px 0; padding: 10px 14px; background: #f8fafc; border-left: 4px solid #f5b800; border-radius: 4px; font-size: 10px; }
        .totals span { font-weight: 700; color: #0f0f0f; }
    </style>
</head>
<body>

    <div class="header">
        <h1>✂ BARBERÍA — Reporte de Citas</h1>
        <p>Documento generado automáticamente</p>
    </div>

    <div class="meta">
        <span>Total de registros: <strong>{{ $appointments->count() }}</strong></span>
        <span>Generado el: {{ now()->format('d/m/Y H:i') }}</span>
    </div>

    <div class="totals">
        Pendientes: <span>{{ $appointments->whereIn('estado', ['Pendiente','pendiente'])->count() }}</span>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        Confirmadas: <span>{{ $appointments->whereIn('estado', ['Confirmada','confirmada'])->count() }}</span>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        Completadas: <span>{{ $appointments->where('estado', 'completada')->count() }}</span>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        Canceladas: <span>{{ $appointments->whereIn('estado', ['Cancelada','cancelada'])->count() }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Barbero</th>
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $cita)
            <tr>
                <td>{{ $cita->id }}</td>
                <td>{{ $cita->nombre_cliente }}</td>
                <td>{{ $cita->telefono }}</td>
                <td>{{ $cita->barbero }}</td>
                <td>{{ $cita->servicio }}</td>
                <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($cita->hora)->format('g:i A') }}</td>
                <td>
                    @php $e = strtolower($cita->estado); @endphp
                    <span class="badge badge-{{ $e }}">{{ ucfirst($cita->estado) }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; padding: 20px; color: #94a3b8;">
                    No hay citas registradas.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} Barbería — Todos los derechos reservados.
    </div>

</body>
</html>
