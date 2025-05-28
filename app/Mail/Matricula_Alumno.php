<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class Matricula_Alumno extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $enrollment;
    public $zipPath;

    /**
     * Create a new message instance.
     */
    public function __construct($student, $enrollment, $zipPath)
    {
        $this->student = $student;
        $this->enrollment = $enrollment;
        $this->zipPath = $zipPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Matrícula Alumno',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.matricula',
            with: [
                'student' => $this->student,
                'course' => $this->enrollment->course,
                'enrollmentId' => $this->enrollment->id,
                'enrollmentDate' => $this->enrollment->created_at->format('d/m/Y'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */    public function attachments(): array
    {
        if (!file_exists($this->zipPath) || filesize($this->zipPath) === 0) {
            throw new \RuntimeException('El archivo ZIP no existe o está vacío: ' . $this->zipPath);
        }

        return [
            Attachment::fromPath($this->zipPath)
                ->as('matricula ' . $this->student->name . ' ' . $this->enrollment->course->name . '.zip')
                ->withMime('application/zip'),
        ];
    }
}
