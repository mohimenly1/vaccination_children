<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InfoVaccination extends Notification
{
    use Queueable;

   private $vaccination_name_info;
   private $benefit_vaccination_info;
   private $complications_vaccination_info;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vaccination_name_info,$benefit_vaccination_info,$complications_vaccination_info)
    {
        $this->vaccination_name_info = $vaccination_name_info;
        $this->benefit_vaccination_info = $benefit_vaccination_info;
        $this->complications_vaccination_info = $complications_vaccination_info;
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
            'vaccination_name_info' =>$this->vaccination_name_info,
            'benefit_vaccination_info' =>$this->benefit_vaccination_info,
            'complications_vaccination_info' =>$this->complications_vaccination_info
        ];
    }
}
