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
     <tr>
       <td>
        <br>
       <td>
     </tr>
     <tr>
        <td>
          <select id='filtro' name='filtro'>
              <option value="1">Ver todo</option>
              <option value="2">Tickets Abierto</option>
              <option value="3">Tickets Pendientes</option>
              <option value="4">TIckets Cerrados</option>
          </select>         
        </td>
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



<div id="tabla">
<iframe src="http://localhost/bfExplorer-0.0.9.1/files/index.php" width="1500" height="500" align="center">

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
    <td>DIA - HORA DE CREACION</td>
    <td>ARCHIVO ADJUNTO</td>
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
      <td>{{$ticket->hora_inicio}}</td>
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
      <?php if($ticket->estado=='Abierto'){ ?>
        <a class="btn btn-success" href=" {{ URL::to('administrador/asignarsoporte?id='.$ticket->id_ticket) }} ">Asignar Sorporte</a>
        <?php }if($ticket->estado=='Pendiente'){ ?>
        <a class="btn btn-small btn-info" href=" {{ URL::to('administrador/asignarsoporte?id='.$ticket->id_ticket) }} ">Modificar</a>
        <?php } ?> 
      </td>
  </tr>
@endforeach
</table>
</div>
    <script "type/javascript">
    jQuery(document).ready(function() {
          
            $("#filtro").change(function(event) {
            var filtro = $("#filtro option:selected").val();  //obtenemos el valor de lo seleccionado

            //Por medio de AJAX consultamos la ruta creada en laravel llamada estados la cual recibe el id del país
            $.ajax({
                url: 'administrador/jsticketabierto',
                type: 'POST',
                data: 'filtro='+filtro, //enviamos el valor del filtro
                success : function(data){
                  // now you can show output in your modal 
                  $("#tabla").html(data); 
                },
                error: function(xhr, error) {
                   alert( "Ha ocurrido un error " + xhr.status + " " + error );
                }
            })            
        });

    });
  </script>

@stop


