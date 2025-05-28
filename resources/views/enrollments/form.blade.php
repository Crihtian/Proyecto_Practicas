<label for="student_id">Alumno:</label>
<input type="number" id="student_id" name="student_id" class="form-control" value="{{ old('student_id', $enrollment->student_id ?? '') }}"><br>

<label for="course_id">Curso:</label>
<input type="number" id="course_id" name="course_id" class="form-control" value="{{ old('course_id', $enrollment->course_id ?? '') }}"><br>

<label for="enrollment_doc">Documentación (máx. 3 archivos: PDF, JPG, JPEG, PNG):</label>
<ul style="list-style:none; padding-left:0;">
    @php
        $docs = is_array($enrollment->enrollment_doc) ? $enrollment->enrollment_doc : [];
    @endphp
    @for($i = 0; $i < 3; $i++)
        <li style="margin-bottom:8px;">
            <input type="file" name="enrollment_doc[{{$i}}]" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            @if(isset($docs[$i]['id']) && $docs[$i]['id'])
                <span class="text-success">Subido: {{ $docs[$i]['original'] ?? $docs[$i]['id'] }}</span>
            @else
                <span class="text-danger">No subido</span>
            @endif
        </li>
    @endfor
</ul>

<label for="enrollment_date">Fecha de matriculación:</label>
<input type="date" id="enrollment_date" name="enrollment_date" class="form-control" value="{{ old('enrollment_date', $enrollment->enrollment_date ?? '') }}"><br>
