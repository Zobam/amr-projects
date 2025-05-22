<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReceived extends Mailable
{
    use Queueable, SerializesModels;
    private $has_email_type = false;

    /**
     * Create a new message instance.
     */
    public function __construct(public Request $data)
    {
        $this->data = $data;
        $this->has_email_type = $this->data->has('email_type');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->has_email_type ? 'Verify Email' : 'Contact Received',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->has_email_type ? 'emails.verify_email' : 'emails.contacted',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ($this->data->is_pdf && !$this->data->to_guest) {
            return [
                Attachment::fromPath($this->data->passport_link)->as('passport')->withMime('application/pdf'),
            ];
        }
        return [];
    }
}
