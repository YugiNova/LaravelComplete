<?php

namespace App\Listeners;

use App\Mail\OrderEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
class SendEmailToCustomerWhenOrderSuccess
{
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
    public function handle(object $event): void
    {
        $order=$event->order;
        Mail::to('yuginovaniac@gmail.com')->send(new OrderEmail($order,'user'));
        Mail::to('yuginovaniac@gmail.com')->send(new OrderEmail($order,'admin'));
    }
}
