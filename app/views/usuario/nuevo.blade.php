@extends('plantillaInicioUsuario')
@section('contenido')

</br>

{{ Form::open(array('url' => '/usuario','class'=>'form-horizontal','enctype'=>'multipart/form-data')) }}

         <input type="hidden" name="tb_usuarios_id" value="<?php echo Auth::user()->id;?>">
         <input type="hidden" name="fecha_emision" value="<?php echo date("d/m/Y");?>">
         <input type="hidden" name="hora_emision" value="<?php echo date("H:i:s");?>">
         <input type="hidden" name="estado" value="Abierto">
          {{Form::label('fecha','Fecha')}}
              <?php echo ": ".date("d/m/Y"); ?>
          {{Form::label('hora','Hora')}}
            <?php echo ": ".date("H:i:s");?>

  <div class="form-group">
  {{Form::label('empresa','Empresa', array('class'=>'col-sm-2 from-control'))}}
    <div class="col-sm-10">
        <select class="form-group" name="tb_empresa_id">
            @foreach($empresas as $empresa)
              <option value="{{$empresa->id_empresa}}">{{$empresa->nombre_empresa}} </option>
            @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
  {{Form::label('linea','Linea de Negocio',array('class'=>'col-sm-2 from-control'))}}
  <div class="col-sm-10">
          <select class="form-group" name="tb_linea_negocio_id_linea">
            @foreach($lineas as $linea)
              <option value="{{$linea->id_linea}}">{{$linea->nombre_linea}} </option>
            @endforeach
        </select>
  </div>
  </div>
  <div class="form-group">
  {{Form::label('tipo_soporte','Tipo de Soporte',array('class'=>'col-sm-2 from-control') )}}
    <div class="col-sm-10">
        <select class="form-group" name="tb_soporte_detalle_tb_soporte_id_soporte_ti" id="tb_soporte_detalle_tb_soporte_id_soporte_ti">
        <option value="00">Seleccionar</option>
            @foreach($soportes as $soporte)
              <option value="{{$soporte->id_soporte}}">{{$soporte->tipo_soporte}} </option>
            @endforeach
        </select>
    </div>
  </div>


   <div class="form-group">
  {{Form::label('soporte','Soporte',array('class'=>'col-sm-2 from-control') )}}
    <div class="col-sm-10">
        <select class="form-group" name="tb_soporte_detalle_id_soporte_detalle" id="tb_soporte_detalle_id_soporte_detalle">
        <option value="00">Seleccionar</option>
        </select>
    </div>
  </div>

  <div class="form-group">
  {{Form::label('Nivel','Prioridad',array('class'=>'col-sm-2 from-control') )}}
    <div class="col-sm-10">
        <select class="form-group" name="prioridad">
              <option value="baja">baja</option>
              <option value="media">media</option>
              <option value="alta">alta</option>
        </select>
    </div>
  </div>


  <div class="form-group">
  {{Form::label('Asunto','Asunto',array('class'=>'col-sm-2 from-control'))}}
    <div class="col-sm-10">
   {{ Form::text('asunto')}}
    </div>
  </div>

   <div class="form-group">    
    {{Form::label('Archivo','Archivo',array('class'=>'col-sm-2 from-control'))}}
      {{ Form::file('archivo') }}
  </div>

  <div class="form-group">
  {{Form::label('descripcion','Descripcion',array('class'=>'col-sm-2 from-control'))}}
   <div class="col-sm-2">
     {{ Form::textarea('detalle')}}
    </div>
  </div>
<div class="form-group">
  {{Form::submit('Grabar',array('class'=>'btn btn-success'))}}
</div>
</br>
{{ Form::close() }}

<script src="../js/jquery-2.0.3.min.js"></script>
    
    <script "type/javascript">
    jQuery(document).ready(function() {
          
            $("#tb_soporte_detalle_tb_soporte_id_soporte_ti").change(function(event) {
            var id_soporte = $("#tb_soporte_detalle_tb_soporte_id_soporte_ti option:selected").val();  //obtenemos el id del pais que se mantiene seleccionado
            
            //Por medio de AJAX consultamos la ruta creada en laravel llamada estados la cual recibe el id del país
            $.ajax({
                url: 'jsoportedetalle',
                type: 'POST',
                data: 'id_soporte='+id_soporte, //enviamos el id
                dataType: "json",
                success: function(tb_detalle){
                    $('select#tb_soporte_detalle_id_soporte_detalle').html('');
                    $('select#tb_soporte_detalle_id_soporte_detalle').append($('<option value="00"></option>').text('Seleccionar').val('')); 
                    //recorremos con el metodo each el objeto
                    $.each(tb_detalle, function(i) {
                        //Con los parametros que recibimos en nuestro objeto estado creamos las opciones
                        $('select#tb_soporte_detalle_id_soporte_detalle').append("<option value=\""+tb_detalle[i].id_soporte_detalle+"\">"+tb_detalle[i].detalle_soporte+"<\/option>");
                        // estado[i].id = Contiene el id del estado
                        // estado[i].estados = Contiene el nombre del estado
                    });
                }
            })            
        });

});
  
    </script>

@stop