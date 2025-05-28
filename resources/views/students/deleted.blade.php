@extends('layouts.app')

@section('content')
<h1>Listado de estudiantes eliminados</h1>
<table class="table table-bordered align-middle" style="border-spacing: 0 10px; border-collapse: separate;">
    <thead class="table-light">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>DNI / NIE</th>
        <th>Dirección</th>
        <th>Disc.</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
    <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->lastname }}</td>
        <td>{{ $student->idcard }}</td>
        <td>{{ $student->address }}</td>
        <td>{{ $student->disability ? 'Si' : 'No' }}</td>
        <td>
            <form action="{{ route('students.restore', $student->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-info">Restaurar</button>
            </form>
            <form action="{{ route('students.force_delete', $student->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar permanentemente?')">Eliminar definitivamente</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('students.index') }}'">Volver</button>
@endsection
