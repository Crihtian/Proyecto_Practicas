<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Notificación para enviar el código de verificación de dos factores
 * Se envía por email cuando:
 * 1. El usuario inicia sesión y 2FA está activado
 * 2. El usuario solicita reenviar el código
 */

class SendTwoFactorCode extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Código de verificación')
            ->line("Tu código de verificación es: {$notifiable->two_factor_code}")
            ->action('Verificar aquí', route('verify.index'))
            ->line('El código expirará en 10 minutos.')
            ->line('Si no has solicitado este código, por favor ignora este email.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
