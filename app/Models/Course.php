<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'specialty_code',
        'start_date',
        'finish_date', // Cambiado de end_date a finish_date
        'active',
        'theorical_hours', // Cambiado de theory_hours a theorical_hours
        'practice_hours',
    ];
    protected $casts = [
        'start_date' => 'date',
        'finish_date' => 'date', // Cambiado de end_date a finish_date
        'active' => 'boolean',
    ];
}
