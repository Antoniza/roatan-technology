<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class finishRepair extends Mailable
{
    use Queueable, SerializesModels;

    public $_code;
    public $_message;
    public $_client;
    public $_list;
    public $_device;
    public $_service;
    public $_technical;
    public $_time;
    public $_subtotal;
    public $_isv;
    public $_total;
    public $_observation;
    public $_recomendation;
    /**
     * Create a new message instance.
     */
    public function __construct($code, $client, $device, $service, $technical, $list, $total, $recomendation, $observation)
    {
        $this->_code = $code;
        $this->_client = $client;
        $this->_device = $device;
        $this->_service = $service;
        $this->_technical = $technical;
        $this->_list = $list;
        $this->_subtotal = $total;
        $this->_isv = $total*0.15;
        $this->_total = $this->_subtotal + $this->_isv;
        $this->_recomendation = $recomendation;
        $this->_observation = $observation;

        $this->_time = Carbon::now();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Reparación finalizada!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.finishRepair',
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
