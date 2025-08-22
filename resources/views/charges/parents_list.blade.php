{{--
    Vista: Lista de Padres/Tutores
    Ubicación: resources/views/charges/parents_list.blade.php
    Descripción:
        Muestra una lista paginada de padres o tutores registrados en el sistema, permitiendo buscar por nombre y navegar a la lista de estudiantes asociados a cada padre/tutor.
        Incluye controles para búsqueda, navegación y visualización de errores.
    Variables esperadas:
        - $parents: Illuminate\Pagination\LengthAwarePaginator | Colección paginada de padres/tutores, cada uno con los atributos:
            - primer_nombre
            - segundo_nombre
            - primer_apellido
            - segundo_apellido
    Funcionalidad:
        - Permite buscar padres/tutores por nombre.
        - Permite navegar a la lista de estudiantes asociados a un padre/tutor.
        - Muestra mensajes de error si existen.
        - Incluye paginación.
--}}
<x-app-layout>
    <div class="relative">
        <div class="absolute top-0 right-0.5">
            <button onclick="window.location.href='{{ route('charges.students') }}'"
                class="rounded-sm p-1.5 mx-1 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                Ver estudiantes
            </button>
        </div>
    </div>

    <div class="place-items-center">
        <h2 class="text-2xl font-bold my-6">Lista de Padres/Tutores</h2>
        <div class="relative mb-5 pl-3.5">
            <form action="{{ route('search.parents') }}" method="GET" class="form">
                <div class="grid grid-cols-3 grid-rows-1 gap-1">
                    <div class="col-span-2">
                        <input type="text" id="search" name="busqueda" placeholder="Buscar" maxlength="22">
                    </div>
                    <div class="col-start-3">
                        <button type="submit" data-tooltip="Buscar"
                            class="rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                                <path d="m21 21-4.34-4.34" />
                                <circle cx="11" cy="11" r="8" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            <div class="absolute top-0 right-3.5">
                <button onclick="window.location.href='{{ route('charges.parents') }}'" data-tooltip="Volver"
                    class="rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-rotate-ccw-icon lucide-rotate-ccw">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                        <path d="M3 3v5h5" />
                    </svg>
                </button>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
                <h2 class="text-base font-semibold text-red-700 mb-2">Error</h2>
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="w-130">
            <table class="table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($parents->count() > 0)
                        @foreach ($parents as $parent)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $parent->primer_nombre }} {{ $parent->segundo_nombre }}</td>
                                <td>{{ $parent->primer_apellido }} {{ $parent->segundo_apellido }}</td>
                                <td class="flex justify-center">
                                    <form action="{{ route('payments.student', $parent) }}" method="GET">
                                        <button type="submit" data-tooltip="Ver alumnos"
                                            class="rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-user-round-search-icon lucide-user-round-search">
                                                <circle cx="10" cy="8" r="5" />
                                                <path d="M2 21a8 8 0 0 1 10.434-7.62" />
                                                <circle cx="18" cy="18" r="3" />
                                                <path d="m22 22-1.9-1.9" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-muted-foreground text-lg">No hay padres/tutores
                                registrados</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-2 pr-4.5">
            {{ $parents->links() }}
        </div>

    </div>
</x-app-layout>