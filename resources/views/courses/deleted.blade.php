@extends('layouts.app')

@section('content')
<h1>Listado de cursos eliminados</h1>
<table class="table table-bordered align-middle" style="border-spacing: 0 10px; border-collapse: separate;">
    <thead class="table-light">
    <tr>
        <th>ID</th>
        <th>Curso</th>
        <th>Código</th>
        <th>Activo</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($courses as $course)
    <tr>
        <td>{{ $course->id }}</td>
        <td>{{ $course->name }}</td>
        <td>{{ $course->specialty_code }}</td>
        <td>{{ $course->active ? 'Si' : 'No' }}</td>
        <td>
            <form action="{{ route('courses.restore', $course->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-info">Restaurar</button>
            </form>
            <form action="{{ route('courses.force_delete', $course->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Eliminar permanentemente?')" class="btn btn-danger">Eliminar definitivamente</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('courses.index') }}'">Volver</button>
@endsection
