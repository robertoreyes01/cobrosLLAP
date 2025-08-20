<x-login-layout>
    <div class="place-items-center">
        <div class="card w-3/4 max-w-md my-4">
            <header>
                <h2 class="text-2xl font-bold">Recuperar contraseña</h2>
            </header>
            <section>
                <form class="grid gap-1" method="POST" id="forgot-password-form">
                    @csrf
                    <div>
                        <label for="email" class="text-sm font-bold">Correo electrónico</label>
                    </div>
                    <div class="relative">
                        <input type="email" class="input pl-10" name="correo" id="email" placeholder="nombre@ejemplo.com" maxlength="43">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail">
                                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                            </svg>
                        </span>
                    </div>
                </form>
            </section>
            <footer>
                <button type="submit" form="forgot-password-form" onclick="document.getElementById('forgot-password-form').submit()"
                    class="py-2 px-4 rounded bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200">
                    Enviar
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