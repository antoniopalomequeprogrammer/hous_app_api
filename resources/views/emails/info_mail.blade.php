@extends('emails.layout_mail')

@section('content')
    <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
        El prescriptor {{$prescriptor->nombre}}
        @if ($prescriptor->provincia) de {{$prescriptor->provincia}} @endif
        @if ($centro) del centro: {{$centro->nombre}} @endif
        a solicitado información sobre este producto con referencia {{$producto->ref}}
    </p>
    <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
        Observaciones del prescriptor: {{ $info }}
    </p>
    <br>
    @if ($checkedEmail == 'true' && $checkedPhone == 'true')
        <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
            Avisar por email o teléfono ({{$email}}/{{$phone}})
        </p>
    @else
        @if ($checkedEmail == 'true')
            <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
                Avisar por email ({{$email}})
            </p>
        @endif
        @if ($checkedPhone == 'true')
            <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
                Avisar por teléfono ({{$phone}})
            </p>
        @endif
    @endif
@endsection
