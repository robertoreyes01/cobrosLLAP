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
                    <input class="input px-6 pl-10" type="password" id="password" name="contrasena" placeholder="********">
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
            <button
                class="w-full py-2 px-4 rounded bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200"
                type="submit">Iniciar sesión</button>

            <div class="mb-3 grid grid-cols-2 grid-rows-1 gap-4">
                <div class="items-center space-x-2">
                    <label class="label gap-3">
                        <input type="checkbox" class="input">
                        Recordarme
                    </label>
                </div>
                <div class="flex justify-end items-center space-x-2">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </form>
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