@extends('layouts.app')
@section('content')
<form action="{{ route('students.store') }}" method="post">

    @csrf

    @include('students.form')
    <br></br>

    <input type="submit" value="Enviar" class="btn btn-info">
    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('students.index') }}'">Volver</button>

    @method('POST')

</form>
@endsection
