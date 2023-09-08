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
        $categoryByAnimal = $event->product->subcategoryAnimal->first()->categoryAnimal;
        $subscribers = $categoryByAnimal->subscribers;

        if (count($subscribers) > 0) {
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->send(new MailingSubscriptionsMail($categoryByAnimal, $event->product));
            }
        }
    }
}
