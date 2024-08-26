<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnviarCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;

    /**
     * Create a new message instance.
     */
    // Lo de aca va a la vista
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get the message envelope.
     */ 
    //Asunto
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Enviar Correo',
        );
    }

    /**
     * Get the message content definition.
     */
    //Manda la vista como parte del mensaje sino poner text en vez de view
    public function content(): Content
    {
        return new Content(
            view: 'mails.enviar-correo',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // Adjuntar archivos
    public function attachments(): array
    {
        return [];
    }
}
