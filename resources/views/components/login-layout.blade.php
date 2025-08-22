{{--
    Componente: Layout de Página de Login
    Ubicación: resources/views/components/login-layout.blade.php
    Descripción:
        Componente Blade que define el layout específico para las páginas de autenticación.
        Incluye el header institucional con logo, título, botones de navegación y contenedor
        para el formulario de login o registro.
    Funcionalidad:
        - Header institucional con logo y branding
        - Botones de navegación entre login y registro
        - Banner con información institucional
        - Contenedor principal para formularios de autenticación
        - Integración con ToastMagic para notificaciones
        - Estilos CSS con Bootstrap, Basecoat y Vite
    Dependencias:
        - ToastMagic para notificaciones
        - Bootstrap CSS para estilos adicionales
        - Basecoat CSS para estilos base
        - Vite para compilación de assets
    Variables esperadas:
        - $slot: Contenido del formulario de login o registro
    Rutas utilizadas:
        - route('signInForm'): Para el formulario de registro
        - route('loginForm'): Para el formulario de login
--}}
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" href="{{ asset('img/logollap.png') }}" type="image/x-icon">
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
