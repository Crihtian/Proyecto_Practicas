@extends('layouts.app')
@section('content')
<form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="xml_file">Selecciona el archivo XML:</label>
    <input type="file" name="xml_file" accept=".xml" required>
    <button type="submit">Importar Estudiantes</button>

</form>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection


