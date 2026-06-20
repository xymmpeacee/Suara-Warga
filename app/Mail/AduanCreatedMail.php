<?php

namespace App\Mail;

use App\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AduanCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Complaint $complaint) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Tiket Aduan #{$this->complaint->ticket_code} — SuaraWarga",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.aduan-created',
        );
    }
}
