<?php

namespace App\Queries;

use App\Models\Enrollment;


class SearchEnrollment
{
    /**
     * Aplica el scope de búsqueda global a las matriculas.
     * @param string|null $q
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function apply(?string $q)
    {
        return Enrollment::query()->when($q, function ($query, $q) {
            $query->where(function ($query) use ($q) {
                $query->where('student_id', 'like', "%$q%")
                      ->orWhere('course_id', 'like', "%$q%")
                      ->orWhere('enrollment_date', 'like', "%$q%")
                      ->orWhere('status', 'like', "%$q%")
                       ->orWhereHas('student', function ($query) use ($q) {
                          $query->where('name', 'like', "%$q%");
                      })
                      ->orWhereHas('course', function ($query) use ($q) {
                          $query->where('name', 'like', "%$q%");
                      });
            });
        });
    }
}
