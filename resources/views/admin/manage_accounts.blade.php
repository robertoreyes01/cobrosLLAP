{{--
    Vista: Gestión de Cuentas de Usuario
    Ubicación: resources/views/admin/manage_accounts.blade.php
    Descripción:
        Vista administrativa para gestionar las cuentas de usuarios del sistema.
        Permite crear nuevos empleados, buscar usuarios existentes, activar/desactivar cuentas
        y eliminar usuarios permanentemente.
    Variables esperadas:
        - $accounts: Illuminate\Pagination\LengthAwarePaginator | Colección paginada de usuarios, cada uno con los atributos:
            - id_usuario
            - primer_nombre, segundo_nombre
            - primer_apellido, segundo_apellido
            - correo
            - estado (1: Activo, 0: Inactivo)
            - id_rol (1: Administrador, 2: Empleado, 3: Padre/Tutor)
        - $errors: Illuminate\Support\ViewErrorBag | Errores de validación si existen
    Funcionalidad:
        - Muestra una tabla paginada con todos los usuarios del sistema
        - Permite buscar usuarios por nombre o apellido
        - Permite crear nuevos empleados con contraseña temporal automática
        - Permite activar/desactivar cuentas de usuario
        - Permite eliminar usuarios permanentemente
        - Muestra mensajes de error y éxito
        - Incluye paginación de resultados
    Componentes:
        - Formulario de búsqueda con botón de reset
        - Tabla de usuarios con información completa
        - Modal para crear nuevo empleado
        - Modal de confirmación para eliminar usuario
        - Modal de confirmación para desactivar usuario
        - Modal de confirmación para activar usuario
        - Paginación de resultados
    Características especiales:
        - Generación automática de contraseñas temporales
        - Validación de formularios del lado del servidor
        - Confirmaciones antes de acciones destructivas
        - Gestión de estados de cuenta (activo/inactivo)
        - Interfaz responsiva con modales
--}}
<x-app-layout>

    <div class="relative">
        <div class="absolute top-15.5 right-97 pr-0.5">
            <button type="button" data-tooltip="Agregar Empleado"
                onclick="document.getElementById('new-employee').showModal()"
                class="rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-user-plus-icon lucide-user-plus">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <line x1="19" x2="19" y1="8" y2="14" />
                    <line x1="22" x2="16" y1="11" y2="11" />
                </svg>
            </button>
        </div>
    </div>

    <div class="place-items-center">

        <h1 class="text-2xl font-bold my-7.5">Gestión de Cuentas</h1>

        <div class="relative mb-5 pl-3.5">
            <form action="{{ route('accounts.search') }}" method="GET" class="form">
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
                <button onclick="window.location.href='{{ route('accounts.index') }}'" data-tooltip="Volver"
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

        {{-- Mensaje temporal de éxito --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-md">
                <h2 class="text-base font-semibold text-green-700 mb-2">Éxito</h2>
                <p class="text-green-600">{{ session('success') }}</p>
            </div>
        @endif

        <div class="w-192">
            <table class="table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Rol</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($accounts->count() > 0)
                        @foreach ($accounts as $account)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $account->primer_nombre }} {{ $account->segundo_nombre }}</td>
                                <td>{{ $account->primer_apellido }} {{ $account->segundo_apellido }}</td>
                                <td>{{ $account->correo }}</td>
                                <td>
                                    @if ($account->estado == 1)
                                        <span>Activo</span>
                                    @else
                                        <span>Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($account->id_rol == 1)
                                        <span>Administrador</span>
                                    @elseif ($account->id_rol == 2)
                                        <span>Empleado</span>
                                    @elseif ($account->id_rol == 3)
                                        <span>Padre/Tutor</span>
                                    @endif
                                </td>
                                <td>
                                    <button data-tooltip="Eliminar"
                                        data-id_account="{{ $account->id_usuario }}"
                                        data-first_name="{{ $account->primer_nombre }}"
                                        data-first_lastname="{{ $account->primer_apellido }}"
                                        onclick="openDeleteUserDialog(this)"
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
                                    @if ($account->estado == 1)
                                        <button data-tooltip="Desactivar"
                                        data-id_account="{{ $account->id_usuario }}"
                                        data-first_name="{{ $account->primer_nombre }}"
                                        data-first_lastname="{{ $account->primer_apellido }}"
                                        onclick="openDeactivateUserDialog(this)"
                                            class="mx-0.5 rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-user-x-icon lucide-user-x">
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                                <circle cx="9" cy="7" r="4" />
                                                <line x1="17" x2="22" y1="8" y2="13" />
                                                <line x1="22" x2="17" y1="8" y2="13" />
                                            </svg>
                                        </button>
                                    @else
                                        <button data-tooltip="Activar"
                                        data-id_account="{{ $account->id_usuario }}"
                                        data-first_name="{{ $account->primer_nombre }}"
                                        data-first_lastname="{{ $account->primer_apellido }}"
                                        onclick="openActivateUserDialog(this)"
                                            class="mx-0.5 rounded-sm p-1.5 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-user-check-icon lucide-user-check">
                                                <path d="m16 11 2 2 4-4" />
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                                <circle cx="9" cy="7" r="4" />
                                            </svg>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron resultados</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-2 pr-4.5">
            {{ $accounts->links() }}
        </div>

        <!-- Dialog para agregar empleado -->
        <dialog id="new-employee" class="dialog w-full sm:max-w-[425px] max-h-[612px]"
            aria-labelledby="new-employee-title" aria-describedby="new-employee-description" onclick="this.close()">
            <article onclick="event.stopPropagation()">
                <header>
                    <h2 id="new-employee-title" class="text-lg font-semibold">Nuevo Empleado</h2>
                    <p id="new-employee-description">LLena los campos para agregar un nuevo empleado. Clic en crear
                        cuenta al terminar.</p>
                </header>
                <section class="">
                    <form action="{{ route('accounts.store') }}" method="POST" class="form grid gap-4 w-full"
                        id="new-employee-form">
                        @csrf
                        {{-- Nombres --}}
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="flex flex-col">
                                <label for="first_name" class="mb-1 font-medium">Primer Nombre</label>
                                <input
                                    class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                    type="text" name="primer_nombre" id="first_name" maxlength="20">
                            </div>
                            <div class="flex flex-col">
                                <label for="second_name" class="mb-1 font-medium">Segundo Nombre</label>
                                <input
                                    class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                    type="text" name="segundo_nombre" id="second_name" maxlength="20">
                            </div>
                        </div>
                        {{-- Apellidos --}}
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="flex flex-col">
                                <label for="first_lastname" class="mb-1 font-medium">Primer Apellido</label>
                                <input
                                    class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                    type="text" name="primer_apellido" id="first_lastname" maxlength="20">
                            </div>
                            <div class="flex flex-col">
                                <label for="second_lastname" class="mb-1 font-medium">Segundo Apellido</label>
                                <input
                                    class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                    type="text" name="segundo_apellido" id="second_lastname" maxlength="20">
                            </div>
                        </div>
                        {{-- Correo electrónico --}}
                        <div class="mb-4">
                            <label for="email" class="mb-1 font-medium">Correo Electrónico</label>
                            <div class="relative">
                                <input
                                    class="border rounded w-full pl-10 pr-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                                    type="email" name="correo" id="email" placeholder="nombre@ejemplo.com"
                                    maxlength="50">
                                {{-- Icono de correo --}}
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-mail-icon lucide-mail">
                                        <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                        <rect x="2" y="4" width="20" height="16" rx="2" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        {{-- Información sobre contraseña temporal --}}
                        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                            <p class="text-sm text-blue-700">
                                <strong>Nota:</strong> Se generará automáticamente una contraseña temporal. Esta
                                contraseña se mostrará después de crear la cuenta y deberá ser cambiada en el primer
                                inicio de sesión.
                            </p>
                        </div>
                        {{-- Botón de envío --}}
                        <button
                            class="w-full py-2 px-4 rounded bg-[#751711] text-white hover:bg-[#5c120e] font-semibold transition-colors duration-200 cursor-pointer shadow-md"
                            type="submit">Crear Cuenta</button>
                    </form>
                </section>
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

        <!-- Dialog para eliminar usuario -->
        <dialog id="delete-user" class="dialog" aria-labelledby="delete-user-title"
            aria-describedby="delete-user-description">
            <article>
                <header>
                    <h2 id="delete-user-title">¿Estás seguro de querer eliminar al usuario 
                        <span id="delete-user-name"></span> <span id="delete-user-lastname"></span>?
                    </h2>
                    <p id="delete-user-description">Esta acción no se puede deshacer. Este usuario será eliminado
                        permanentemente.
                    </p>
                </header>
                <footer>
                    <button class="btn-outline" onclick="document.getElementById('delete-user').close()">
                        Cancelar
                    </button>
                    <form method="POST" id="delete-user-form">
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

        <!-- Dialog para desactivar usuario -->
        <dialog id="deactivate-user" class="dialog" aria-labelledby="deactivate-user-title"
            aria-describedby="delete-user-description">
            <article>
                <header>
                    <h2 id="deactivate-user-title">¿Estás seguro de querer desactivar al usuario 
                        <span id="deactivate-user-name"></span> <span id="deactivate-user-lastname"></span>?
                    </h2>
                    <p id="deactivate-user-description">Esta acción denegará el acceso del sistema al usuario.
                    </p>
                </header>
                <footer>
                    <button class="btn-outline" onclick="document.getElementById('deactivate-user').close()">
                        Cancelar
                    </button>
                    <form method="POST" id="deactivate-user-form">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="rounded-sm py-2 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer">
                            Desactivar
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

        <!-- Dialog para activar usuario -->
        <dialog id="activate-user" class="dialog" aria-labelledby="activate-user-title"
            aria-describedby="delete-user-description">
            <article>
                <header>
                    <h2 id="activate-user-title">¿Estás seguro de querer activar al usuario 
                        <span id="activate-user-name"></span> <span id="activate-user-lastname"></span>?
                    </h2>
                    <p id="activate-user-description">Esta acción permitirá el acceso del sistema al usuario.
                    </p>
                </header>
                <footer>
                    <button class="btn-outline" onclick="document.getElementById('activate-user').close()">
                        Cancelar
                    </button>
                    <form method="POST" id="activate-user-form">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="rounded-sm py-2 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer">
                            Activar
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
    function openDeleteUserDialog(button){
        
        const id_account = button.getAttribute('data-id_account');
        const first_name = button.getAttribute('data-first_name');
        const first_lastname = button.getAttribute('data-first_lastname');

        document.getElementById('delete-user-name').textContent = first_name;
        document.getElementById('delete-user-lastname').textContent = first_lastname;

        const form = document.getElementById('delete-user-form')
        form.action = `{{ route('accounts.destroy', ':id') }}`.replace(':id', id_account);

        document.getElementById('delete-user').showModal();
    }

    function openDeactivateUserDialog(button){

        const id_account = button.getAttribute('data-id_account');
        const first_name = button.getAttribute('data-first_name');
        const first_lastname = button.getAttribute('data-first_lastname');

        document.getElementById('deactivate-user-name').textContent = first_name;
        document.getElementById('deactivate-user-lastname').textContent = first_lastname;

        const form = document.getElementById('deactivate-user-form')
        form.action = `{{ route('accounts.deactivate', ':id') }}`.replace(':id', id_account);

        document.getElementById('deactivate-user').showModal();
    }

    function openActivateUserDialog(button){

        const id_account = button.getAttribute('data-id_account');
        const first_name = button.getAttribute('data-first_name');
        const first_lastname = button.getAttribute('data-first_lastname');

        document.getElementById('activate-user-name').textContent = first_name;
        document.getElementById('activate-user-lastname').textContent = first_lastname;

        const form = document.getElementById('activate-user-form')
        form.action = `{{ route('accounts.activate', ':id') }}`.replace(':id', id_account);

        document.getElementById('activate-user').showModal();
    }

</script>