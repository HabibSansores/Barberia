@php
    $colorClass = match(strtolower($appointment->estado)) {
        'pendiente' => 'bg-yellow-500/10 text-yellow-500 border-yellow-500/30',
        'confirmada' => 'bg-blue-500/10 text-blue-500 border-blue-500/30',
        'completada' => 'bg-green-500/10 text-green-500 border-green-500/30',
        'cancelada' => 'bg-red-500/10 text-red-500 border-red-500/30',
        default => 'bg-gray-500/10 text-gray-500 border-gray-500/30',
    };
@endphp

<span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full border {{ $colorClass }}">
    <span class="w-1.5 h-1.5 rounded-full mr-1.5 bg-current opacity-80"></span>
    {{ ucfirst($appointment->estado) }}
</span>
