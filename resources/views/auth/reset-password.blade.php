{{--
    Vista: Restablecimiento de Contraseña
    Ubicación: resources/views/auth/reset-password.blade.php
    Descripción:
        Vista que permite a los usuarios establecer una nueva contraseña después de
        haber solicitado la recuperación de su cuenta mediante el enlace enviado por email.
    Variables esperadas:
        - $token: string | Token de restablecimiento recibido por email
        - $errors: Illuminate\Support\ViewErrorBag | Errores de validación si existen
        - session('status'): string | Mensaje de éxito si la contraseña fue actualizada
    Funcionalidad:
        - Formulario para ingresar nueva contraseña y confirmación
        - Validación de contraseña con requisitos específicos
        - Verificación del token de restablecimiento
        - Actualización de contraseña en la base de datos
        - Muestra mensajes de éxito y error
    Componentes:
        - Campo de correo electrónico (pre-llenado)
        - Campo de nueva contraseña con validación
        - Campo de confirmación de contraseña
        - Token oculto para verificación
        - Instrucciones de requisitos de contraseña
        - Botón de restablecimiento
        - Sección de mensajes de estado y errores
    Características:
        - Validación de contraseña robusta (mínimo 8 caracteres, mayúsculas, minúsculas, números)
        - Prevención de espacios y emojis en contraseñas
        - Interfaz limpia y centrada
        - Iconos descriptivos para campos
        - Mensajes informativos para el usuario
    Ruta asociada:
        - POST /restablecer-contrasena (password.update)
--}}
<x-login-layout>
    <div class="place-items-center">
        <div class="card w-3/4 max-w-md my-4">
            <header>
                <h2 class="text-2xl font-bold">Restablecer contraseña</h2>
            </header>
            <section>
                <form class="grid gap-1" method="POST" action="{{ route('password.update') }}" id="reset-password-form">
                    @csrf
                    <div>
                        <label for="email" class="text-sm font-bold">Correo electrónico</label>
                    </div>
                    <div class="relative">
                        <input type="email" class="input pl-10" name="correo" id="email"
                            placeholder="nombre@ejemplo.com" maxlength="43">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail">
                                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <label for="password" class="text-sm font-bold">Nueva contraseña</label>
                    </div>
                    <div class="relative">
                        <input type="password" class="input pl-10" name="password" id="password"
                            placeholder="********" maxlength="43">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres, incluye mayúsculas, minúsculas y números,
                        no debe contener espacios o emojis.</p>
                    <div>
                        <label for="password_confirmation" class="text-sm font-bold">Confirmar contraseña</label>
                    </div>
                    <div class="relative">
                        <input type="password" class="input pl-10" name="password_confirmation"
                            id="password_confirmation" placeholder="********" maxlength="43">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </span>
                    </div>
                    <input type="hidden" name="token" value="{{ $token }}">
                </form>
            </section>
            <footer>
                <button type="submit" form="reset-password-form" onclick="document.getElementById('reset-password-form').submit()"
                    class="py-2 px-4 rounded bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200">
                    Restablecer contraseña
                </button>
            </footer>
        </div>

        @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-md">
                <p class="text-sm text-green-600">{{ session('status') }}</p>
            </div>
        @endif

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
</x-login-layout>
