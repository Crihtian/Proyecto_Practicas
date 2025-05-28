<!-- Buscador simple para cualquier campo
<form action="" method="GET" class="mb-4 d-flex align-items-center gap-2">
    <input type="text" name="q" class="form-control w-auto" placeholder="Buscar..." style="min-width: 220px;">
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>


<div class="mb-4">
    <button type="button" id="toggleSearch" class="btn btn-dark">Alternar buscador</button>
</div>

<div id="simpleSearchForm" style="display: block;">
    <form method="GET" action="{{ route($entity . '.index') }}" class="mb-4">
        <input type="text" name="q" placeholder="Buscar..." value="{{ request('q') }}" class="border rounded px-2 py-1">
        <button type="submit" class="btn btn-info">Buscar</button>
    </form>
</div>

<div id="advancedSearchForm" style="display: none;">
    <form method="GET" action="{{ route($entity . '.index') }}" class="mb-4">
        <select name="field" class="border rounded px-2 py-1">
            <option value="">Seleccione campo</option>
            @foreach ($fields as $field)
                <option value="{{ $field['value'] }}" {{ request('field') == $field['value'] ? 'selected' : '' }}>{{ $field['label'] }}</option>
            @endforeach
        </select>
        <input type="text" name="value" placeholder="Valor" value="{{ request('value') }}" class="border rounded px-2 py-1">
        <button type="submit" class="btn btn-info">Buscar</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleSearch');
        const simpleForm = document.getElementById('simpleSearchForm');
        const advancedForm = document.getElementById('advancedSearchForm');
        toggleBtn.addEventListener('click', function() {
            if (simpleForm.style.display === 'none') {
                simpleForm.style.display = 'block';
                advancedForm.style.display = 'none';
            } else {
                simpleForm.style.display = 'none';
                advancedForm.style.display = 'block';
            }
        });
    });
</script>
-->
