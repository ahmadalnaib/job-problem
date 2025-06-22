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
    protected $companyName;
    protected $scheduledAt;

    public function __construct(
        $title = 'Interview Reminder',  
        $body = 'You have an upcoming interview.',
         $companyName = null,
         $scheduledAt = null)
    {
        $this->title = $title;
        $this->body = $body;
       $this->companyName = $companyName;
        $this->scheduledAt = $scheduledAt;
    }

    public function via($notifiable)
    {
        return ['expo'];
    }

    public function toExpo($notifiable)
    {
         if ($this->companyName && $this->scheduledAt) {
            $message = "Reminder: Your interview at {$this->companyName} is scheduled for {$this->scheduledAt}.";
        } elseif ($this->companyName) {
            $message = "Reminder: Your interview at {$this->companyName} is scheduled for today.";
        } else {
            $message = $this->body;
        }
        return ExpoMessage::create()
            ->title($this->title)
            ->body($message);

    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
               'company' => $this->companyName,
                'scheduled_at' => $this->scheduledAt,
        
        ];
    }
}