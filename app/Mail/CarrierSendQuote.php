<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CarrierSendQuote extends Mailable
{
    use Queueable, SerializesModels;

    public $verify_code;
    public $carrier_dot_number;
    public $carrier_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verify_code, $carrier_dot_number, $carrier_name)
    {
        $this->verify_code = $verify_code;
        $this->carrier_dot_number = $carrier_dot_number;
        $this->carrier_name = $carrier_name;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Quick Freight Enterprise',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.carrier_send_quote',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
