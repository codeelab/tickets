@extends('plantillaInicioSoporte')
@section('contenido')
</br>
<div class="row marketing">
 <div class="row">
    <div class="col-xs-6 col-md-4">
    <table>
  	 <tr>
  		  <td width="45%">{{Form::text('buscar',Input::old('buscar'),array('class'=>'form-control'))}}</td>
  		  <td width="3%"> </td>
  		  <td width="45%">{{Form::submit('Buscar',array('class'=>'btn btn-default'))}}</td> 
  	 </tr>
    </table>
    </div>
  </br>
  <!-- Listamos los tickets del usuario -->
  </div> 
</div>
</br>
</br>
</br>
@if (Session::has('mensaje_registro'))
<span>{{ Session::get('mensaje_registro') }}</span>
@endif
<table class="table table-striped">
  <tr>
    <td># TICKET</td>
    <td>USUARIO </td>
    <td>ASUNTO</td>
    <td>DETALLE</td>
    <td>EMPRESA</td> 
    <td>TIPO DE SOPORTE</td> 
    <td>PRIORIDAD</td> 
    <td>ESTADO</td>
    <td>TIEMPO DE SOLUCION (horas)</td>
    <td>DETALLE DE LA SOLUCION</td>
    <td></td> 
  </tr>
{{Form::open(array('url' => 'soporte'))}}
@foreach($tickets as $ticket)
  <tr>
      <td>{{$ticket->id_tickets}}</td>
      <td>{{$ticket->usuario_soporte}}</td>
      <td>{{$ticket->asunto}}</td>
      <td>{{$ticket->detalle}}</td>
      <td>{{$ticket->tb_empresa_id}}</td>
      <td>{{$ticket->tipo_soporte}}</td>
      <td>{{$ticket->prioridad}}</td>
      <td>{{$ticket->estado}}</td>
      <td>{{$ticket->tiempo_solucion}}</td>
      <td>{{$ticket->detalle_solucion}}</td>
      <td>
          <?php
            if($ticket->estado=='Cerrado'){
            ?>
            <?php
            }else{ ?>
              <a class="btn btn-success" href=" {{ URL::to('soporte/cierre?id='.$ticket->id_tickets) }} ">Cerrar</a>
            <?php
            }
          ?>
      </td>
  </tr>
@endforeach
</table>
@stop