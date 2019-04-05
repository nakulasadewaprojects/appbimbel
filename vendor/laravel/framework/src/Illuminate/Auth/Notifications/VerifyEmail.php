<?php

namespace Illuminate\Auth\Notifications;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Aktivasimentor; //menggunakan tabel aktivasi mentor

class VerifyEmail extends Notification
{
    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        Aktivasimentor::where('idaktivasimentor', $notifiable->getKey())->update(['codeAktivasi' => substr( $this->verificationUrl($notifiable), 47) ]); 
        Aktivasimentor::where('idaktivasimentor', $notifiable->getKey())->update(['statusLimit' => '3']); 
        Aktivasimentor::where('idaktivasimentor', $notifiable->getKey())->update(['limitAktivasi' =>Carbon::now()->addMinutes(2880)]); 

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject(Lang::getFromJson('Verifikasi Alamat Email'))
            ->line(Lang::getFromJson('Silakan klik tombol di bawah untuk memverifikasi alamat email Anda.'))
            ->action(
                Lang::getFromJson('Verifikasi Alamat Email'),
                $this->verificationUrl($notifiable)
            )
            ->line(Lang::getFromJson('Jika Anda tidak membuat akun, tidak ada tindakan lebih lanjut yang diperlukan.'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 2880)),
            ['idmentor' => $notifiable->getKey()]
        );
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
