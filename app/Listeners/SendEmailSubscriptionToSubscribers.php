<?php

namespace App\Listeners;

use App\Events\MailingSubscriptions;
use App\Mail\MailingSubscriptionsMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailSubscriptionToSubscribers implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(MailingSubscriptions $event): void
    {
        $animal = $event->product->category?->first()->animal ?? null;
        $subscribers = $animal?->subscribers ?? 0;

        if (count($subscribers) > 0) {
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->send(new MailingSubscriptionsMail($animal, $event->product));
            }
        }
    }
}
