@extends('emails.layout_mail')

@section('content')
    <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
        Tienes un nuevo pedido realizado por  <b>{{$mailNuevoPedido['direccionEnvio']->nombre}} {{$mailNuevoPedido['direccionEnvio']->apellidos}}</b>,
    </p>
    <hr>
    Datos de Envio
    <ul>
        <li>Nombre:  {{$mailNuevoPedido['direccionEnvio']->nombre}}</li>
        <li>Apellidos: {{$mailNuevoPedido['direccionEnvio']->apellidos}}</li>
        <li>Dirección: {{$mailNuevoPedido['direccionEnvio']->direccion}}</li>
        <li>Pais: {{$mailNuevoPedido['direccionEnvio']->pais}}</li>
        <li>Ciudad: {{$mailNuevoPedido['direccionEnvio']->ciudad}}</li>
        <li>Código Postal {{$mailNuevoPedido['direccionEnvio']->cp}}</li>
        <li>Dirección 2 {{$mailNuevoPedido['direccionEnvio']->otra_direccion}}</li>
        <li>Teléfono {{$mailNuevoPedido['direccionEnvio']['telefono']}}</li>
    </ul>
    <hr>
    Datos de Facturación

    <ul>
        <li>Nombre:  {{$mailNuevoPedido['direccionFacturacion']->nombre}}</li>
        <li>Apellidos: {{$mailNuevoPedido['direccionFacturacion']->apellidos}}</li>
        <li>Dirección: {{$mailNuevoPedido['direccionFacturacion']->direccion}}</li>
        <li>Pais: {{$mailNuevoPedido['direccionFacturacion']->pais}}</li>
        <li>Ciudad: {{$mailNuevoPedido['direccionFacturacion']->ciudad}}</li>
        <li>Código Postal {{$mailNuevoPedido['direccionFacturacion']->cp}}</li>
        <li>Dirección 2 {{$mailNuevoPedido['direccionFacturacion']->otra_direccion}}</li>
        <li>Teléfono {{$mailNuevoPedido['direccionFacturacion']->telefono}}</li>
        <li>IVA de la empresa {{$mailNuevoPedido['direccionFacturacion']->iva}}</li>
        
    </ul>

    <p style="font-family: 'Gotham-Medium'; font-size: 14px; color: #666">
       Detalles del pedido
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
