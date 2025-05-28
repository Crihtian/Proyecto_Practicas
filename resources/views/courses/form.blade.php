<label for="name"> Nombre del curso: </label>
    <input type="text" id="name" name= "name" class="form-control" value="{{old('name',$course->name ?? '')}}"><br></br>

    <label for="specialty_code"> Codigo de curso: </label>
    <input type="text" id="specialty_code" name="specialty_code"class="form-control" value="{{old('specialty_code',$course->specialty_code ?? '')}}"><br></br>
    @error('specialty_code')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="start_date">Fecha de inicio:</label>
    <input type="date" id="start_date" name="start_date"class="form-control" value="{{old('start_date',$course->start_date ?? '')}}"><br></br>
    @error('start_date')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

     <label for="finish_date">Fecha de fin:</label>
    <input type="date" id="finish_date" name="finish_date"class="form-control" value="{{old('finish_date',$course->finish_date ?? '')}}"><br></br>
    @error('finish_date')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <label for="active"> Activo :</label>
    <input type="hidden" name="active" value="0">
    <input type="checkbox" id="active" name="active" value="1" {{old('active', $course->active) ? 'checked' : ''}}><br></br>

    <label for="theorical_hours"> Horas de teoria: </label>
    <input type="text" id="theorical_hours" name="theorical_hours"class="form-control" value="{{old('theorical_hours',$course->theorical_hours ?? '')}}"><br></br>

    <label for="practice_hours"> Horas de practica: </label>
    <input type="text" id="practice_hours" name="practice_hours"class="form-control" value="{{old('practice_hours',$course->practice_hours ?? '')}}"><br></br>
