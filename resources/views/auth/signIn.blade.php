{{--
    resources/views/auth/signIn.blade.php
    Vista para el registro de nuevos usuarios.
    Muestra un formulario para crear una nueva cuenta, solicitando datos personales y credenciales.
    Utiliza el layout <x-login-layout> para mantener la coherencia visual.
--}}

<x-login-layout>
    <div class="container mx-auto pt-5 w-50">
        {{-- Título y descripción --}}
        <h1 class="text-2xl font-bold text-center mb-2">Crear Nueva Cuenta</h1>
        <p class="text-center text-gray-500 mb-6">Campos obligatorios <span class="text-red-600">*</span></p>
        {{-- Formulario de registro de usuario --}}
        <form class="space-y-6 w-full pb-8" method="POST" action="{{ route('signIn') }}">
            @csrf
            {{-- Nombres --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex flex-col">
                    <label for="first_name" class="mb-1 font-medium">Primer Nombre<span
                            class="text-red-600">*</span></label>
                    <input class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        type="text" name="primer_nombre" id="first_name" maxlength="20">
                </div>
                <div class="flex flex-col">
                    <label for="second_name" class="mb-1 font-medium">Segundo Nombre<span
                            class="text-red-600">*</span></label>
                    <input class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        type="text" name="segundo_nombre" id="second_name" maxlength="20">
                </div>
            </div>
            {{-- Apellidos --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex flex-col">
                    <label for="first_lastname" class="mb-1 font-medium">Primer Apellido<span
                            class="text-red-600">*</span></label>
                    <input class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        type="text" name="primer_apellido" id="first_lastname" maxlength="20">
                </div>
                <div class="flex flex-col">
                    <label for="second_lastname" class="mb-1 font-medium">Segundo Apellido<span
                            class="text-red-600">*</span></label>
                    <input class="border rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        type="text" name="segundo_apellido" id="second_lastname" maxlength="20">
                </div>
            </div>
            {{-- Correo electrónico --}}
            <div class="mb-4">
                <label for="email" class="mb-1 font-medium">Correo Electrónico<span
                        class="text-red-600">*</span></label>
                <div class="relative">
                    <input
                        class="border rounded w-full pl-10 pr-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        type="email" name="correo" id="email" placeholder="nombre@ejemplo.com" maxlength="50">
                    {{-- Icono de correo --}}
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail">
                            <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                        </svg>
                    </span>
                </div>
            </div>
            {{-- Contraseña --}}
            <div>
                <label for="password" class="mb-1 font-medium">Contraseña<span class="text-red-600">*</span></label>
                <div class="relative">
                    <input
                        class="border rounded w-full pl-10 pr-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        type="password" name="contrasena" id="password" placeholder="********" maxlength="25">
                    {{-- Icono de candado --}}
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                    </span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres, incluye mayúsculas, minúsculas y números, no
                    debe contener espacios o emojis.</p>
            </div>
            {{-- Confirmación de contraseña --}}
            <div class="mb-4">
                <label for="password_confirmation" class="mb-1 font-medium">Confirmar Contraseña<span
                        class="text-red-600">*</span></label>
                <div class="relative">
                    <input
                        class="border rounded w-full pl-10 pr-2 py-1 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        type="password" name="contrasena_confirmation" id="password_confirmation"
                        placeholder="********" maxlength="25">
                    {{-- Icono de candado --}}
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                    </span>
                </div>
            </div>
            {{-- Botón de envío --}}
            <button
                class="w-full py-2 px-4 rounded bg-[#751711] text-white hover:bg-[#5c120e] font-semibold transition-colors duration-200"
                type="submit">Crear Cuenta</button>
        </form>
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
</x-login-layout>