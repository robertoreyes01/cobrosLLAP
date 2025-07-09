<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Sistema de Gestión de Pagos y Cobros LLAP</title>

    <!-- Bootstrap y Basecoat para estilos adicionales -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/basecoat-css@0.2.8/dist/basecoat.cdn.min.css">
    <script src="https://cdn.jsdelivr.net/npm/basecoat-css@0.2.8/dist/js/all.min.js" defer></script>
    {!! ToastMagic::styles() !!}
</head>

<body class="m-0 p-0">
    <!--
        Layout principal para la página de login.
        Incluye un banner institucional, espacio para el contenido del formulario de login y pie de página.
    -->
    <header>
        <!-- Banner institucional con logo, título y subtítulo -->
        <div class="w-full bg-[#751711] py-2">
            <div class="flex flex-row-reverse pr-5">
                <div class="m-1">
                    <form action="{{ route('signInForm') }}">
                        <button
                            class="py-1 px-3 rounded outline-solid bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer">
                            Registrarse
                        </button>
                    </form>
                </div>
                <div class="m-1">
                    <form action="{{ route('loginForm') }}">
                        <button
                            class="py-1 px-3 rounded outline-solid bg-[#751711] hover:bg-[#5c120e] text-sm text-white font-semibold transition-colors duration-200 cursor-pointer">
                            Iniciar sesión
                        </button>
                    </form>
                </div>
            </div>
            <div class="max-w-[1200px] mx-auto px-4">
                <div class="flex flex-col items-center">
                    <!-- Logo del liceo -->
                    <div class="mb-2">
                        <img src="{{ asset('img/logollap.png') }}" alt="logo"
                            class="block mx-auto w-[100px] h-[100px]">
                    </div>
                    <!-- Título principal -->
                    <div class="mb-2">
                        <h1 class="text-white text-center mt-2 text-2xl font-bold">Liceo Profesor Luis Alfonso Pino</h1>
                    </div>
                    <!-- Subtítulo del sistema -->
                    <div>
                        <h3 class="text-white text-center mt-2 text-lg">Sistema de Gestión de Pagos y Cobros</h3>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Contenedor para el contenido dinámico del login (slot) -->
    <div class="container">
        {{ $slot }}
    </div>

    <footer>
    </footer>
    {!! ToastMagic::scripts() !!}
</body>
</html>