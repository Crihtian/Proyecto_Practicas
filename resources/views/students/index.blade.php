@extends('layouts.app')

@section('content')
{{-- Formulario de búsqueda simple/avanzada --}}
@include('search-forms')

{{-- Mensaje de éxito --}}



<h1>Listado de estudiantes</h1>
<table class="table table-striped table-hover table-bordered align-middle shadow-sm rounded" style="background-color: #fff; border-radius: 12px; overflow: hidden;">
    <thead class="table-primary">
    <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Apellidos</th>
        <th class="text-center">DNI / NIE</th>
        <th class="text-center">Email</th>
        <th class="text-center">Dirección</th>
        <th class="text-center">Disc.</th>
        <th class="text-center">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
    <tr>
        <td class="text-center text-secondary">{{ $student->id }}</td>
        <td class="text-center">{{ $student->name }}</td>
        <td class="text-center">{{ $student->lastname }}</td>
        <td class="text-center">{{ $student->idcard }}</td>
        <td class="text-center">{{ $student->email }}</td>
        <td class="text-center">{{ $student->address }}</td>
        <td class="text-center">{{ $student->disability ? 'Si' : 'No' }}</td>
        <td class="text-center">
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">Editar</a>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este estudiante?')" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<form action="{{ route('students.create') }}" method="GET" style="display:inline;">
    <button type="submit" class="btn btn-success">Nuevo estudiante</button>
</form>
<form action="{{ route('students.deleted') }}" method="GET" style="display:inline;">
    <button type="submit" class="btn btn-warning">Estudiantes eliminados</button>
</form>
<a href="{{ route('students.export_pdf') }}" class="btn btn-primary">Exportar PDF</a>
<a href="{{ route('students.import') }}" class="btn btn-secondary">Importar XML</a>
<a href="{{ route('students.export_xml') }}" class="btn btn-secondary">Exportar XML</a>


@endsection

