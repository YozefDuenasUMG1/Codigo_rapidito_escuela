<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CredencialesUsuario extends Notification implements ShouldQueue
{
    use Queueable;

    public $email;
    public $password;
    public $role;

    /**
     * Create a new notification instance.
     */
    public function __construct($email, $password, $role)
    {
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
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
            ->subject('Tus credenciales de acceso')
            ->greeting('¡Bienvenido/a a la plataforma!')
            ->line('Se ha creado una cuenta para ti con el siguiente rol: **' . ucfirst($this->role) . '**')
            ->line('Puedes iniciar sesión con:')
            ->line('**Usuario:** ' . $this->email)
            ->line('**Contraseña:** ' . $this->password)
            ->action('Iniciar sesión', url('/login'))
            ->line('Por seguridad, cambia tu contraseña después de iniciar sesión.');
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
