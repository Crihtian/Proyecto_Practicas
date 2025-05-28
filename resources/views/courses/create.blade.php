@extends('layouts.app')
@section('content')
<form action="{{ route('courses.store') }}" method="post">

    @csrf

    @include('courses.form')
    <br></br>

    <input type="submit" class="btn btn-info" value="Enviar">
    <input type="button" class="btn btn-secondary" value="Volver" onclick="window.location='{{ route('courses.index') }}'">

    @method('POST')

</form>
@endsection
