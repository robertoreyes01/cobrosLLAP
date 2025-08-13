{{--
    resources/views/main.blade.php
    Vista principal del sistema. Muestra accesos rápidos a las funcionalidades según el rol del usuario autenticado.
    Incluye tarjetas de acceso para padres/tutores, empleados y administradores.
--}}

<x-app-layout>
    <div class="place-items-center">

        {{-- Acceso para padres/tutores --}}
        @if (Auth::user()?->id_rol == 3)
            <div class="card w-72 mt-20">
                <header class="flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="82px" height="82px" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-receipt-icon lucide-receipt">
                        <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                        <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                        <path d="M12 17.5v-11" />
                    </svg>
                    <h2>Ver Pagos</h2>
                    <p class="text-sm text-center">Mira todos tus pagos realizados por alumno/s</p>
                </header>
                <section class="flex justify-center">
                    <button
                        onclick="window.location.href='{{ route('payments.student', $padre = Auth::user()->id_usuario) }}'"
                        class="rounded-sm p-1.75 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                        Acceder
                    </button>
                </section>
            </div>

            {{-- Acceso para empleados --}}
        @elseif (Auth::user()?->id_rol == 2)
            <div class="grid grid-cols-2 grid-rows-2 gap-25">
                <div class="card w-72 mt-30">
                    <header class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="82px" height="82px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-hand-coins-icon lucide-hand-coins">
                            <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                            <path
                                d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                            <path d="m2 16 6 6" />
                            <circle cx="16" cy="9" r="2.9" />
                            <circle cx="6" cy="5" r="3" />
                        </svg>
                        <h2>Gestionar Cobros</h2>
                        <p class="text-sm text-center">Gestiona los cobros por padres/tutores o alumnos</p>
                    </header>
                    <section class="flex justify-center">
                        <button onclick="window.location.href='{{ route('charges.parents') }}'"
                            class="rounded-sm p-1.75 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                            Acceder
                        </button>
                    </section>
                </div>
                <div class="card w-72 mt-30">
                    <header class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="82px" height="82px" viewBox="0 0 24 24"
                            fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-graduation-cap-icon lucide-graduation-cap">
                            <path
                                d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z" />
                            <path d="M22 10v6" />
                            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5" />
                        </svg>
                        <h2>Gestionar Estudiantes</h2>
                        <p class="text-sm text-center">Gestiona los estudiantes inscritos o agrega nuevos</p>
                    </header>
                    <section class="flex justify-center">
                        <button onclick="window.location.href='{{ route('students.index') }}'"
                            class="rounded-sm p-1.75 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                            Acceder
                        </button>
                    </section>
                </div>
            </div>

            {{-- Acceso para administradores --}}
        @elseif (Auth::user()?->id_rol == 1)
            <div class="grid grid-cols-2 grid-rows-2 gap-16">
                <div class="card w-72 m-5">
                    <header class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="82px" height="82px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-hand-coins-icon lucide-hand-coins">
                            <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                            <path
                                d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                            <path d="m2 16 6 6" />
                            <circle cx="16" cy="9" r="2.9" />
                            <circle cx="6" cy="5" r="3" />
                        </svg>
                        <h2>Gestionar Cobros</h2>
                        <p class="text-sm text-center">Gestiona los cobros por padres/tutores o alumnos</p>
                    </header>
                    <section class="flex justify-center">
                        <button
                            class="rounded-sm p-1.75 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md"
                            onclick="window.location.href='{{ route('charges.parents') }}'">
                            Acceder
                        </button>
                    </section>
                </div>
                <div class="card w-72 m-5">
                    <header class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="82px" height="82px" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-users-round-icon lucide-users-round">
                            <path d="M18 21a8 8 0 0 0-16 0" />
                            <circle cx="10" cy="8" r="5" />
                            <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                        </svg>
                        <h2>Gestionar Cuentas</h2>
                        <p class="text-sm text-center">Gestiona las cuentas de los padres/tutores o empleados</p>
                    </header>
                    <section class="flex justify-center">
                        <button onclick="window.location.href='{{ route('accounts.index') }}'"
                            class="rounded-sm p-1.75 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                            Acceder
                        </button>
                    </section>
                </div>
                <div class="row-start-2 card w-72 m-5">
                    <header class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="82px" height="82px" viewBox="0 0 24 24"
                            fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-graduation-cap-icon lucide-graduation-cap">
                            <path
                                d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z" />
                            <path d="M22 10v6" />
                            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5" />
                        </svg>
                        <h2>Gestionar Estudiantes</h2>
                        <p class="text-sm text-center">Gestiona los estudiantes inscritos o agrega nuevos</p>
                    </header>
                    <section class="flex justify-center">
                        <button onclick="window.location.href='{{ route('students.index') }}'"
                            class="rounded-sm p-1.75 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                            Acceder
                        </button>
                    </section>
                </div>
                <div class=" card w-72 m-5">
                    <header class="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" height="82px" viewBox="0 -960 960 960"
                            width="82px" fill="#000000">
                            <path
                                d="M450-201h60v-40h60q12.75 0 21.38-8.63Q600-258.25 600-271v-130q0-12.75-8.62-21.38Q582.75-431 570-431H420v-70h180v-60h-90v-40h-60v40h-60q-12.75 0-21.37 8.62Q360-543.75 360-531v130q0 12.75 8.63 21.37Q377.25-371 390-371h150v70H360v60h90v40ZM220-80q-24 0-42-18t-18-42v-680q0-24 18-42t42-18h361l219 219v521q0 24-18 42t-42 18H220Zm311-581v-159H220v680h520v-521H531ZM220-820v159-159 680-680Z" />
                        </svg>
                        <h2>Gestionar Precios</h2>
                        <p class="text-sm text-center">Mira y gestiona los precios de matricula y mensualidad</p>
                    </header>
                    <section class="flex justify-center">
                        <button onclick="window.location.href='{{ route('prices.index') }}'"
                            class="rounded-sm p-1.75 bg-[#751711] hover:bg-[#5c120e] text-white font-semibold transition-colors duration-200 cursor-pointer shadow-md">
                            Acceder
                        </button>
                    </section>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
