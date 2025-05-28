    <label for="name"> Nombre: </label>
    <input type="text" id="name" name= "name" class="form-control" value="{{old('name',$student->name ?? '')}}"><br></br>

    <label for="lastname"> Apellido: </label>
    <input type="text" id="lastname" name="lastname"class="form-control" value="{{old('lastname',$student->lastname ?? '')}}"><br></br>

    <label for="idcard"> DNI / NIE :</label>
    <input type="text" id="idcard" name="idcard"class="form-control" value="{{old('idcard',$student->idcard ?? '')}}"><br></br>

    <label for="email"> Email :</label>
    <input type="email" id="email" name="email"class="form-control" value="{{old('email',$student->email ?? '')}}"><br></br>

    <label for="birthday">Fecha de nacimiento :</label>
    <input type="date" id="birthday" name="birthday"class="form-control" value="{{old('birthday',$student->birthday ?? '')}}"><br></br>
    @error('birthday')
        <div class="alert alert-danger">{{ $message }}</div>

    @enderror
    <label for="disability"> Discapacidad :</label>
    <input type="hidden" name="disability" value="0">
    <input type="checkbox" id="disability" name="disability" value="1" {{old('disability', $student->disability) ? 'checked' : ''}}><br></br>

    <label for="address">Dirección :</label>
    <input type="text" id="address" name="address"class="form-control" value="{{old('address',$student->address ?? '')}}"><br></br>
