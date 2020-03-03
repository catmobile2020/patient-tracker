<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rand_token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rand_token)
    {
        $this->rand_token =$rand_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.reset-password');
    }
}
