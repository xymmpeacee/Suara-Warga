<?php

namespace App\Mail;

use App\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AduanStatusUpdatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Complaint $complaint,
        public ?string $responseMessage = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Update Status Aduan #{$this->complaint->ticket_code} — SuaraWarga",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.aduan-status-updated',
        );
    }
}
