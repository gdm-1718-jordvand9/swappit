<?php

namespace App\Notifications;

use App\Order;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Crypt;

class OrderCompletedMail extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user, $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
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
        $tickets = $this->order->tickets()->get();
        $message = new MailMessage();
        $message->greeting('Hello ' . $this->user->name . ',');
        $message->subject('Order confirmation Swappit');
        $message->line('Thanks for ordering with Swappit!');
        foreach ($tickets as $ticket)
        {
            $message->line($ticket->ticket_type->festival->name . '-' . $ticket->ticket_type->name . ' for €' .$ticket->price);
            $message->line('Key: ' . Crypt::decryptString($ticket->code));
        }
        return $message;


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
