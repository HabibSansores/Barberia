<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Citas</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .text-center { text-align: center; }
        .status-pending { color: orange; }
        .status-confirmed { color: blue; }
        .status-completed { color: green; }
        .status-cancelled { color: red; }
    </style>
</head>
<body>
    <h1 class="text-center">Reporte de Citas</h1>
    <p class="text-center">Generado el {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Barbero</th>
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->id }}</td>
                <td>{{ $appointment->client->name ?? 'N/A' }}</td>
                <td>{{ $appointment->barber->name ?? 'N/A' }}</td>
                <td>{{ $appointment->service->name ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}</td>
                <td class="status-{{ $appointment->status }}">{{ ucfirst($appointment->status) }}</td>
                <td>${{ number_format($appointment->total_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
