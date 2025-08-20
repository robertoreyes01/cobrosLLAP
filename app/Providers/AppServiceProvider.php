<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

/**
 * Class AppServiceProvider
 * 
 * Proveedor de servicios principal de la aplicación.
 * Configura servicios globales, personaliza notificaciones de verificación de email
 * y maneja la configuración de URLs para el sistema de autenticación.
 * Extiende de ServiceProvider para integrarse con el contenedor de servicios de Laravel.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra servicios de la aplicación.
     * Se ejecuta durante el proceso de bootstrap de la aplicación.
     * 
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Inicializa servicios de la aplicación.
     * Configura URLs, personaliza notificaciones de verificación de email
     * y establece configuraciones globales del sistema.
     * 
     * @return void
     */
    public function boot(): void
    {
        // Force URL root & scheme to match APP_URL (handles subdirectories / scheme)
        $appUrl = config('app.url');
        if (!empty($appUrl)) {
            URL::forceRootUrl($appUrl);
            $parts = parse_url($appUrl);
            if (!empty($parts['scheme'])) {
                URL::forceScheme($parts['scheme']);
            }
        }

        /**
         * Personaliza la URL de verificación de email.
         * Crea una URL temporal firmada con expiración de 60 minutos.
         */
        VerifyEmail::createUrlUsing(function ($notifiable) {
            return URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60),
                [
                    'id' => $notifiable->getAuthIdentifier(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
        });

        /**
         * Personaliza el contenido del email de verificación.
         * Traduce los mensajes al español y adapta el contenido para el sistema educativo.
         */
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verificar correo electrónico')
                ->line('Haga clic en el botón a continuación para verificar su correo electrónico.')
                ->action('Verificar correo electrónico', $url)
                ->line('Si no creó una cuenta, no se requiere ninguna otra acción.');
        });
    }
}