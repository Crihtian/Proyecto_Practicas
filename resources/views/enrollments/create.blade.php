@extends('layouts.app')
@section('content')
<form action="{{ route('enrollments.store') }}" method="post" enctype="multipart/form-data">

    @csrf

    @include('enrollments.form')
    <br></br>

    <input type="submit" value="Enviar">
    <input type="button" value="Volver" onclick="window.location='{{ route('enrollments.index') }}'">

    @method('POST')

</form>
@endsection
