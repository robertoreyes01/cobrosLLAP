<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Sistema de Gestión de Pagos y Cobros LLAP</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/basecoat-css@0.2.8/dist/basecoat.cdn.min.css">
    <script src="{{ asset('js/basecoat/basecoat-css/dist/js/dropdown-menu.min.js') }}" defer></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .banner {
            background-color: #751711;
            width: 100%;
        }

        .banner-content {
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: repeat(1, 1fr);
            gap: 8px;
        }

        .menu-icon {
            grid-column: span 2 / span 2;
            display: flex;
            align-items: center;
            padding-left: 12px;
        }

        .menu-icon h3 {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: 600;
            padding-left: 20px;
        }

        .banner-content-logo img {
            grid-column-start: 3;
            display: block;
            margin: 0 auto;
            width: 60px;
            height: 60px;
        }

        .slogan {
            grid-column-start: 5;
            color: #ffffff;
            font-style: italic;
            text-align: center;
            display: flex;
        }
    </style>
</head>

<body>
    <header>
        <div class="banner">
            <div class="banner-content">
                <div class="menu-icon">
                    <div id="demo-dropdown-menu" class="dropdown-menu">
                        <button type="button" id="demo-dropdown-menu-trigger" aria-haspopup="menu"
                            aria-controls="demo-dropdown-menu-menu" aria-expanded="false" class="btn-outline "
                            style="background-color: #751711; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
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
                        <div id="demo-dropdown-menu-popover" data-popover aria-hidden="true" class="bg-[#751711] text-white rounded-lg flex flex-col gap-1 px-4">
                            <div role="menu" id="demo-dropdown-menu-menu"
                                aria-labelledby="demo-dropdown-menu-trigger">
                                <div role="group" aria-labelledby="account-options" class="flex flex-col gap-1">
                                    <div role="menuitem" class="">
                                        Menú Principal
                                        <span class="text-muted-foreground text-xs tracking-widest"></span>
                                    </div>
                                    <div role="menuitem">
                                        Perfil
                                        <span class="text-muted-foreground text-xs tracking-widest"></span>
                                    </div>
                                    <div role="menuitem">
                                        Ver Pagos
                                        <span class="text-muted-foreground text-xs tracking-widest"></span>
                                    </div>
                                </div>
                                <hr role="separator" />
                                <div role="menuitem">
                                    Cerrar Sesión
                                    <span class="text-muted-foreground text-xs tracking-widest"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <button class="btn btn-secondary" type="button" style="background-color: #751711; border: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
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
                    <button type="button" class="dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
                        aria-expanded="false" style="background-color: #751711; color:#ffffff;">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Menú Principal</a></li>
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Ver Pagos</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                    </ul> --}}

                    <h3>Gestión de Pagos</h3>
                </div>
                <div class="banner-content-logo">
                    <img src="{{ asset('img/logollap.png') }}" alt="logo">
                </div>
                <div class="slogan">
                    <p>Educando a los jóvenes con Amor y Disciplina</p>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        {{ $slot }}
    </div>
    <footer></footer>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"> --}}
    </script>
</body>

</html>
