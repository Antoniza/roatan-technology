<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class newRepairMail extends Mailable
{
    use Queueable, SerializesModels;

    public $_code;
    public $_message;
    public $_client;
    public $_device;
    public $_service;
    public $_technical;
    public $_time;
    /**
     * Create a new message instance.
     */
    public function __construct($code, $client, $device, $service, $technical)
    {
        $this->_code = $code;
        $this->_client = $client;
        $this->_device = $device;
        $this->_service = $service;
        $this->_technical = $technical;

        $this->_time = Carbon::now();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reparación en proceso...',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newRepairMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
