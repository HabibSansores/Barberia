<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BarberNewAppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cita;
    public User $barbero;
    protected $pdfData;

    /**
     * Create a new message instance.
     */
    public function __construct($cita, User $barbero, $pdfData)
    {
        $this->cita = $cita;
        $this->barbero = $barbero;
        $this->pdfData = $pdfData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '💈 ¡Tienes una Nueva Cita Agendada! - Barbería',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.barber_new_appointment',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfData, 'Recibo_Cita_Cliente.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
