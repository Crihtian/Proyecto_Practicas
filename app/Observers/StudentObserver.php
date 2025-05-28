<?php

namespace App\Observers;

use App\Models\Student;
use App\Models\Register;
use App\Models\User;
use App\Traits\Lowercase;
use App\Enums\ActionType;
use Illuminate\Support\Facades\Mail;

class StudentObserver
{
    use Lowercase;
    /**
     * Handle the Student "created" event.
     */
    public function creating(Student $student): void
    {
       $student->name = strtolower($student->name);
    }

    public function created(Student $student): void
    {
        // Enviar email de bienvenida
        Mail::to($student->email)->send(new \App\Mail\BienvenidaUsuario($student));

        // Registrar la acción
        Register::create([
            'student_id' => $student->id,
            'user_id' => auth()->id(), // Solo el ID, puede ser null
            'action' => ActionType::CREATE
        ]);
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updating(Student $student): void
    {
        $student->name = strtolower($student->name);
    }

    public function updated(Student $student): void
    {
        Register::create([
            'student_id' => $student->id,
            'user_id' => auth()->id(),
            'action' => ActionType::EDIT
        ]);
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleting(Student $student): void
    {
        Register::create([
            'student_id' => $student->id,
            'user_id' => auth()->id(),
            'action' => ActionType::DELETE
        ]);
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
         Register::create([
            'student_id' => $student->id,
            'user_id' => auth()->id(),
            'action' => ActionType::RESTORE
        ]);
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleting(Student $student): void
    {
         Register::create([
            'student_id' => $student->id,
            'user_id' => auth()->id(),
            'action' => ActionType::FORCE_DELETE
        ]);
    }
}
