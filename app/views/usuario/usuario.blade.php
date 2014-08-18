@extends('plantillaInicioUsuario')
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
{{ Form::open(array('url' => '/usuario/cerrarTicket','class'=>'form-horizontal')) }}
<table class="table table-striped">
  <tr>
    <td># TICKET</td>
    <td>ASUNTO</td>
    <td>DETALLE</td> 
    <td>EMPRESA</td> 
    <td>TIPO DE SOPORTE</td> 
    <td>PRIORIDAD</td> 
    <td>ESTADO</td>
    <td></td>
  </tr>

@foreach($tickets as $ticket)
  <tr>
      <td>{{$ticket->id_ticket}}</td>
      <td>{{$ticket->asunto}}</td>
      <td>{{$ticket->detalle}}</td>
      <td>{{$ticket->empresa}}</td>
      <td>{{$ticket->tipo_soporte}}</td>
      <td>{{$ticket->prioridad}}</td>      
      <td>{{$ticket->estado}}</td>
      <td>
        <button type="submit" class="btn btn-danger">Peligro</button>
      </td>
  </tr>
@endforeach
</table>

{{ Form::close() }}
@stop