@extends('emails.layout_mail')

@section('content')
    <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">Saludos {{$user->nombre}}, puede cambiar su contraseña en el siguiente enlace:</p>
    <br>
    <a style="font-family: 'Gotham-Medium'; font-size: 16px; color: #fff; text-decoration: none; " href="{{route('changePass', ['token' => $token])}}">
        <div style="background-color: #892647; padding: 20px; border-radius: 50px; width: 250px; text-align: center; box-shadow: -2px 2px 10px 0px rgba(51,51,51,1);">
            Cambia tu contraseña aquí
        </div>
    </a>
@endsection
