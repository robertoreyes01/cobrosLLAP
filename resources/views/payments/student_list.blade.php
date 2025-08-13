{{--
    Vista: Lista de Estudiantes Asociados
    Ubicación: resources/views/payments/student_list.blade.php
    Descripción:
        Vista que muestra la lista de estudiantes asociados a un padre o tutor específico.
        Permite al padre/tutor autenticado ver todos los estudiantes bajo su responsabilidad
        y acceder al historial de pagos de cada uno.
    Variables esperadas:
        - $padre: App\Models\usuario | Modelo del usuario padre/tutor autenticado con sus datos
        - $alumnos: Illuminate\Database\Eloquent\Collection | Colección de estudiantes asociados al padre/tutor
    Funcionalidad:
        - Muestra información del padre/tutor en el título
        - Lista todos los estudiantes asociados al padre/tutor
        - Permite navegar al historial de pagos de cada estudiante
        - Muestra mensaje cuando no hay estudiantes asociados
    Componentes:
        - Tabla de estudiantes con información básica
        - Botón de acción para ver pagos de cada estudiante
        - Mensaje informativo cuando no hay datos
    Navegación:
        - Al hacer clic en "Ver pagos" se redirige a la vista de registro de pagos del estudiante
    Restricciones:
        - Solo accesible para usuarios autenticados
        - Muestra únicamente estudiantes asociados al padre/tutor autenticado
--}}

<x-app-layout>
    <div class="place-items-center">

        {{-- Título de la página --}}
        <h2 class="text-2xl font-bold my-8">Alumno/s Asociado a {{ $padre->primer_nombre }} {{ $padre->primer_apellido }}</h2>
        <div class="w-130">
            
            {{-- Tabla de alumnos --}}
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
                            <td colspan="4" class="text-center text-muted-foreground text-lg">No hay alumnos registrados a su cargo</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>