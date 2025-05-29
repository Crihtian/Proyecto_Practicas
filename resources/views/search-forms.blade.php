<form method="GET" action="{{ route('students.index') }}" x-data="{ open: false }">
    {{-- Búsqueda global --}}
    <div>


        <input
            type="text"
            name="term"
            value="{{ request('term') }}"
            placeholder="Buscar en todos los campos..."
        >

        <button type="submit">Buscar</button>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
       <button type="button" @click="open = !open">
            Búsqueda avanzada
        </button>



    </div>

    {{-- Búsqueda avanzada (desplegable) --}}
    <div x-show="open" x-collapse x-cloak>
        <div>
            <input type="text" name="name" value="{{ request('name') }}" placeholder="Nombre">
            <input type="text" name="lastname" value="{{ request('lastname') }}" placeholder="Apellido">
            <input type="text" name="idcard" value="{{ request('idcard') }}" placeholder="Dni / Nie">
            <input type="email" name="email" value="{{ request('email') }}" placeholder="Email">
            <!-- <input type="date" name="birthday" value="{{ request('birthday') }}">
            <select name="disability">
                <option value="">¿Discapacidad?</option>
                <option value="1" @selected(request('disability') === '1')>Sí</option>
                <option value="0" @selected(request('disability') === '0')>No</option>
            </select>
            <input type="text" name="address" value="{{ request('address') }}" placeholder="Dirección"> -->
        </div>

        <div>
            <button type="submit">Aplicar filtros</button>
        </div>
    </div>
</form>
