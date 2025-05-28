@component('mail::message')
# Hola {{ $student->name }},

Te enviamos la documentación completa de tu matrícula en el curso **{{ $course->name ?? 'N/A' }}**.

## Detalles de la matrícula

- **Número de matrícula:** {{ $enrollmentId }}
- **Fecha de matrícula:** {{ $enrollmentDate }}
- **Curso:** {{ $course->name ?? 'N/A' }}
- **Alumno:** {{ $student->name }} {{ $student->surname ?? '' }}

## Documentación adjunta

En el archivo ZIP adjunto encontrarás:
- Comunicado oficial de matrícula (PDF)
- Todos los documentos que subiste durante el proceso de matrícula

@component('mail::panel')
**Importante:** Conserva esta documentación para tus registros. Si tienes alguna pregunta sobre tu matrícula, no dudes en contactarnos.
@endcomponent

@if(isset($course->description))
### Sobre el curso
{{ $course->description }}
@endif

@component('mail::button', ['url' => config('app.url')])
Acceder a la plataforma
@endcomponent

Gracias por confiar en nosotros para tu formación.

Saludos cordiales,<br>
{{ config('app.name') }}

---
<small>Este es un correo automático, por favor no respondas a esta dirección.</small>
@endcomponent
