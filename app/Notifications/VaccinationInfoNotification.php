<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VaccinationInfoNotification extends Notification
{
    use Queueable;

    private $vaccinationName;
    private $workDay;

    public function __construct($vaccinationName, $workDay)
    {
        $this->vaccinationName = $vaccinationName;
        $this->workDay = $workDay;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'vaccination_name' => $this->vaccinationName,
            'work_day_vaccination' => $this->workDay
        ];
    }
}
