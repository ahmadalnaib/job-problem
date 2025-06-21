<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Expo\ExpoMessage;

class ExpoPushNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $body;

    public function __construct($title = 'Hello!', $body = 'This is a push notification from Laravel via Expo.')
    {
        $this->title = $title;
        $this->body = $body;
    }

    public function via($notifiable)
    {
        return ['expo'];
    }

    public function toExpo($notifiable)
    {
        return ExpoMessage::create()
            ->title($this->title)
            ->body($this->body);
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
        ];
    }
}