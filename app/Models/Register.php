<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{


    protected $fillable = [
        'student_id',
        'user_id',
        'action',
    ];

    protected $casts = [
        'action' => \App\Enums\ActionType::class
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
