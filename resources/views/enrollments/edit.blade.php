@extends('layouts.app')
@section('content')
<form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('enrollments.form')
    <br>
    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary"> Volver </a>
    <input type="submit" class="btn btn-info" value="Actualizar" >
</form>
@endsection
