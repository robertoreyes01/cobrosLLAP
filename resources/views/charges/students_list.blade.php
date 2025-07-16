{{--
    Vista: Lista de Estudiantes
    Ubicación: resources/views/charges/students_list.blade.php
    Descripción:
        Muestra una lista paginada de estudiantes registrados en el sistema, permitiendo buscar por nombre y navegar al registro de pagos de cada estudiante.
        Incluye controles para búsqueda, navegación y visualización de errores.
    Variables esperadas:
        - $alumnos: Illuminate\Pagination\LengthAwarePaginator | Colección paginada de estudiantes, cada uno con los atributos:
            - nombres
            - apellidos
    Funcionalidad:
        - Permite buscar estudiantes por nombre.
        - Permite navegar al registro de pagos de un estudiante.
        - Muestra mensajes de error si existen.
        - Incluye paginación.
--}}
<x-app-layout>
    <div class="relative">
        <div class="absolute top-0 right-0.5">
            <button
                class="rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md"
                onclick="window.location.href='{{ route('charges.parents') }}'">
                Ver padres/tutores
            </button>
        </div>
    </div>

    <div class="place-items-center">
        <h1 class="text-2xl font-bold my-6">Lista de estudiantes</h1>
        <div class="relative mb-5 pl-3.5">
            <form action="{{ route('search.students')}}" method="GET" class="form">
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
                <button onclick="window.location.href='{{ route('charges.students') }}'" data-tooltip="Volver"
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
                    @if ($alumnos->count() > 0)
                    @foreach ($alumnos as $alumno)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $alumno->nombres }}</td>
                            <td>{{ $alumno->apellidos }}</td>
                            <td class="flex justify-center">
                                {{-- Botón para ver pagos del alumno --}}
                                <form action="{{ route('payment.register', $alumno) }}" method="GET">
                                    <button class="rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md"
                                    type="submit" data-tooltip="Ver pagos">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.75"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-file-search-icon lucide-file-search">
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                            <path
                                                d="M4.268 21a2 2 0 0 0 1.727 1H18a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v3" />
                                            <path d="m9 18-1.5-1.5" />
                                            <circle cx="5" cy="14" r="3" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-muted-foreground text-lg">No hay estudiantes registrados</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-2 pr-4.5">
            {{ $alumnos->links() }}
        </div>

    </div>
</x-app-layout>