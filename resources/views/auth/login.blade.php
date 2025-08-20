{{--
    Vista: Formulario de Login
    Ubicación: resources/views/auth/login.blade.php
    Descripción:
        Vista principal de autenticación que permite a los usuarios iniciar sesión
        en el sistema de gestión de pagos y cobros.
    Variables esperadas:
        - $errors: Illuminate\Support\ViewErrorBag | Errores de validación si existen
        - session('status'): string | Mensaje de estado (ej: confirmación de registro)
        - old('remember'): boolean | Estado del checkbox "recordarme"
    Funcionalidad:
        - Formulario de autenticación con correo y contraseña
        - Opción "recordarme" para mantener sesión activa
        - Validación de credenciales en el servidor
        - Redirección a recuperación de contraseña
        - Muestra mensajes de error y estado
    Componentes:
        - Formulario de login con campos de correo y contraseña
        - Iconos SVG para campos de entrada
        - Checkbox para opción "recordarme"
        - Botón de envío del formulario
        - Enlace para recuperación de contraseña
        - Sección de mensajes de estado y errores
    Características:
        - Interfaz centrada y responsiva
        - Validación visual con iconos descriptivos
        - Mensajes informativos para el usuario
        - Integración con sistema de autenticación de Laravel
        - Soporte para sesiones persistentes
    Rutas asociadas:
        - POST /login (login)
        - GET /olvidar-contrasena (password.request)
--}}
<x-login-layout>
    <div class="container" style="padding-top: 20px; width: 500px; align-items: center;">
        <div class="mb-4">
            <h2 style="text-align: center;">Bienvenido</h2>
            <h4 style="text-align: center;">Ingresa tus credenciales</h4>
        </div>
        <form class="form space-y-6 w-full" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <div class="relative">
                    <input class="input px-6 pl-10" type="email" name="correo" id="email" placeholder="nombre@ejemplo.com"
                        maxlength="50">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail">
                            <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="relative">
                    <input class="input px-6 pl-10" type="password" id="password" name="password" placeholder="********">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2" {{ old('remember') ? 'checked' : '' }}>
                    <span>Recordarme</span>
                </label>
            </div>
            <button
                class="w-full py-2 px-4 rounded bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200"
                type="submit">Iniciar sesión
            </button>
        </form>
        <button class="btn-link m-0 p-0" onclick="window.location.href='{{ route('password.request') }}'">¿Olvidaste tu contraseña?</button>

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