@component('mail::message')
# Hola

Aquí tienes el link para descargar el archivo

@component('mail::button', ['url' => $filePath])
Descargar
@endcomponent

Gracias por usar nuestra aplicación,<br>
{{ config('app.name') }}
@endcomponent
