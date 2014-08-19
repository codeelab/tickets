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
<table class="table table-striped">
  <tr>
    <td># TICKET</td>
    <td>ASUNTO</td>
    <td>DETALLE</td> 
    <td>EMPRESA</td> 
    <td>TIPO DE SOPORTE</td> 
    <td>PRIORIDAD</td> 
    <td>ESTADO</td>
    <td>ARCHIVO ADJUNTO</td>
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
      <td><?php
          $directorio=opendir("./imagenes/".$ticket->id_ticket); //ruta actual
                            while($archivo= readdir($directorio)){
                                if(is_dir($archivo)){
                                     if($archivo <> "." and $archivo <> ".." ){
                                    echo "[".$archivo."]<br/>";
                                    }
                                }else{
                                    if($archivo <> "." and $archivo <> ".." ){
                                      echo ' <a href="./imagenes/'.$ticket->id_ticket.'/'.utf8_encode($archivo).'" TARGET="_blank">'.utf8_encode($archivo).'<br/></a>';
                                    }                                    
                                }
                            }
            ?>
      </td>
      <td>
      <?php
      if($ticket->estado == 'Cerrado'){
        echo "OK";
        }else{
          ?>
          <a class="btn btn-danger" href="{{URL::to('usuario/cerrarTicket?id='.$ticket->id_ticket)}} ">Cerrar</a>
          <?php
        }        
          ?>
      </td>
  </tr>
@endforeach
</table>

@stop