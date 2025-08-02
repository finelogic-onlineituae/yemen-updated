<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class PdfFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $pdfContent;

    /**
     * Create a new message instance.
     */
     public function __construct($application, $pdfContent)
    {
        $this->application = $application;
        $this->pdfContent = $pdfContent;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->application->form_type->application_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.form-mail', // create this Blade view
            with: [
                'application' => $this->application,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, 'application.pdf')
                ->withMime('application/pdf'),
        ];
    }

    
}
