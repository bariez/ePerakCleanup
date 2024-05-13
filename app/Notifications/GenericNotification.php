<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class GenericNotification extends Notification
{
    use Queueable;

    public $title;

    public $body;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $body, $url)
    {
        //
        $this->title = $title;
        $this->body = $body;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        $time = \Carbon\Carbon::now();

        return (new WebPushMessage)
            ->title('MyTax LHDNM')
            ->icon(url('/logo3.jpg'))
            ->body($this->body)
            ->action('Baca', 'https://mytax.hasil.gov.my')
            ->data(['url' => $this->url]);
    }
}
