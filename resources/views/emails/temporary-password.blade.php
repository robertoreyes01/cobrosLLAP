<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tu contraseña temporal - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #374151;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 448px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #2563eb;
            color: #ffffff;
            padding: 16px 24px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }
        .content {
            padding: 24px;
        }
        .credentials {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
        }
        .credentials h3 {
            margin: 0 0 8px 0;
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }
        .credentials p {
            margin: 8px 0;
        }
        .credentials .label {
            font-weight: 500;
            color: #374151;
        }
        .credentials .email {
            color: #2563eb;
        }
        .credentials .password {
            color: #dc2626;
            font-family: monospace;
        }
        .warning {
            background-color: #fef3c7;
            border: 1px solid #fde68a;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
        }
        .warning h4 {
            margin: 0 0 8px 0;
            color: #92400e;
            font-weight: 600;
        }
        .warning p {
            margin: 0;
            color: #a16207;
            font-size: 14px;
        }
        .steps h3 {
            margin: 0 0 12px 0;
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }
        .steps ol {
            margin: 0 0 16px 0;
            padding-left: 20px;
            color: #374151;
        }
        .steps li {
            margin-bottom: 8px;
        }
        .button-container {
            text-align: center;
            margin-bottom: 16px;
        }
        .button {
            display: inline-block;
            background-color: #2563eb;
            color: #ffffff !important;
            font-weight: bold;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .button:hover {
            background-color: #1d4ed8;
        }
        .support h3 {
            margin: 0 0 8px 0;
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }
        .support p {
            margin: 0 0 16px 0;
            color: #374151;
        }
        .signature {
            color: #374151;
        }
        .signature strong {
            color: #2563eb;
        }
        .footer {
            background-color: #f9fafb;
            padding: 12px 24px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            margin: 0;
            font-size: 12px;
            color: #6b7280;
        }
        .footer .url {
            color: #2563eb;
            word-break: break-all;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Bienvenido al Sistema de Cobros LLAP</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p style="margin-bottom: 16px;">Hola <strong>{{ $user->primer_nombre }} {{ $user->primer_apellido }}</strong>,</p>

            <p style="margin-bottom: 16px;">Tu cuenta ha sido creada exitosamente en el Sistema de Cobros LLAP. A continuación encontrarás tus credenciales de acceso:</p>

            <!-- Credentials -->
            <div class="credentials">
                <h3>Credenciales de Acceso</h3>
                <p><span class="label">Email:</span> <span class="email">{{ $user->correo }}</span></p>
                <p><span class="label">Contraseña temporal:</span> <span class="password">{{ $temporaryPassword }}</span></p>
            </div>

            <!-- Warning -->
            <div class="warning">
                <h4>⚠️ Importante</h4>
                <p>Por seguridad, te recomendamos cambiar tu contraseña temporal inmediatamente después de iniciar sesión por primera vez.</p>
            </div>

            <!-- Next Steps -->
            <div class="steps">
                <h3>Próximos Pasos</h3>
                <ol>
                    <li><strong>Inicia sesión</strong> en el sistema usando las credenciales proporcionadas</li>
                    <li><strong>Cambia tu contraseña</strong> en la sección de configuración de perfil</li>
                    <li><strong>Explora las funcionalidades</strong> disponibles según tu rol</li>
                </ol>
            </div>

            <!-- Button -->
            <div class="button-container">
                <a href="{{ config('app.url') }}" class="button">Acceder al Sistema</a>
            </div>

            <!-- Support -->
            <div class="support">
                <h3>Soporte</h3>
                <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactar al administrador del sistema.</p>
            </div>

            <p class="signature">
                Saludos,<br>
                <strong>{{ config('app.name') }}</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                Si tienes problemas para hacer clic en el botón "Acceder al Sistema", copia y pega esta URL en tu navegador:<br>
                <span class="url">{{ config('app.url') }}</span>
            </p>
        </div>
    </div>
</body>
</html>
