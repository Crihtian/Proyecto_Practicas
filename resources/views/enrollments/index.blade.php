@extends('layouts.app')



@section('content')




<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-primary">Gestor de Matrículas</h1>
    <div>
        <form action="{{ route('enrollments.create') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn btn-success shadow-sm"><i class="bi bi-plus-circle"></i> Nueva Matrícula</button>
        </form>
        <form action="{{ route('enrollments.deleted') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn btn-warning shadow-sm"><i class="bi bi-archive"></i> Matriculas eliminadas</button>
        </form>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-hover table-bordered align-middle shadow-sm rounded" style="background-color: #fff; border-radius: 12px; overflow: hidden;">
            <thead class="table-primary">
            <tr>
                <th class="text-center">Id alumno</th>
                <th class="text-center">Alumno</th>
                <th class="text-center">Id curso</th>
                <th class="text-center">Curso</th>
                <th class="text-center">Documentación</th>
                <th class="text-center">Fecha Matriculación</th>
                <th class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($enrollments as $enrollment)
            <tr>
                <td class="text-center text-secondary">{{ $enrollment->student_id }}</td>
                <td class="text-center">{{ $enrollment->student->name }} {{ $enrollment->student->surname ?? '' }}</td>
                <td class="text-center text-secondary">{{ $enrollment->course_id }}</td>
                <td class="text-center">{{ $enrollment->course->name }}</td>
                <td class="text-center">
                    @php $docs = is_array($enrollment->enrollment_doc) ? $enrollment->enrollment_doc : []; @endphp
                    <ul class="list-unstyled mb-0">
                        @forelse($docs as $idx => $doc)
                            <li>
                                @if(is_array($doc) && array_key_exists('id', $doc))
                                    <span class="badge bg-light text-dark border me-2">{{ $doc['original'] ?? $doc['id'] }}</span>
                                    <a href="{{ route('enrollments.download', ['id' => $enrollment->id, 'file' => $idx]) }}" class="btn btn-outline-info btn-sm" title="Descargar">⬇</a>
                                    <a href="{{ route('enrollments.preview', ['id' => $enrollment->id, 'file' => $idx]) }}" class="btn btn-outline-secondary btn-sm" title="Previsualizar" target="_blank">👁</a>
                                    <form action="{{ route('enrollments.delete_file', ['id' => $enrollment->id, 'file' => $idx]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar archivo" onclick="return confirm('¿Eliminar este archivo?')">🗑</button>
                                    </form>
                                @else
                                    <span class="text-danger">Sin archivos</span>
                                @endif
                            </li>
                        @empty
                            <li><span class="text-danger">Sin archivos</span></li>
                        @endforelse
                    </ul>
                </td>
                <td class="text-center">{{ $enrollment->enrollment_date ? $enrollment->enrollment_date->format('d-m-Y') : '-' }}</td>
                <td class="text-center">
                    <form action="{{ route('enrollments.edit', $enrollment->id) }}" method="GET" style="display:inline;">
                        <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                    </form>
                    <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta matrícula?')" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                    <a href="{{ route('enrollments.export.pdf.single', $enrollment->id) }}" class="btn btn-outline-danger btn-sm" title="Descargar comunicado PDF"><b>PDF</b></a>
                    <a href="{{ route('enrollments.export.zip', $enrollment->id) }}" class="btn btn-outline-secondary btn-sm" title="Descargar archivos ZIP">ZIP</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

