<?php

namespace App\Queries;

use App\Models\Student;

class SearchStudent
{
    /**
     * Aplica el scope de búsqueda global a los estudiantes.
     * @param string|null $q
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($q)
    {
        return Student::search($q)->get();
    }
    public function filter(array $filters)
    {
       return Student::filter($filters)->get();
    }
}
