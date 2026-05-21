@props([
    'title' => config('app.name', 'Laravel'),
    'breadcrumbs' => [], //arreglo vacio por defecto
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/127d59519a.js" crossorigin="anonymous"></script>

    <!-- WireUI -->
    <wireui:scripts />

    <!-- Styles -->
    @livewireStyles

    <style>
        /* Modern Premium Dark Mode overrides for Admin Panel */
        body {
            background-color: #070707 !important;
            color: #ffffff !important;
            font-family: 'Poppins', 'Figtree', sans-serif !important;
        }

        /* Top Navbar & Sidebar Custom */
        nav, aside {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Rappasoft Livewire Tables Dark Overrides */
        .laravel-livewire-table, .bg-white {
            background-color: #121212 !important;
            color: #ffffff !important;
            border: 1px solid #1f2937 !important;
            border-radius: 16px !important;
        }

        /* Table headers */
        table thead tr {
            background-color: #181818 !important;
            border-bottom: 2px solid #1f2937 !important;
        }
        table thead th {
            color: #e2e8f0 !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            font-size: 0.75rem !important;
            letter-spacing: 0.05em !important;
            padding: 14px 16px !important;
            border: none !important;
        }

        /* Table rows */
        table tbody tr {
            background-color: #121212 !important;
            border-bottom: 1px solid #1f2937 !important;
            transition: background-color 0.15s ease !important;
        }
        table tbody tr:hover {
            background-color: #1a1a1a !important;
        }
        table tbody td {
            color: #cbd5e1 !important;
            font-size: 0.875rem !important;
            padding: 14px 16px !important;
            border: none !important;
        }

        /* Form Inputs & Filters */
        input[type="search"], 
        select, 
        input[type="text"], 
        input[type="number"], 
        input[type="email"], 
        input[type="password"], 
        textarea {
            background-color: #000000 !important;
            border: 1px solid #374151 !important;
            color: #ffffff !important;
            border-radius: 10px !important;
            padding: 8px 12px !important;
            transition: all 0.2s ease !important;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #eab308 !important;
            box-shadow: 0 0 0 1px #eab308 !important;
            outline: none !important;
        }

        /* Livewire Datatable pagination buttons */
        .page-link, .pagination button, .pagination span, .laravel-livewire-table-search-input {
            background-color: #000000 !important;
            border-color: #374151 !important;
            color: #ffffff !important;
        }
        .page-item.active .page-link, .pagination button.active {
            background-color: #eab308 !important;
            color: #000000 !important;
            border-color: #eab308 !important;
            font-weight: bold !important;
        }

        /* Text utility classes */
        .text-gray-900, .text-gray-800, .text-gray-700, .text-slate-700 {
            color: #f8fafc !important;
        }
        .text-gray-600, .text-gray-500 {
            color: #94a3b8 !important;
        }
        .bg-gray-50, .bg-gray-100 {
            background-color: #121212 !important;
        }
        .border-gray-200, .border-gray-300, .border-default {
            border-color: #1f2937 !important;
        }

        /* Buttons matching the Barber Panel design */
        button.bg-blue-600, a.bg-blue-600, .bg-blue-500 {
            background-color: #eab308 !important;
            color: #000000 !important;
            font-weight: 700 !important;
            border-radius: 10px !important;
            border: none !important;
            transition: all 0.2s ease !important;
            padding: 10px 18px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
        }
        button.bg-blue-600:hover, a.bg-blue-600:hover, .bg-blue-500:hover {
            background-color: #ca8a04 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(234, 179, 8, 0.2) !important;
        }

        /* Breadcrumbs Current Active Link styling */
        .text-slate-700 h6, .font-bold.mt-2 {
            color: #eab308 !important;
            font-size: 1.125rem !important;
        }
        ol.flex.flex-wrap.text-slate-700.text-sm a {
            color: #cbd5e1 !important;
        }
        ol.flex.flex-wrap.text-slate-700.text-sm a:hover {
            color: #eab308 !important;
        }

        /* Flowbite Drawer overlays and scrollbars */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #000000;
        }
        ::-webkit-scrollbar-thumb {
            background: #222222;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #eab308;
        }
    </style>
</head>

<body class="font-sans antialiased bg-black text-white min-h-screen">

    @include('layouts.includes.admin.navigation')
    @include('layouts.includes.admin.sidebar')

    <div class="p-6 sm:ml-64 mt-14 min-h-[calc(100vh-3.5rem)] bg-gradient-to-b from-[#070707] to-[#121212]">
        <div class="mt-8 flex justify-between items-center w-full mb-6">
            @include('layouts.includes.admin.breadcrumb')
            @isset($action)
                <div class="flex items-center gap-3">
                    {{ $action }}
                </div>
            @endisset
        </div>
        
        <main class="space-y-6">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')
    {{-- Mostrar Sweet Alert --}}
    @if (session('swal'))
        <script>
            Swal.fire(@json(session('swal')));
        </script>
    @endif

    @livewireScripts

    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>
