{{--
    Vista: Gestión de Precios de Grado
    Ubicación: resources/views/admin/manage_price.blade.php
    Descripción:
        Vista administrativa para gestionar los precios de matrícula y mensualidad de las diferentes secciones/grados del sistema educativo.
        Permite crear, editar y eliminar secciones con sus respectivos precios.
    Variables esperadas:
        - $prices: Illuminate\Database\Eloquent\Collection | Colección de secciones con sus precios, cada una con los atributos:
            - id_seccion
            - nombre
            - matricula
            - mensualidad
    Funcionalidad:
        - Muestra una tabla con todas las secciones y sus precios.
        - Permite agregar nuevas secciones mediante un modal.
        - Permite editar secciones existentes mediante un modal.
        - Permite eliminar secciones con confirmación.
        - Muestra mensajes de error si existen.
        - Incluye validación de formularios.
    Componentes:
        - Modal para agregar nueva sección
        - Modal para editar sección existente
        - Modal de confirmación para eliminar sección
        - Tabla responsiva con acciones CRUD
--}}
<x-app-layout>
    <div class="relative">
        <div class="absolute top-1 right-138 pr-0.5">
            <button type="button" data-tooltip="Agregar sección"
                onclick="document.getElementById('new-section').showModal()"
                class="rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-circle-plus-icon lucide-circle-plus">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M8 12h8" />
                    <path d="M12 8v8" />
                </svg>
            </button>
        </div>
    </div>

    <div class="place-items-center">
        <h1 class="text-2xl font-bold my-8">Gestión de Precios de Grado</h1>
        <div class="w-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Matricula</th>
                        <th>Mensualidad</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($prices->count() > 0)
                        @foreach ($prices as $price)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $price->nombre }}</td>
                                <td>{{ $price->matricula }}</td>
                                <td>{{ $price->mensualidad }}</td>
                                <td>
                                    <button data-tooltip="Editar" data-id_section="{{ $price->id_seccion }}"
                                        data-name="{{ $price->nombre }}" data-registration="{{ $price->matricula }}"
                                        data-monthly="{{ $price->mensualidad }}" onclick="openEditSectionDialog(this)"
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
                                    <button data-tooltip="Eliminar"
                                        data-id_section="{{ $price->id_seccion }}"
                                        data-name="{{ $price->nombre }}"
                                        onclick="openDeleteSectionDialog(this)"
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
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-muted-foreground text-lg">No hay precios
                                registrados</td>
                        </tr>
                    @endif
                </tbody>
            </table>
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

        <!-- Dialog para agregar sección -->
        <dialog id="new-section" class="dialog w-full sm:max-w-[425px] max-h-[612px]"
            aria-labelledby="new-section-title" aria-describedby="new-section-description" onclick="this.close()">
            <article onclick="event.stopPropagation()">
                <header>
                    <h2 id="new-section-title" class="text-lg font-semibold">Nueva Sección</h2>
                    <p id="new-section-description">LLena los campos para agregar una nueva sección. Clic en guardar al
                        terminar.</p>
                </header>
                <section>
                    <form action="{{ route('prices.store') }}" method="POST" class="form grid gap-4 w-3/5"
                        id="new-section-form">
                        @csrf
                        <div class="grid gap-3">
                            <label for="name">Nombre de la sección</label>
                            <input type="text" id="name" name="nombre"
                                placeholder="Digite el nombre de la sección" maxlength="35">
                        </div>
                        <div class="relative grid gap-3">
                            <label for="matricula">Matrícula</label>
                            <input type="number" id="matricula" name="matricula" placeholder="0.00" class="pl-10">
                            <span class="absolute inset-y-11 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-dollar-sign-icon lucide-dollar-sign">
                                    <line x1="12" x2="12" y1="2" y2="22" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                            </span>
                        </div>
                        <div class="relative grid gap-3">
                            <label for="mensualidad">Mensualidad</label>
                            <input type="number" id="mensualidad" name="mensualidad" placeholder="0.00"
                                class="pl-10">
                            <span class="absolute inset-y-11 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-dollar-sign-icon lucide-dollar-sign">
                                    <line x1="12" x2="12" y1="2" y2="22" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                            </span>
                        </div>
                    </form>
                </section>
                <footer>
                    <button class="btn-outline" onclick="this.closest('dialog').close()">Cancelar</button>
                    <button
                        class="rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer"
                        type="submit" form="new-section-form"
                        onclick="document.getElementById('new-section-form').submit()">
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

        <!-- Dialog para editar sección -->
        <dialog id="edit-section" class="dialog w-full sm:max-w-[425px] max-h-[612px]"
            aria-labelledby="edit-section-title" aria-describedby="edit-section-description" onclick="this.close()">
            <article onclick="event.stopPropagation()">
                <header>
                    <h2 id="edit-section-title" class="text-lg font-semibold">Editar Sección</h2>
                    <p id="edit-section-description">Haz los cambios necesarios para la sección. Clic en guardar
                        cambios al terminar.</p>
                </header>
                <section>
                    <form method="POST" class="form grid gap-4 w-3/5" id="edit-section-form">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-3">
                            <label for="edit-name">Nombre de la sección</label>
                            <input type="text" id="edit-name" name="nombre"
                                placeholder="Digite el nombre de la sección" maxlength="35">
                        </div>
                        <div class="relative grid gap-3">
                            <label for="edit-registration">Matrícula</label>
                            <input type="number" id="edit-registration" name="matricula" placeholder="0.00"
                                class="pl-10">
                            <span class="absolute inset-y-11 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-dollar-sign-icon lucide-dollar-sign">
                                    <line x1="12" x2="12" y1="2" y2="22" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                            </span>
                        </div>
                        <div class="relative grid gap-3">
                            <label for="edit-monthly">Mensualidad</label>
                            <input type="number" id="edit-monthly" name="mensualidad" placeholder="0.00"
                                class="pl-10">
                            <span class="absolute inset-y-11 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-dollar-sign-icon lucide-dollar-sign">
                                    <line x1="12" x2="12" y1="2" y2="22" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg>
                            </span>
                        </div>
                    </form>
                </section>
                <footer>
                    <button class="btn-outline" onclick="this.closest('dialog').close()">Cancelar</button>
                    <button
                        class="rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer"
                        type="submit" form="edit-section-form"
                        onclick="document.getElementById('edit-section-form').submit()">
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

        <!-- Dialog para eliminar sección -->
        <dialog id="delete-section" class="dialog" aria-labelledby="delete-section-title"
            aria-describedby="delete-section-description">
            <article>
                <header>
                    <h2 id="delete-section-title">¿Estás seguro de querer eliminar la sección 
                        <span id="delete-section-name"></span>?
                    </h2>
                    <p id="delete-section-description">Esta acción no se puede deshacer. Esta sección será eliminada
                        permanentemente.
                    </p>
                </header>
                <footer>
                    <button class="btn-outline" onclick="document.getElementById('delete-section').close()">
                        Cancelar
                    </button>
                    <form method="POST" id="delete-section-form">
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

    </div>
</x-app-layout>

<script>
    function openEditSectionDialog(button) {
        const id_section = button.getAttribute('data-id_section');
        const name = button.getAttribute('data-name');
        const registration = button.getAttribute('data-registration');
        const monthly = button.getAttribute('data-monthly');

        document.getElementById('edit-name').value = name;
        document.getElementById('edit-registration').value = registration;
        document.getElementById('edit-monthly').value = monthly;

        const form = document.getElementById('edit-section-form')
        form.action = `{{ route('prices.update', ':id') }}`.replace(':id', id_section);

        document.getElementById('edit-section').showModal();
    }

    function openDeleteSectionDialog(button) {
        const id_section = button.getAttribute('data-id_section');
        const name = button.getAttribute('data-name');

        document.getElementById('delete-section-name').textContent = name;

        const form = document.getElementById('delete-section-form')
        form.action = `{{ route('prices.destroy', ':id') }}`.replace(':id', id_section);

        document.getElementById('delete-section').showModal();
    }

</script>