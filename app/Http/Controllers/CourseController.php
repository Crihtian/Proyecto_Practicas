<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoursesRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Queries\SearchCourse;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = SearchCourse::apply($request->input('q'))->get();
        return view("courses.index", compact("courses", "request"));
    }

    // FILTRO DE BUSQUEDA (descomenta para activar)
    /*
    // public function index(Request $request)
    // {
    //     $query = Course::query();
    //     $field = $request->get('field');
    //     $value = $request->get('value');
    //     if ($field && $value !== null && $value !== '') {
    //         if (in_array($field, ['name', 'specialty_code'])) {
    //             $query->where($field, 'like', "%$value%");
    //         } elseif (in_array($field, ['start_date', 'end_date', 'theory_hours', 'practice_hours'])) {
    //             $query->where($field, $value);
    //         } elseif ($field === 'active') {
    //             $query->where($field, $value);
    //         }
    //     }
    //     $courses = $query->get();
    //     return view("courses.index", compact("courses"));
    // }
    */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course = new Course();
        return view("courses.create", ['course' => new Course()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoursesRequest $request)
    {
        $course = Course::create($request->validated());
        return redirect()->route("courses.index")->with('success', "Curso agregado con exito");
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view("courses.edit", compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoursesRequest $request, Course $course)
    {
        $course->update($request->validated());
        return redirect()->route("courses.index")->with('success', "Curso actualizado con exito");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route("courses.index")->with('success', "Curso eliminado con exito");
    }

    public function deleted()
    {
        $courses = Course::onlyTrashed()->get();
        return view("courses.deleted", compact("courses"));
    }
    public function restore($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $course->restore();
        return redirect()->route("courses.index")->with('success', "Curso restaurado con exito");
    }
    public function forceDelete($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $course->forceDelete();
        return redirect()->route("courses.index")->with('success', "Curso eliminado permanentemente con exito");
    }
}
