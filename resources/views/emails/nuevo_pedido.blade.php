@extends('emails.layout_mail')

@section('content')
    <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
        Gracias por realizar tu pedido <b>{{$mailNuevoPedido['direccionEnvio']->nombre}} {{$mailNuevoPedido['direccionEnvio']->apellidos}}</b>,
    </p>
    <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
       Nos encata verte por aquí y es por ello que nos comprometemos a hacer que nunca pares. 
       A continuación te detallamos el detalle de tu pedido
    </p>
    <table style="width:100%" style="font-size: 14px">
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio Unidad</th>
        <th>Precio Total</th>
      </tr>
      @foreach ($mailNuevoPedido['detallesPedido'] as $pedido)
    <tr>
      <td>{{$pedido->nombre_producto}}</td>
      <td>{{$pedido->cantidad}}</td>
      <td>{{$pedido->precio_final}}€</td>
      <td>{{$pedido->cantidad*$pedido->precio_final}}€</td>
    </tr>
        
    @endforeach
    <tr style="border-bottom: 1px solid #cccccc; border-collapse: collapse;">
        <p>Importe {{$mailNuevoPedido['importe']}}€</p>
      </td>
    </tr>  
    </table>
    

    <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
       
    </p>
@endsection
