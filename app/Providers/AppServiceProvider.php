<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
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

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verificar correo electrónico')
                ->line('Haga clic en el botón a continuación para verificar su correo electrónico.')
                ->action('Verificar correo electrónico', $url)
                ->line('Si no creó una cuenta, no se requiere ninguna otra acción.');
        });
    }
}
