<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $user;
    private $message;
    private $link;
    public function __construct($user, $order)
    {
        //
        $this->user = $user;
        $this->message = 'Đơn hàng <span style="font-weight: bold">'.$order->code.'</span> đã được lập bởi <span style="font-weight: bold">'.$user->name.'</span>. Vui lòng xác nhận';
        $this->link = url('/orders');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Thông báo đơn hàng')
                    ->line($this->message)
                    ->action('Xác nhận đơn hàng', $this->link)
                    ->line('Xin trân trọng cảm ơn');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase(object $notifiable): array {
        return [
            'message' => $this->message,
            'link'    => $this->link
        ];
    }
}
