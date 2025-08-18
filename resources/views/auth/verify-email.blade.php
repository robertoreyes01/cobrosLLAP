<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="bg-white py-8 px-6 shadow rounded-lg sm:px-10">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">
                        Verifica Tu Correo Electrónico
                    </h2>
                    <div class="w-16 h-1 bg-[#751711] mx-auto"></div>
                </div>

                <!-- Body Content -->
                <div class="text-center">
                    <div class="mb-6">
                        <svg class="mx-auto h-16 w-16 text-[#751711] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Antes de proceder, por favor comprueba tu correo electrónico para obtener un enlace de verificación..
                        </p>
                    </div>

                    <div class="mb-8">
                        <p class="text-gray-600">
                            Si no haz recibido el correo, 
                            <form method="POST" action="{{ route('verification.resend') }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="text-[#751711] hover:text-[#5c120e] font-semibold underline transition-colors duration-200 bg-transparent border-none p-0">
                                    clic aquí para solicitar otro.
                                </button>
                            </form>
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-4 rounded-lg transition-colors duration-200">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
