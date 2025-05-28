<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Mail;
use App\Mail\Matricula_Alumno;
use ZipArchive;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar correos a los alumnos matriculados con un ZIP de sus documentos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $students = Student::all();

        foreach ($students as $student) {
            $enrollment = Enrollment::where('student_id', $student->id)->first();
            if ($enrollment) {
                // Generar el ZIP de matrícula
                $zipName = 'matricula ' . $student->name . ' ' . $enrollment->course->name . '.zip';
                $zipPath = storage_path('app/private/' . $zipName);

                // Siempre crear un nuevo ZIP
                $zip = new \ZipArchive();
                if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
                    // Generar y añadir el PDF
                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.matriculas_pdf', ['enrollments' => [$enrollment]]);
                    $pdfContent = $pdf->output();
                    $pdfName = 'comunicado_matricula_' . $enrollment->id . '_' . ($enrollment->student->name ?? 'alumno') . '_' . ($enrollment->student->surname ?? '') . '.pdf';
                    $zip->addFromString($pdfName, $pdfContent);

                    // Añadir documentos asociados
                    $docs = is_array($enrollment->enrollment_doc) ? $enrollment->enrollment_doc : [];
                    foreach ($docs as $doc) {
                        if (isset($doc['id'])) {
                            $filePath = storage_path('app/private/Archivos/' . $doc['id']);
                            if (file_exists($filePath)) {
                                $zip->addFile($filePath, 'archivos/' . $doc['original']);
                            }
                        }
                    }
                    $zip->close();
                }                // Enviar el correo con el ZIP adjunto
                try {
                    // Primero verificamos que el ZIP existe y tiene contenido
                    if (file_exists($zipPath) && filesize($zipPath) > 0) {
                        Mail::to($student->email)->send(new Matricula_Alumno($student, $enrollment, $zipPath));

                        // En lugar de borrar inmediatamente, esperamos un poco
                        register_shutdown_function(function() use ($zipPath) {
                            if (file_exists($zipPath)) {
                                unlink($zipPath);
                            }
                        });

                        $this->info('Correo enviado a: ' . $student->name);
                    } else {
                        $this->error('El archivo ZIP no se generó correctamente para: ' . $student->name);
                    }
                } catch (\Exception $e) {
                    $this->error('Error al enviar correo a ' . $student->name . ': ' . $e->getMessage());
                    // Si hay error, asegurarnos de limpiar el ZIP al final
                    register_shutdown_function(function() use ($zipPath) {
                        if (file_exists($zipPath)) {
                            unlink($zipPath);
                        }
                    });
                }
            }
        }

        $this->info('Correos enviados con éxito.');
    }
}
