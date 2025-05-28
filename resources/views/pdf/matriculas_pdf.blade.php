<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comunicado de Matrícula</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .comunicado { border: 1px solid #ccc; border-radius: 8px; padding: 32px; max-width: 600px; margin: 0 auto 40px auto; background: #f9f9f9; }
        .titulo { font-size: 1.5em; color: #2c3e50; margin-bottom: 20px; }
        .info { font-size: 1.1em; margin-bottom: 10px; }
        .fecha { color: #888; font-size: 0.95em; margin-top: 20px; }
    </style>
</head>
<body>
@foreach($enrollments as $enrollment)
    <div class="comunicado">
        <div class="titulo">Comunicado de Matrícula</div>
        <div class="info">
            Estimado/a <strong>{{ $enrollment->student->name }} {{ $enrollment->student->lastname ?? '' }}</strong>,<br><br>
            Le informamos que se ha matriculado correctamente en el curso <strong>"{{ $enrollment->course->name }}"</strong>.
        </div>
        <div class="fecha">
            Fecha de matriculación: {{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('d/m/Y') }}
        </div>
        <div style="margin-top:30px; font-size:0.95em; color:#555;">
            Si tiene alguna duda, no dude en contactar con la secretaría del centro.
        </div>
    </div>
@endforeach
</body>
</html>
