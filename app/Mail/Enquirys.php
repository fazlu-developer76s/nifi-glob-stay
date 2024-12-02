<?php

// app/Mail/OtpMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Enquirys extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    /**
     * Create a new message instance.
     *
     * @param string $otp
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.enquiry') // specify the view for the email
            ->subject('GlobStay Enquiry') // set the email subject
            ->with('req', $this->request) // pass OTP to the view
            ->from($this->request->email, $this->request->name) // From address
            ->replyTo($this->request->email, $this->request->name); // From address
            // ->replyTo('reply-to@example.com', 'Reply Name') // Reply-To address
            // ->cc('cc@example.com', 'CC Name') // CC address
            // ->bcc('bcc@example.com', 'BCC Name'); // BCC address
    }
}
