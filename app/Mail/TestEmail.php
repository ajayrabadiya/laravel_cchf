<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Sichikawa\LaravelSendgridDriver\SendGrid;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels, SendGrid;

    public $donation;

    /**
     * Create a new message instance.
     *
     * @param $donation
     */
    public function __construct($donation)
    {
        $this->donation = $donation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->sendgrid([
            'personalizations' => [
                [
                    'to' => [
                        ['email' => $this->donation->donor_email, 'name' => $this->donation->donor_first_name . ' ' . $this->donation->donor_last_name]
                    ]
                ],
            ],
            'categories' => ['donation_thank_you'],
        ]);



        return $this->subject('Thank You for Your Donation')
            ->view('emails.test-notification')
            ->with('donation', $this->donation);
    }
}
