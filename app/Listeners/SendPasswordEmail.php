<?php

namespace App\Listeners;

use App\Events\AdminCreatedUser;
use App\Mail\PasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordEmail implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AdminCreatedUser $event): void
    {
        //
        Mail::to($event->email)->send(new PasswordMail($event->password));
    }
}
