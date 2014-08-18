@extends('plantillaInicioAdministrador')
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
<table class="table table-bordered table-hover table-striped tablesorter">
  <tr class="header headerSortUp ">
    <td># TICKET</td>
    <td>USUARIO</td>
    <td>ASUNTO</td>
    <td>DETALLE</td> 
    <td>EMPRESA</td> 
    <td>TIPO DE SOPORTE</td> 
    <td>PRIORIDAD</td> 
    <td>ESTADO</td>
    <td>SOPORTE TI</td>
    <td></td>
  </tr>
{{ Form::open(array('url' => 'administrador/asignarsoporte')) }}
@foreach($tickets as $ticket)
  <tr>
      <td>{{$ticket->id_ticket}}</td>
      <td>{{$ticket->usuario}}</td>
      <td>{{$ticket->asunto}}</td>
      <td>{{$ticket->detalle}}</td>
      <td>{{$ticket->empresa}}</td>
      <td>{{$ticket->tipo_soporte}}</td>
      <td>{{$ticket->prioridad}}</td>
      <td>{{$ticket->estado}}</td>
      <td>{{$ticket->usuario_soporte}}</td>
      <td>
      <?php if($ticket->estado=='Abierto'){ ?>
        <a class="btn btn-success" href=" {{ URL::to('administrador/asignarsoporte?id='.$ticket->id_ticket) }} ">Asignar Sorporte</a>
        <?php }if($ticket->estado=='Pendiente'){ ?>
        <a class="btn btn-small btn-info" href=" {{ URL::to('administrador/asignarsoporte?id='.$ticket->id_ticket) }} ">Modificar</a>
        <?php } ?> 
      </td>
  </tr>
@endforeach
</table>
@stop