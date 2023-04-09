<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdsVaccination extends Notification
{
    use Queueable;

    private $avaliable_vaccination;
    private $health_center;
    private $vaccination_count;
    public function __construct($avaliable_vaccination, $health_center,$vaccination_count)
    {
        $this->avaliable_vaccination = $avaliable_vaccination;
        $this->health_center = $health_center;
        $this->vaccination_count = $vaccination_count;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'health_center' => $this->health_center,
            'avaliable_vaccination' => $this->avaliable_vaccination,
            'vaccination_count' => $this->vaccination_count
        ];
    }
}
