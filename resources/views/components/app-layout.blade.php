{{--
    Componente: Layout Principal de la Aplicación
    Ubicación: resources/views/components/app-layout.blade.php
    Descripción:
        Componente Blade que define el layout principal de la aplicación.
        Incluye el header con navegación, menú desplegable según el rol del usuario,
        logo institucional y el contenedor principal para el contenido.
    Funcionalidad:
        - Header con navegación y menú desplegable
        - Menú contextual según el rol del usuario autenticado:
            - Rol 1 (Administrador): Acceso completo a todas las funciones
            - Rol 2 (Secretario): Gestión de cobros y estudiantes
            - Rol 3 (Padre/Tutor): Visualización de pagos
        - Logo institucional centrado
        - Lema institucional
        - Integración con ToastMagic para notificaciones
        - Estilos CSS con Basecoat y Vite
    Dependencias:
        - ToastMagic para notificaciones
        - Basecoat CSS para estilos
        - Vite para compilación de assets
        - Autenticación de Laravel
    Variables esperadas:
        - $slot: Contenido principal de la vista
        - Auth::user(): Usuario autenticado con su rol
--}}
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" href="{{ asset('img/logollap.png') }}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Sistema de Gestión de Pagos y Cobros LLAP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/basecoat-css@0.2.8/dist/basecoat.cdn.min.css">
    <script src="{{ asset('js/basecoat/basecoat-css/dist/js/all.js') }}" defer></script>
    {!! ToastMagic::styles() !!}
</head>

<body class="m-0 p-0">
    <header>
        <div class="bg-[#751711] w-full">
            <div class="mx-auto px-5 grid grid-cols-5 grid-rows-1 gap-2">
                <div class="col-span-2 flex items-center pl-3">
                    <div id="demo-dropdown-menu" class="dropdown-menu">
                        <button type="button" id="demo-dropdown-menu-trigger" aria-haspopup="menu"
                            aria-controls="demo-dropdown-menu-menu" aria-expanded="false" class="btn-outline"
                            style="background-color: #751711; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-sliders-horizontal-icon lucide-sliders-horizontal">
                                <line x1="21" x2="14" y1="4" y2="4" />
                                <line x1="10" x2="3" y1="4" y2="4" />
                                <line x1="21" x2="12" y1="12" y2="12" />
                                <line x1="8" x2="3" y1="12" y2="12" />
                                <line x1="21" x2="16" y1="20" y2="20" />
                                <line x1="12" x2="3" y1="20" y2="20" />
                                <line x1="14" x2="14" y1="2" y2="6" />
                                <line x1="8" x2="8" y1="10" y2="14" />
                                <line x1="16" x2="16" y1="18" y2="22" />
                            </svg>
                        </button>
                        <div id="demo-dropdown-menu-popover" data-popover aria-hidden="true"
                            class="bg-[#751711] text-white">
                            <div role="menu" id="demo-dropdown-menu-menu"
                                aria-labelledby="demo-dropdown-menu-trigger">
                                <div role="group" aria-labelledby="account-options">
                                    <button class="btn-ghost" type="submit" role="menuitem"
                                        onclick="window.location.href='{{ route('main') }}'"
                                        class="text-muted-foreground-white ml-auto text-xs tracking-widest cursor-pointer">
                                        Menú Principal
                                    </button>
                                    <button class="btn-ghost" type="submit" role="menuitem"
                                        onclick="window.location.href='{{ route('profile.show') }}'"
                                        class="text-muted-foreground-white ml-auto text-xs tracking-widest cursor-pointer">
                                        Perfil
                                    </button>
                                    @if (Auth::user()->id_rol == 3)
                                        <button class="btn-ghost" type="submit" role="menuitem"
                                            onclick="window.location.href='{{ route('payments.student', $padre = Auth::user()->id_usuario) }}'"
                                            class="text-muted-foreground-white ml-auto text-xs tracking-widest cursor-pointer">
                                            Ver Pagos
                                        </button>
                                    @elseif (Auth::user()->id_rol == 2)
                                        <button class="btn-ghost" type="submit" role="menuitem"
                                            onclick="window.location.href='{{ route('charges.parents') }}'"
                                            class="text-muted-foreground-white ml-auto text-xs tracking-widest cursor-pointer">
                                            Gestionar Cobros
                                        </button>
                                        <button class="btn-ghost" type="submit" role="menuitem"
                                            onclick="window.location.href='{{ route('students.index') }}'"
                                            class="text-muted-foreground-white ml-auto text-xs tracking-widest cursor-pointer">
                                            Gestionar Estudiantes
                                        </button>
                                    @elseif (Auth::user()->id_rol == 1)
                                        <button class="btn-ghost" type="submit" role="menuitem"
                                            onclick="window.location.href='{{ route('charges.parents') }}'"
                                            class="text-muted-foreground-white ml-auto text-xs tracking-widest cursor-pointer">
                                            Gestionar Cobros
                                        </button>
                                        <button class="btn-ghost" type="submit" role="menuitem"
                                            onclick="window.location.href='{{ route('accounts.index') }}'"
                                            class="text-muted-foreground-white ml-auto text-xs tracking-widest cursor-pointer">
                                            Gestionar Cuentas
                                        </button>
                                        <button class="btn-ghost" type="submit" role="menuitem"
                                            onclick="window.location.href='{{ route('students.index') }}'"
                                            class="text-muted-foreground-white ml-auto text-xs tracking-widest cursor-pointer">
                                            Gestionar Estudiantes
                                        </button>
                                        <button class="btn-ghost" type="submit" role="menuitem"
                                            onclick="window.location.href='{{ route('prices.index') }}'"
                                            class="text-muted-foreground-white ml-auto text-xs tracking-widest cursor-pointer">
                                            Gestionar Precios
                                        </button>
                                    @endif
                                </div>
                                <hr role="separator" />
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn-ghost" type="submit" role="menuitem"
                                        class="text-muted-foreground-white ml-auto text-xs tracking-widest cursor-pointer">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if (Route::is('main'))
                        <h3 class="text-white text-2xl font-semibold pl-5">Menú Principal</h3>
                    @elseif (Route::is('profile.show'))
                        <h3 class="text-white text-2xl font-semibold pl-5">Perfil</h3>
                    @else
                        @if (Auth::user()->id_rol == 3)
                            <h3 class="text-white text-2xl font-semibold pl-5">Gestión de Pagos</h3>
                        @elseif (Auth::user()->id_rol == 2)
                            <h3 class="text-white text-2xl font-semibold pl-5">Gestión de Cobros</h3>
                        @elseif (Auth::user()->id_rol == 1)
                            <h3 class="text-white text-2xl font-semibold pl-5">Administración</h3>
                        @endif
                    @endif
                </div>
                <div class="col-start-3">
                    <img src="{{ asset('img/logollap.png') }}" alt="logo" class="block mx-auto w-15 h-15">
                </div>
                <div class="col-start-5 text-white italic text-center flex flex-col pt-1">
                    <p>Educando a los Jóvenes con</p>
                    <p>Amor y Disciplina</p>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        {{ $slot }}
    </div>
    <footer></footer>
    </script>
    {!! ToastMagic::scripts() !!}
</body>

</html>
