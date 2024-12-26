<?php

// app/Mail/OtpMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CareerEnquirys extends Mailable
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
        $email = $this->view('emails.careerenquiry') // Specify the view for the email
            ->subject('GlobStay Enquiry') // Set the email subject
            ->with('req', $this->request) // Pass data to the view
            ->from($this->request->email, $this->request->name) // From address
            ->replyTo($this->request->email, $this->request->name); // Reply-To address

        // Attach the resume if it exists and the environment is not localhost
        if (!empty($this->request->job_info['resume']) && $_SERVER['SERVER_NAME'] != 'localhost') {
            $email->attach(public_path('storage/resume/' . $this->request->job_info['resume']));
        }

        return $email;
    }

}
