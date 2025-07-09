<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Sistema de Gestión de Pagos y Cobros LLAP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/basecoat-css@0.2.8/dist/basecoat.cdn.min.css">
    <script src="{{ asset('js/basecoat/basecoat-css/dist/js/all.js') }}" defer></script>
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
                                    <form action="{{ route('main') }}" method="GET">
                                        <button class="btn-ghost" type="submit" role="menuitem"
                                            class="text-muted-foreground-white ml-auto text-xs tracking-widest">
                                            Menú Principal
                                        </button>
                                    </form>
                                    <form action="{{ route('profile.show') }}" method="GET">
                                        <button class="btn-ghost" type="submit" role="menuitem"
                                            class="text-muted-foreground-white ml-auto text-xs tracking-widest">
                                            Perfil
                                        </button>
                                    </form>
                                    @if (Auth::user()->id_rol == 3)
                                        <div role="menuitem">
                                            Ver Pagos
                                            <span class="text-muted-foreground text-xs tracking-widest"></span>
                                        </div>
                                    @elseif (Auth::user()->id_rol == 2)
                                        <div role="menuitem">
                                            Gestionar Cobros
                                            <span class="text-muted-foreground text-xs tracking-widest"></span>
                                        </div>
                                    @elseif (Auth::user()->id_rol == 1)
                                        <div role="menuitem">
                                            Gestionar Cobros
                                            <span class="text-muted-foreground text-xs tracking-widest"></span>
                                        </div>
                                        <div role="menuitem">
                                            Gestionar Cuentas
                                            <span class="text-muted-foreground text-xs tracking-widest"></span>
                                        </div>
                                        <div role="menuitem">
                                            Gestionar Alumnos
                                            <span class="text-muted-foreground text-xs tracking-widest"></span>
                                        </div>
                                        <div role="menuitem">
                                            Gestionar Precios
                                            <span class="text-muted-foreground text-xs tracking-widest"></span>
                                        </div>
                                    @endif
                                </div>
                                <hr role="separator" />
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn-ghost" type="submit" role="menuitem"
                                            class="text-muted-foreground-white ml-auto text-xs tracking-widest">
                                            Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-white text-2xl font-semibold pl-5">Menú Principal</h3>
                </div>
                <div class="col-start-3">
                    <img src="{{ asset('img/logollap.png') }}" alt="logo" class="block mx-auto w-15 h-15">
                </div>
                <div class="col-start-5 text-white italic text-center flex flex-col">
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
</body>

</html>
