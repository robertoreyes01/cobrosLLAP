{{--
    Vista: Gestión de Estudiantes
    Ubicación: resources/views/admin/manage_students.blade.php
    Descripción:
        Vista administrativa para gestionar los estudiantes del sistema educativo.
        Permite crear, editar, eliminar y buscar estudiantes, incluyendo su información personal y sección asignada.
    Variables esperadas:
        - $students: Illuminate\Pagination\LengthAwarePaginator | Colección paginada de estudiantes, cada uno con los atributos:
            - id_alumno
            - nombres
            - apellidos
            - id_seccion
            - seccion (nombre de la sección obtenido por join)
    Funcionalidad:
        - Muestra una tabla paginada con todos los estudiantes.
        - Permite buscar estudiantes por nombre o apellido.
        - Permite agregar nuevos estudiantes mediante un modal.
        - Permite editar estudiantes existentes mediante un modal.
        - Permite eliminar estudiantes con confirmación.
        - Muestra mensajes de error si existen.
        - Incluye validación de formularios.
        - Incluye paginación de resultados.
    Componentes:
        - Formulario de búsqueda con botón de reset
        - Modal para agregar nuevo estudiante
        - Modal para editar estudiante existente
        - Modal de confirmación para eliminar estudiante
        - Tabla responsiva con acciones CRUD
        - Paginación de resultados
--}}
<x-app-layout>
    <div class="relative">
        <div class="absolute top-14 right-118 pr-0.5">
            <button type="button" data-tooltip="Agregar estudiante"
                onclick="document.getElementById('new-student').showModal()"
                class="rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-user-round-plus-icon lucide-user-round-plus">
                    <path d="M2 21a8 8 0 0 1 13.292-6" />
                    <circle cx="10" cy="8" r="5" />
                    <path d="M19 16v6" />
                    <path d="M22 19h-6" />
                </svg>
            </button>
        </div>
    </div>

    <div class="place-items-center">
        <h1 class="text-2xl font-bold my-6">Gestión de Estudiantes</h1>

        <div class="relative mb-5 pl-3.5">
            <form action="{{ route('search.student') }}" method="GET" class="form">
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
                <button onclick="window.location.href='{{ route('students.index') }}'" data-tooltip="Volver"
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

        <div class="w-150">
            <table class="table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Sección</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($students->count() > 0)
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->nombres }}</td>
                                <td>{{ $student->apellidos }}</td>
                                <td>{{ $student->seccion }}</td>
                                <td class="flex justify-center">
                                    <button data-tooltip="Editar" data-id="{{ $student->id_alumno }}"
                                        data-names="{{ $student->nombres }}" data-lastNames="{{ $student->apellidos }}"
                                        data-section="{{ $student->id_seccion }}" onclick="openEditStudentDialog(this)"
                                        class="mx-0.5 rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.25"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-pencil-icon lucide-pencil">
                                            <path
                                                d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                            <path d="m15 5 4 4" />
                                        </svg>
                                    </button>
                                    <button data-tooltip="Eliminar" data-id="{{ $student->id_alumno }}"
                                        data-names="{{ $student->nombres }}"
                                        data-lastNames="{{ $student->apellidos }}"
                                        onclick="openDeleteStudentDialog(this)"
                                        class="mx-0.5 rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.25"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-trash-icon lucide-trash">
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                            <path d="M3 6h18" />
                                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        </svg>
                                    </button>
                                    <button data-tooltip="Asignar padre/tutor"
                                        data-id="{{ $student->id_alumno }}"
                                        data-names="{{ $student->nombres }}"
                                        onclick="openAssignParentDialog(this)"
                                        class="mx-0.5 rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 -960 960 960" fill="#e3e3e3">
                                            <path
                                                d="M480-880q50 0 85 35t35 85q0 50-35 85t-85 35q-50 0-85-35t-35-85q0-50 35-85t85-35Zm0 280q47 0 93 11t83 31q38 19 61 45t23 57v232q0 17-8 33.5T710-160q-14 14-32.5 26T636-112v-90q0-38-52.5-62T480-288q-50 0-96.5 20.5T326-214q38 15 78 21t82 7h34v104q-7 2-14.5 2H490q-36 0-82.5-8T319-113q-42-17-70.5-44.5T220-224v-232q0-31 23-57t60-45q38-20 84-31t93-11Zm0 240q33 0 56.5-23.5T560-440q0-33-23.5-56.5T480-520q-33 0-56.5 23.5T400-440q0 33 23.5 56.5T480-360Z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-muted-foreground text-lg">No hay estudiantes
                                registrados</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-2 pr-4.5">
            {{ $students->links() }}
        </div>

        <!-- Dialog para agregar estudiante -->
        <dialog id="new-student" class="dialog w-full sm:max-w-[425px] max-h-[612px]"
            aria-labelledby="new-student-title" aria-describedby="new-student-description" onclick="this.close()">
            <article onclick="event.stopPropagation()">
                <header>
                    <h2 id="new-student-title" class="text-lg font-semibold">Nuevo Estudiante</h2>
                    <p id="new-student-description">LLena los campos para agregar un nuevo estudiante. Clic en guardar
                        al terminar.</p>
                </header>
                <section class="">
                    <form action="{{ route('students.store') }}" method="POST" class="form grid gap-4 w-3/5"
                        id="new-student-form">
                        @csrf
                        <div class="grid gap-3">
                            <label for="names">Nombres</label>
                            <input type="text" id="names" name="nombres" placeholder="Digite los nombres"
                                maxlength="29">
                        </div>
                        <div class="grid gap-3">
                            <label for="last-names">Apellidos</label>
                            <input type="text" id="last-names" name="apellidos"
                                placeholder="Digite los apellidos" maxlength="29">
                        </div>
                        <div class="grid gap-3">
                            <label for="section">Sección</label>
                            <select name="sección" id="section" class="select w-full">
                                <optgroup label="Secciones">
                                    <option value="1">Inicial 2-3 años</option>
                                    <option value="2">Parvularia 4-6 años</option>
                                    <option value="3">Tercer Ciclo</option>
                                    <option value="4">Bachiller</option>
                                </optgroup>
                            </select>
                        </div>
                    </form>
                </section>
                <footer class="mt-4">
                    <button class="btn-outline" onclick="this.closest('dialog').close()">Cancelar</button>
                    <button
                        class="rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer"
                        type="submit" form="new-student-form"
                        onclick="document.getElementById('new-student-form').submit()">
                        Guardar
                    </button>
                </footer>
                <form method="dialog">
                    <button aria-label="Close dialog">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </form>
            </article>
        </dialog>

        <!-- Dialog para editar estudiante -->
        <dialog id="edit-student" class="dialog w-full sm:max-w-[425px] max-h-[612px]"
            aria-labelledby="edit-student-title" aria-describedby="edit-student-description" onclick="this.close()">
            <article onclick="event.stopPropagation()">
                <header>
                    <h2 id="edit-student-title" class="text-lg font-semibold">Editar Estudiante</h2>
                    <p id="edit-student-description">Haz los cambios necesarios para el estudiante. Clic en guardar
                        cambios al terminar.</p>
                </header>
                <section class="">
                    <form method="POST" class="form grid gap-4 w-3/5" id="edit-student-form">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-3">
                            <label for="names">Nombres</label>
                            <input type="text" id="edit-names" name="nombres" maxlength="29">
                        </div>
                        <div class="grid gap-3">
                            <label for="last-names">Apellidos</label>
                            <input type="text" id="edit-lastNames" name="apellidos" maxlength="29">
                        </div>
                        <div class="grid gap-3">
                            <label for="section">Sección</label>
                            <select name="sección" id="edit-section" class="select w-full">
                                <optgroup label="Secciones">
                                    <option value="1">Inicial 2-3 años</option>
                                    <option value="2">Parvularia 4-6 años</option>
                                    <option value="3">Tercer Ciclo</option>
                                    <option value="4">Bachiller</option>
                                </optgroup>
                            </select>
                        </div>
                    </form>
                </section>
                <footer class="mt-4">
                    <button class="btn-outline" onclick="this.closest('dialog').close()">Cancelar</button>
                    <button
                        class="rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer"
                        type="submit" form="edit-student-form"
                        onclick="document.getElementById('edit-student-form').submit()">
                        Guardar Cambios
                    </button>
                </footer>
                <form method="dialog">
                    <button aria-label="Close dialog">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </form>
            </article>
        </dialog>

        <!-- Dialog para eliminar estudiante -->
        <dialog id="delete-student" class="dialog" aria-labelledby="delete-student-title"
            aria-describedby="delete-student-description">
            <article>
                <header>
                    <h2 id="delete-student-title">¿Estás seguro de querer eliminar a <span
                            id="delete-student-names"></span> <span id="delete-student-lastNames"></span>?</h2>
                    <p id="delete-student-description">Esta acción no se puede deshacer. Este estudiante será eliminado
                        permanentemente.</p>
                </header>

                <footer>
                    <button class="btn-outline" onclick="document.getElementById('delete-student').close()">
                        Cancelar
                    </button>
                    <form method="POST" id="delete-student-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="rounded-sm py-2 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer">
                            Eliminar
                        </button>
                    </form>
                </footer>
                <form method="dialog">
                    <button aria-label="Close dialog">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </form>
            </article>
        </dialog>

        <!-- Dialog para asignar padre/tutor -->
        <dialog id="assign-parent" class="dialog w-full sm:max-w-[425px] max-h-[612px]"
            aria-labelledby="assign-parent-title" aria-describedby="assign-parent-description"
            onclick="this.close()">
            <article onclick="event.stopPropagation()">
                <header>
                    <h2 id="assign-parent-title" class="text-lg font-semibold">Asignar Padre o Tutor</h2>
                    <p id="assign-parent-description">Selecciona el padre/tutor que deseas asignar a <span id="student-names"></span>.</p>
                </header>
                <section class="">
                    <form method="POST" class="form grid gap-4 w-full" id="assign-parent-form">
                        @csrf
                        <div class="grid gap-3">
                            <label for="select-parent">Padres/Tutores</label>
                            <div class="select" id="select-parent">
                                <button type="button" class="btn-outline justify-between font-normal w-full"
                                    id="select-parent-trigger" aria-haspopup="listbox" aria-expanded="false"
                                    aria-controls="select-parent-listbox">
                                    <span class="truncate text-muted-foreground">Selecciona un padre/tutor</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chevrons-up-down-icon lucide-chevrons-up-down text-muted-foreground opacity-50 shrink-0">
                                        <path d="m7 15 5 5 5-5" />
                                        <path d="m7 9 5-5 5 5" />
                                    </svg>
                                </button>

                                <div id="select-parent-popover" data-popover aria-hidden="true">
                                    <header>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-search-icon lucide-search">
                                            <circle cx="11" cy="11" r="8" />
                                            <path d="m21 21-4.3-4.3" />
                                        </svg>
                                        <input type="text" value="" placeholder="Buscar padres/tutores..."
                                            autocomplete="off" autocorrect="off" spellcheck="false"
                                            aria-autocomplete="list" role="combobox" aria-expanded="false"
                                            aria-controls="select-parent-listbox"
                                            aria-labelledby="select-parent-trigger" />
                                    </header>
                                    <section class="overflow-y-auto scrollbar max-h-64">
                                        <div role="listbox" id="select-parent-listbox" aria-orientation="vertical"
                                            aria-labelledby="select-parent-trigger">
                                            <div role="group" aria-labelledby="group-label-select-parent-items-1">
                                                <div role="heading" id="group-label-select-parent-items-1">
                                                    Padres/Tutores
                                                </div>
                                                @if ($parents->count() > 0)
                                                    @foreach ($parents as $parent)
                                                        <div id="select-parent-items-1-{{ $loop->iteration }}"
                                                            role="option" data-value="{{ $parent->id_usuario }}">
                                                            <span class="truncate">{{ $parent->primer_nombre }}
                                                                {{ $parent->segundo_nombre }}
                                                                {{ $parent->primer_apellido }}
                                                                {{ $parent->segundo_apellido }}
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div role="option" aria-selected="false" tabindex="0">No hay
                                                        padres/tutores registrados</div>
                                                @endif
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <input type="hidden" name="id_padre" value="" />
                            </div>
                        </div>
                        <input type="hidden" name="id_estudiante" id="id-student" value="" />
                    </form>
                </section>
                <footer class="mt-4">
                    <button class="btn-outline" onclick="this.closest('dialog').close()">Cancelar</button>
                    <button
                        class="rounded-sm py-1 px-3.5 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer"
                        type="submit" form="assign-parent-form"
                        onclick="document.getElementById('assign-parent-form').submit()">
                        Aceptar
                    </button>
                </footer>
                <form method="dialog">
                    <button aria-label="Close dialog">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </form>
            </article>
        </dialog>

    </div>
</x-app-layout>
<script>
    function openEditStudentDialog(button) {
        const id = button.getAttribute('data-id');
        const names = button.getAttribute('data-names');
        const lastNames = button.getAttribute('data-lastNames');
        const section = button.getAttribute('data-section');

        document.getElementById('edit-names').value = names;
        document.getElementById('edit-lastNames').value = lastNames;
        document.getElementById('edit-section').value = section;

        const form = document.getElementById('edit-student-form')
        form.action = `{{ route('students.update', ':id') }}`.replace(':id', id);

        document.getElementById('edit-student').showModal();
    }

    function openDeleteStudentDialog(button) {
        const id = button.getAttribute('data-id');
        const names = button.getAttribute('data-names');
        const lastNames = button.getAttribute('data-lastNames');

        document.getElementById('delete-student-names').textContent = names;
        document.getElementById('delete-student-lastNames').textContent = lastNames;

        const form = document.getElementById('delete-student-form')
        form.action = `{{ route('students.destroy', ':id') }}`.replace(':id', id);

        document.getElementById('delete-student').showModal();
    }

    function openAssignParentDialog(button) {
        const id= button.getAttribute('data-id');
        const names = button.getAttribute('data-names');

        document.getElementById('id-student').value = id;
        document.getElementById('student-names').textContent = names;

        const form = document.getElementById('assign-parent-form')
        form.action = `{{ route('assign.parent') }}`;

        document.getElementById('assign-parent').showModal();
    }
</script>
