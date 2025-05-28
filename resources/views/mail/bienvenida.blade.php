<x-mail::message>
Hola {{ $student->name }},

Te damos la bienvenida a nuestra plataforma. Estamos encantados de tenerte con nosotros.

Con el esfuerzo y dedicación, podrás alcanzar tus metas y lograr tus sueños.
Estamos aquí para apoyarte en cada paso del camino.
Si tienes alguna pregunta o necesitas ayuda, no dudes en ponerte en contacto con nosotros.

Recuerda que la educación es la clave para abrir muchas puertas en la vida.
Estamos comprometidos a brindarte la mejor experiencia de aprendizaje posible.
Para comenzar, te invitamos a explorar nuestra plataforma y familiarizarte con los recursos disponibles.
Aquí tienes un enlace para acceder a tu cuenta:

<x-mail::button url="{{ route('students.index') }}">
    Botón de la sabiduría
</x-mail::button>

Si tienes alguna pregunta o necesitas ayuda, no dudes en ponerte en contacto con nosotros.
Estamos aquí para apoyarte en cada paso del camino.

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
