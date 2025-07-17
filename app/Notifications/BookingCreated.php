<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingCreated extends Notification
{
   use Illuminate\Notifications\Messages\MailMessage;

public function __construct(public Booking $booking) {}

public function via($notifiable)
{
    return ['mail'];
}

public function toMail($notifiable)
{
    return (new MailMessage)
        ->greeting('Hello ' . $notifiable->name)
        ->line('Your booking has been created!')
        ->line('Title: ' . $this->booking->title)
        ->line('Date: ' . $this->booking->booking_date->toDayDateTimeString());
}

}
