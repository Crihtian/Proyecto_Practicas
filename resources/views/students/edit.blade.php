@extends('layouts.app')
@section('content')
<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')

   @include('students.form')
    <br>
    <a href="{{ route('students.index') }}" class="btn btn-secondary"> Volver </a>
    <button type="submit" class="btn btn-info">Actualizar</button>
</form>
@endsection
