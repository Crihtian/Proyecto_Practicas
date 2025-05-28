@extends('layouts.app')
@section('content')
<form action="{{ route('courses.update', $course->id) }}" method="POST">
    @csrf
    @method('PUT')

   @include('courses.form')
    <br>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary" > Volver </a>
    <input type="submit" class="btn btn-info" value="Actualizar" >
</form>
@endsection
