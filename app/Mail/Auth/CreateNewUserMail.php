<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateNewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Your verification code';

    private string $confirmation_code;

    /**
     * Create a new message instance.
     */
    public function __construct(string $confirmation_code)
    {
        $this->confirmation_code = $confirmation_code;
    }

    public function build()
    {
        return $this->view('mail.create_new_user_mail')->with([
            'confirmation_code' => $this->confirmation_code,
        ]);
    }
}
