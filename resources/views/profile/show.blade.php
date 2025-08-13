{{--
    Vista: Perfil de Usuario
    Ubicación: resources/views/profile/show.blade.php
    Descripción:
        Vista que permite al usuario autenticado visualizar y editar su información personal.
        Incluye gestión de datos personales, correo electrónico y contraseña mediante formularios modales.
    Variables esperadas:
        - Auth::user(): Usuario autenticado con todos sus datos del modelo usuario
        - $errors: Illuminate\Support\ViewErrorBag | Errores de validación si existen
    Funcionalidad:
        - Visualización de información personal del usuario
        - Edición de nombres y apellidos mediante modal
        - Cambio de correo electrónico con validación
        - Cambio de contraseña con confirmación
        - Validación de formularios y manejo de errores
    Componentes:
        - Tarjeta de información de perfil con datos personales
        - Tarjeta de cuenta con información de correo
        - Modal para editar información personal
        - Modal para cambiar correo electrónico
        - Modal para cambiar contraseña
        - Sección de errores de validación
    Características:
        - Formularios con validación del lado del servidor
        - Confirmación de contraseña para cambios de seguridad
        - Interfaz modal para ediciones sin recargar página
        - Validación de correo electrónico
        - Límites de caracteres en campos de texto
    Rutas utilizadas:
        - route('profile.update'): Para actualizar información personal
        - route('change.email'): Para cambiar correo electrónico
        - route('change.password'): Para cambiar contraseña
--}}

<x-app-layout>
    <div class="place-items-center">
        {{-- Tarjeta de información de perfil --}}
        <div class="card w-100 mt-10">
            <header>
                <h2 class="text-2xl font-bold">Información de perfil</h2>
            </header>
            <section>
                <div class="grid grid-cols-3 grid-rows-2 gap-1">
                    <div>
                        <span class="text-sm font-bold">Nombres:</span>
                    </div>
                    <div class="col-span-2">
                        <span class="w-full">
                            {{ Auth::user()->primer_nombre }} {{ Auth::user()->segundo_nombre }}
                        </span>
                    </div>
                    <div class="row-start-2">
                        <span class="text-sm font-bold">Apellidos:</span>
                    </div>
                    <div class="col-span-2 row-start-2">
                        <span class="w-full">
                            {{ Auth::user()->primer_apellido }} {{ Auth::user()->segundo_apellido }}
                        </span>
                    </div>
                </div>
            </section>
            <footer>
                <button
                    class="w-43 rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer"
                    type="button" onclick="document.getElementById('edit-profile').showModal()">Editar Perfil</button>
            </footer>

            {{-- Modal para editar perfil --}}
            <dialog id="edit-profile" class="dialog w-full sm:max-w-[425px] max-h-[612px]" onclick="this.close()">
                <article onclick="event.stopPropagation()">
                    <header>
                        <h2>Editar Perfil</h2>
                        <p>Haz los cambios necesarios para tu perfil. Click en el boton de abajo para guardar los
                            cambios.</p>
                    </header>
                    <section>
                        <form id="edit-profile-form" action="{{ route('profile.update', Auth::user()->id_usuario) }}"
                            method="POST" class="form grid grid-cols-2 grid-rows-2 gap-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="first_name">Primer nombre</label>
                                <input type="text" name="primer_nombre" id="first_name" maxlength="20"
                                    value="{{ old('primer_nombre', Auth::user()->primer_nombre) }}">
                            </div>
                            <div>
                                <label for="second_name">Segundo nombre</label>
                                <input type="text" name="segundo_nombre" id="second_name" maxlength="20"
                                    value="{{ old('segundo_nombre', Auth::user()->segundo_nombre) }}">
                            </div>
                            <div class="row-start-2">
                                <label for="first_lastname">Primer apellido</label>
                                <input type="text" name="primer_apellido" id="first_lastname" maxlength="20"
                                    value="{{ old('primer_apellido', Auth::user()->primer_apellido) }}">
                            </div>
                            <div class="row-start-2">
                                <label for="second_lastname">Segundo apellido</label>
                                <input type="text" name="segundo_apellido" id="second_lastname" maxlength="20"
                                    value="{{ old('segundo_apellido', Auth::user()->segundo_apellido) }}">
                            </div>
                        </form>
                    </section>
                    <footer>
                        <button class="btn-outline" onclick="this.closest('dialog').close()">Cancelar</button>
                        <button
                            class="rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer"
                            onclick="document.getElementById('edit-profile-form').submit()" type="submit"
                            form="edit-profile-form">
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
        </div>

        {{-- Tarjeta de información de cuenta --}}
        <div class="card w-100 mt-10">
            <header>
                <h2 class="text-2xl font-bold">Cuenta</h2>
            </header>
            <section>
                <div class="grid grid-cols-3 grid-rows-1 gap-4">
                    <div class="text-sm font-bold">Correo Electrónico:</div>
                    <div class="col-span-2 text-sm content-around">{{ Auth::user()->correo }}</div>
                </div>
            </section>
            <footer class="grid grid-cols-1 grid-rows-2 gap-4">
                <div>
                    <button
                        class="w-43 rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer"
                        type="button" onclick="document.getElementById('change-email').showModal()">
                        Cambiar Correo
                    </button>
                </div>
                <div>
                    <button
                        class="w-43 rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer"
                        type="button" onclick="document.getElementById('change-password').showModal()">
                        Cambiar Contraseña
                    </button>
                </div>
            </footer>

            {{-- Modal para cambiar correo --}}
            <dialog id="change-email" class="dialog w-full sm:max-w-[425px] max-h-[612px]" onclick="this.close()">
                <article onclick="event.stopPropagation()">
                    <header>
                        <h2>Cambiar Correo</h2>
                        <p>Ingresa el nuevo correo electrónico para tu cuenta.</p>
                    </header>
                    <section>
                        <form method="POST" id="change-email-form" class="form"
                            action="{{ route('change.email', Auth::user()->id_usuario) }}">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="new_email">Nuevo Correo</label>
                                <input type="email" name="nuevo_correo" id="new_email" placeholder="nuevo@correo.com">
                            </div>
                        </form>
                    </section>
                    <footer>
                        <button class="btn-outline" onclick="this.closest('dialog').close()">Cancelar</button>
                        <button
                            class="rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer"
                            onclick="document.getElementById('change-email-form').submit()" type="submit"
                            form="change-email-form">
                            Confirmar Cambios
                        </button>
                    </footer>
                    <form method="dialog">
                        <button aria-label="Close dialog">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </form>
                </article>
            </dialog>

            {{-- Modal para cambiar contraseña --}}
            <dialog id="change-password" class="dialog w-full sm:max-w-[425px] max-h-[612px]" onclick="this.close()">
                <article onclick="event.stopPropagation()">
                    <header>
                        <h2>Cambiar contraseña</h2>
                        <p>Ingresa la nueva contraseña para tu cuenta.</p>
                    </header>
                    <section>
                        <form method="POST" id="change-password-form" class="form"
                            action="{{ route('change.password', Auth::user()->id_usuario) }}">
                            @csrf
                            @method('PUT')
                            <div class="m-3">
                                <label for="new_password">Nueva Contraseña</label>
                                <input type="password" name="nueva_contraseña" id="new_password" placeholder="********">
                            </div>
                            <div class="m-3">
                                <label for="new_password_confirmation">Confirmar Contraseña</label>
                                <input type="password" name="nueva_contraseña_confirmation" id="new_password_confirmation" placeholder="********">
                            </div>
                        </form>
                    </section>
                    <footer>
                        <button class="btn-outline" onclick="this.closest('dialog').close()">Cancelar</button>
                        <button
                            class="rounded-sm py-1 px-3 bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer"
                            onclick="document.getElementById('change-password-form').submit()" type="submit"
                            form="change-password-form">
                            Confirmar Cambios
                        </button>
                    </footer>
                    <form method="dialog">
                        <button aria-label="Close dialog">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </form>
                </article>
            </dialog>
        </div>

        {{-- Muestra errores de validación si existen --}}
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
    </div>
</x-app-layout>
