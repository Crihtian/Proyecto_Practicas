<?php

namespace App\Queries;

use App\Models\Student;


class SearchStudent
{
    /**
     * Aplica el scope de búsqueda global a los estudiantes.
     * @param string|null $term
     * @param array  $filters
     * @return \Illuminate\Support\Collection
     */
    public static function apply(?string $term, array $filters)
    {
        return Student::query()
                ->search($term)
                ->filter($filters)
                ->get();
    }
}
