<?php

namespace App\Queries;
use App\Models\Course;

class SearchCourse
{
  /**
     * Aplica el scope de búsqueda global a los cursos.
     * @param string|null $q
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function apply(?string $q)
    {
        return Course::query()->when($q, function ($query, $q) {
            $query->where(function ($query) use ($q) {
                $query->where('name', 'like', "%$q%")
                        ->orWhere('specialty_code', 'like', "%$q%")
                        /**->orWhere('start_date', 'like', "%$q%")
                        ->orWhere('finish_date', 'like', "%$q%")
                        ->orWhere('active', 'like', "%$q%")
                        ->orWhere('theorical_hours', 'like', "%$q%")
                        ->orWhere('practice_hours', 'like', "%$q%");
                        */ ;
            });
        });
    }
}
