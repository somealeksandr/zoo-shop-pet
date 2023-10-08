<?php

namespace App\Mail;

use App\Models\Animal;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailingSubscriptionsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Акційні товари';

    /**
     * Create a new message instance.
     */
    public function __construct(private Animal $category, private Product $product)
    {
        //
    }

    public function build(): MailingSubscriptionsMail
    {
        return $this->view('mail.mailing_subscriptions')->with([
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
