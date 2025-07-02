<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Sistema de Gestión de Pagos y Cobros LLAP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/basecoat-css@0.2.8/dist/basecoat.cdn.min.css">
    <script src="https://cdn.jsdelivr.net/npm/basecoat-css@0.2.8/dist/js/all.min.js" defer></script>
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
            padding: 20px 0;
        }

        .banner-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .banner-content-logo img {
            display: block;
            margin: 0 auto;
            width: 100px;
            height: 100px;
        }

        .banner-content-title h1 {
            color: #fff;
            text-align: center;
            margin-top: 10px;
        }

        .banner-content-subtitle h3 {
            color: #fff;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <header>
        <div class="banner">
            <div class="banner-content">
                <div class="banner-content-logo">
                    <img src="{{ asset('img/logollap.png') }}" alt="logo">
                </div>
                <div class="banner-content-title">
                    <h1>Liceo Profesor Luis Alfonso Pino</h1>
                </div>
                <div class="banner-content-subtitle">
                    <h3>Sistema de Gestión de Pagos y Cobros</h3>
                </div>
            </div>
        </div>
    </header>
    <div class="login-wrapper">
        {{-- @yield('content') --}}
        {{ $slot }}
    </div>

    <footer>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>

</html>
