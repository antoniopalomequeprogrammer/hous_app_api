@extends('emails.layout_mail')

@section('content')
    <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
        Bienvenido {{$cliente->nombre}} {{$cliente->apellidos}},
    </p>
    <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
       Nos encata verte por aquí y es por ello que nos comprometemos a hacer que nunca pares. Podrás consultar toda la oferta deportiva de la ciudad y reservar a ton solo un par de clicks.

    </p>
    <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
       ¡ Bienvenido a la revolución de la gestión deportiva!
    </p>
@endsection
