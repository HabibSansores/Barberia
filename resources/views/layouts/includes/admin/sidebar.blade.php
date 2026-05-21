@php
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'href' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'header' => 'Administración',
        ],
        [
            'name' => 'Roles y permisos',
            'icon' => 'fa-solid fa-shield-halved',
            'href' => route('admin.roles.index'),
            'active' => request()->routeIs('admin.roles.*'),
        ],
        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-users',
            'href' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*'),
        ],
        [
            'header' => 'Barbería',
        ],
        [
            'name' => 'Barberos',
            'icon' => 'fa-solid fa-scissors',
            'href' => route('admin.barbers.index'),
            'active' => request()->routeIs('admin.barbers.*'),
        ],
        [
            'name' => 'Servicios',
            'icon' => 'fa-solid fa-list-ul',
            'href' => route('admin.services.index'),
            'active' => request()->routeIs('admin.services.*'),
        ],
        [
            'name' => 'Citas',
            'icon' => 'fa-regular fa-calendar-check',
            'href' => route('admin.appointments.index'),
            'active' => request()->routeIs('admin.appointments.*'),
        ],
    ];
@endphp

<aside id="top-bar-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-full pt-16 transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-4 py-6 overflow-y-auto bg-[#0a0a0a] border-e border-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    @isset($link['header'])
                        {{-- Renderiza el Header --}}
                        <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            {{ $link['header'] }}
                        </div>
                    @else
                        @isset($link['submenu'])
                            {{-- Renderiza Botón con Submenú --}}
                            <button type="button"
                                class="flex items-center w-full justify-between px-3 py-2 text-sm text-gray-300 rounded-xl hover:bg-[#121212] hover:text-yellow-500 group transition duration-150"
                                data-collapse-toggle="dropdown-{{ $loop->index }}">
                                <span class="w-6 h-6 inline-flex items-center justify-center text-gray-500 group-hover:text-yellow-500 transition">
                                    <i class="{{ $link['icon'] }}"></i>
                                </span>
                                <span class="flex-1 ms-3 text-left whitespace-nowrap font-medium">{{ $link['name'] }}</span>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                                </svg>
                            </button>
                            <ul id="dropdown-{{ $loop->index }}" class="hidden py-2 space-y-1">
                                @foreach ($link['submenu'] as $item)
                                    <li>
                                        <a href="{{ $item['href'] }}"
                                            class="pl-10 flex items-center px-3 py-2 text-xs font-medium text-gray-400 rounded-xl hover:bg-[#121212] hover:text-yellow-500 transition">
                                            {{ $item['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            {{-- Renderiza Enlace Simple (Solo si NO hay submenú) --}}
                            <a href="{{ $link['href'] }}"
                                class="flex items-center px-3 py-2.5 text-sm rounded-xl transition duration-150 ease-in-out group {{ $link['active'] ? 'bg-yellow-500 text-black font-bold shadow-lg shadow-yellow-500/20' : 'text-gray-300 hover:bg-[#121212] hover:text-yellow-500' }}">
                                <span class="w-6 h-6 inline-flex items-center justify-center {{ $link['active'] ? 'text-black' : 'text-gray-500 group-hover:text-yellow-500 transition' }}">
                                    <i class="{{ $link['icon'] }}"></i>
                                </span>
                                <span class="ms-3">{{ $link['name'] }}</span>
                            </a>
                        @endisset
                    @endisset
                </li>
            @endforeach
        </ul>
    </div>
</aside>
