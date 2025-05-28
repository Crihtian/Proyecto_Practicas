<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Queries\SearchStudent;
use Illuminate\Support\Facades\Mail;
use App\Mail\BienvenidaUsuario;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        new SearchStudent();
        $q = $request->input('q');
        $students = Student::search($q)->get();

        $filters = $request->only(['name', 'lastname', 'idcard', 'email', 'birthday', 'disability']);
        $students = Student::filter($filters)->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = new Student();

        return view ("students.create",['student' => new Student()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $student = Student::create($request->validated());
        return redirect()->route("students.index")->with('success',"Alumno agregado con exito");
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
       /* $student = Student::all();
        */return view ("students.show",compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view ("students.edit", compact('student'));
    }


    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        return redirect()->route("students.index")->with('success',"Alumno actualizado con exito");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route("students.index")->with('success',"Alumno eliminado con exito");
    }

    public function deleted()
    {
        $students = Student::onlyTrashed()->get();
        return view("students.deleted", compact("students"));
    }

    public function restore($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->restore();
        return redirect()->route("students.index")->with('success', "Alumno restaurado con exito");
    }

    public function force_delete($id)
    {
        $student = Student::withTrashed()->findOrFail($id);
        $student->forceDelete();
        return redirect()->route("students.index")->with('success', "Alumno eliminado permanentemente con exito");
    }

    public function exportPDF()
    {
        $students = Student::all();
        $pdf = Pdf::loadView('pdf.alumnos_pdf', compact('students'));
        return $pdf->download('alumnos.pdf');
    }

    public function addImport()
    {
        return view('students.import');

    }
    public function import(Request $request)
    {


        $request->validate([
            'xml_file' => 'required|file|mimes:xml|max:2048',
        ]);
        $file = $request->file('xml_file');


        $xmlContent = file_get_contents($file->getRealPath());
        $studentsXml = simplexml_load_string($xmlContent);

        if ($studentsXml === false) {
            return back()->withErrors(['xml_file' => 'El archivo XML no es válido.']);

        }


        foreach ($studentsXml->student as $studentData) {

            Student::updateOrCreate(

                [
                    'name' => (string) $studentData->name,
                    'lastname' => (string) $studentData->lastname,
                    'idcard' => (string) $studentData->idcard,
                    'email' => (string) $studentData->email,
                    'address' => (string) $studentData->address,
                    'birthday' =>  fake()->dateTimeBetween('-50 years', '-16 years')->format('d-m-Y'),
                    'disability' => filter_var($studentData->disability, FILTER_VALIDATE_BOOLEAN),
                ]
            );
        }
        return view('students.import')->with('success', 'Estudiantes importados correctamente.');
    }

    public function exportXML(Request $request)
    {
        //dd($request->all());
        $students = Student::all();

        $xml = new \SimpleXMLElement('<?xml version="1.0"?><students></students>');

        foreach ($students as $student) {
            $studentXml = $xml->addChild('student');
            $studentXml->addChild('name', $student->name);
            $studentXml->addChild('lastname', $student->lastname);
            $studentXml->addChild('idcard', $student->idcard);
            $studentXml->addChild('email', $student->email);
            $studentXml->addChild('address', $student->address);
            $studentXml->addChild('birthday', $student->birthday);
            $studentXml->addChild('disability', $student->disability ? 'true' : 'false');
        }

        $xmlContent = $xml->asXML();

        //return $xmlContent->download('students.xml');
        return response($xmlContent, 200)
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', 'attachment; filename="students.xml"');

    }
}
