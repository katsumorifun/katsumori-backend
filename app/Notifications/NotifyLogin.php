<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyLogin extends Notification
{
    use Queueable;

    protected string $app_name;
    protected string $activity_url;
    protected string $client_ip;
    protected string $country;
    protected string $city;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        string $app_name,
        $activity_url,
        $client_ip,
        $country,
        $city
    )
    {
        $this->app_name = $app_name;
        $this->activity_url = $activity_url;
        $this->client_ip = $client_ip;
        $this->country = $country;
        $this->city = $city;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->app_name == 'site')
        {
            $this->app_name = __('notifications.login.site');
        }

        return (new MailMessage)
                    ->subject(__('notifications.login.subject'))
                    ->greeting(__('notifications.login.message', ['app_name' => $this->app_name]))
                    ->line(__('notifications.login.location', ['ip' => $this->client_ip, 'city' => $this->city, 'country'=> $this->country]))
                    ->action(__('notifications.login.actions.activity'), url($this->activity_url));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
