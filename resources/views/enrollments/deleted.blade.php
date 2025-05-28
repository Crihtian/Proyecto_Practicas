@extends('layouts.app')

@section('content')
<h1>Listado de matrículas eliminadas</h1>
<table class="table table-bordered align-middle" style="border-spacing: 0 10px; border-collapse: separate;">
    <thead class="table-light">
    <tr>
        <th>Id alumno</th>
        <th>Id curso</th>
        <th>Documentación</th>
        <th>Fecha Matriculación</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($enrollments as $enrollment)
    <tr>
        <td>{{ $enrollment->student_id }}</td>
        <td>{{ $enrollment->course_id }}</td>
        <td>{{ $enrollment->enrollment_doc ? 'Sí' : 'No' }}</td>
        <td>{{ $enrollment->enrollment_date }}</td>
        <td>
            <form action="{{ route('enrollments.restore', $enrollment->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-info">Restaurar</button>
            </form>
            <form action="{{ route('enrollments.force_delete', $enrollment->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Eliminar permanentemente?')" class="btn btn-danger">Eliminar definitivamente</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('enrollments.index') }}'">Volver</button>
@endsection
