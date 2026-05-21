<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BarberoDailyAppointmentsMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $barbero;
    public $citas;
    protected $pdfData;

    /**
     * Create a new message instance.
     */
    public function __construct(User $barbero, $citas, $pdfData = null)
    {
        $this->barbero = $barbero;
        $this->citas = $citas;
        $this->pdfData = $pdfData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '💈 Tu Agenda de Citas de Hoy - Barbería',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.barbero_daily_summary',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        if ($this->pdfData) {
            return [
                Attachment::fromData(fn () => $this->pdfData, 'Agenda_Citas_Hoy.pdf')
                    ->withMime('application/pdf'),
            ];
        }

        return [];
    }
}
