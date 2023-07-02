<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendUserInviteEmail extends Mailable
{
    public $maildata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($maildata)
    {
         $this->maildata = $maildata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->markdown('emails.SendOTPEmail');
        return $this->markdown('emails.SendUserInvite')
                ->subject($this->maildata['subject'])
                ->with('maildata', $this->maildata);
    }
}
