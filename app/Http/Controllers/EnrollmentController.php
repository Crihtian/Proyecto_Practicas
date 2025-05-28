<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollmentRequest;
use App\Models\Enrollment;
use App\Queries\SearchEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Si hay búsqueda avanzada, priorizarla
        $field = $request->get('field');
        $value = $request->get('value');
        if ($field && $value !== null && $value !== '') {
            $query = Enrollment::query();
            if (in_array($field, ['student_id', 'course_id', 'enrollment_date'])) {
                $query->where($field, 'like', "%$value%");
            }
            $enrollments = $query->get();
        } elseif ($request->filled('q')) {
            // Búsqueda simple
            $enrollments = SearchEnrollment::apply($request->input('q'))->get();
        } else {
            // Sin filtros, mostrar todos
            $enrollments = Enrollment::all();
        }
        return view("enrollments.index", compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $enrollment = new Enrollment();
        return view("enrollments.create", ['enrollment' => new Enrollment()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnrollmentRequest $request)
    {
        $enrollment = Enrollment::create($request->validated());
        return redirect()->route("enrollments.index")->with('success', "Matrícula agregada con éxito");

        if ($request->hasFile('enrollment_doc')) {
            $path = $request->file('enrollment_doc')->storeAs('archivos', $request->file('enrollment_doc')->getClientOriginalName(), 'local');
            $enrollment->enrollment_doc = $path;
            $enrollment->save();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        return view("enrollments.edit", compact('enrollment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnrollmentRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->validated());

        //Subida de archivos


        if ($request->hasFile('enrollment_doc')) {
            $path = $request->file('enrollment_doc')->store('archivos', 'local');
            $enrollment->enrollment_doc = $path;
            $enrollment->save();
        }
        return redirect()->route("enrollments.index")->with('success', "Matrícula actualizada con éxito");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route("enrollments.index")->with('success', "Matrícula eliminada con éxito");
    }
    public function deleted()
    {
        $enrollments = Enrollment::onlyTrashed()->get();
        return view("enrollments.deleted", compact("enrollments"));
    }
    public function restore($id)
    {
        $enrollment = Enrollment::withTrashed()->findOrFail($id);
        $enrollment->restore();
        return redirect()->route("enrollments.index")->with('success', "Matrícula restaurada con éxito");
    }
    public function force_Delete($id)
    {
        $enrollment = Enrollment::withTrashed()->findOrFail($id);
        $enrollment->forceDelete();
        return redirect()->route("enrollments.index")->with('success', "Matrícula eliminada permanentemente con éxito");
    }
}
