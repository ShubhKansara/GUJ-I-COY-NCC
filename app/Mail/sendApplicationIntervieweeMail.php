<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendApplicationIntervieweeMail extends Mailable
{
    /* used as a Mail::to($data["email"])->send(new sendApplicationIntervieweeMail($data)); */
    use Queueable, SerializesModels;
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
        $email = $this->markdown('emails.sendInterviweeReport')
                ->subject($this->maildata['subject'])
                ->with('maildata', $this->maildata);

        if(isset($this->maildata['attechment_path']) && !empty($this->maildata['attechment_path'])){
            $email->attach($this->maildata['attechment_path'], [
                         'as' => 'Applicant Report.pdf',
                         'mime' => 'application/pdf',
                    ]);
            //->attach($this->maildata['attechment_url']);
        }
        return $email;
    }
}
