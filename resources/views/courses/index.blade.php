@extends('layouts.app')

@section('content')




<h1>Listado de cursos</h1>
<table class="table table-striped table-hover table-bordered align-middle shadow-sm rounded" style="background-color: #fff; border-radius: 12px; overflow: hidden;">
    <thead class="table-primary">
    <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Curso</th>
        <th class="text-center">Fecha Inicio</th>
        <th class="text-center">Fecha Fin</th>
        <th class="text-center">Código</th>
        <th class="text-center">Activo</th>
        <th class="text-center">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($courses as $course)
    <tr>
        <td class="text-center text-secondary">{{ $course->id }}</td>
        <td class="text-center">{{ $course->name }}</td>
        <td class="text-center">{{ $course->start_date ? $course->start_date->format('d/m/Y') : 'N/A' }}</td>
        <td class="text-center">{{ $course->finish_date ? $course->finish_date->format('d/m/Y') : 'N/A' }}</td>
        <td class="text-center">{{ $course->specialty_code }}</td>
        <td class="text-center">{{ $course->active ? 'Si' : 'No' }}</td>
        <td class="text-center">
            <form action="{{ route('courses.edit', $course->id) }}" method="GET" style="display:inline;">
                <button type="submit" class="btn btn-primary btn-sm">Editar</button>
            </form>
            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este estudiante?')" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<form action="{{ route('courses.create') }}" method="GET" style="display:inline;">
    <button type="submit" class="btn btn-success">Nuevo curso</button>
</form>
<form action="{{ route('courses.deleted') }}" method="GET" style="display:inline;">
    <button type="submit" class="btn btn-warning">Cursos eliminados</button>
</form>
@endsection

