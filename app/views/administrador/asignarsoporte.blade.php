@extends('plantillaInicioAdministrador')
@section('contenido')
<?php
$id=$_GET['id'];
 ?>
</br>
{{ Form::open(array('url' => 'administrador?id='.$id,'class'=>'form-horizontal')) }}
<input type="hidden" name="id" value="<?php echo $id;?>">
<input type="hidden" name="estado" value="Pendiente">

@foreach($tickets as $ticket)
  <div class="form-group">
  {{Form::label('fecha_hora','Fecha/Hora', array('class'=>'col-sm-2 from-control'))}}
    <div class="col-sm-10">
          {{$ticket->created_at}}
    </div>
  </div>
  <div class="form-group">
  {{Form::label('asunto','Asunto',array('class'=>'col-sm-2 from-control'))}}
  <div class="col-sm-10">
         {{$ticket->asunto}}
  </div>
  </div>

  <div class="form-group">
  {{Form::label('detalle','Detalle',array('class'=>'col-sm-2 from-control') )}}
    <div class="col-sm-10">
       {{$ticket->detalle}}
    </div>
  </div>


   <div class="form-group">
  {{Form::label('empresa','Empresa',array('class'=>'col-sm-2 from-control') )}}
    <div class="col-sm-10">
        {{$ticket->tb_empresa_id}}
    </div>
  </div>

  <div class="form-group">
  {{Form::label('linea','Linea de Negocio',array('class'=>'col-sm-2 from-control') )}}
    <div class="col-sm-10">
       {{$ticket->tb_linea_negocio_id_linea}}
    </div>
  </div>

  <div class="form-group">
  {{Form::label('tipo','Tipo de Soporte',array('class'=>'col-sm-2 from-control') )}}
    <div class="col-sm-10">
       {{$ticket->tipo_soporte}}
    </div>
  </div>

  <div class="form-group">
  {{Form::label('soporte','Soporte',array('class'=>'col-sm-2 from-control') )}}
    <div class="col-sm-10">
       {{$ticket->tb_soporte_detalle_tb_soporte_id_soporte_ti}}
    </div>
  </div>

  <div class="form-group">
  {{Form::label('Prioridad','Prioridad',array('class'=>'col-sm-2 from-control') )}}
    <div class="col-sm-10">
       {{$ticket->prioridad}}
    </div>
  </div>

  <div class="form-group">
  {{Form::label('ususoporte','Usuario Soporte',array('class'=>'col-sm-2 from-control'))}}
  <div class="col-sm-10">
          <select class="form-group" name="usuario_soporte">
            @foreach($usuariosoportes as $usuariosoporte)
              <option value="{{$usuariosoporte->id}}">{{$usuariosoporte->nombres}} </option>
            @endforeach
        </select>

  </div>
  </div>

<div class="form-group">
  {{Form::label('nivel_admin','Prioridad administrador',array('class'=>'col-sm-2 from-control') )}}
    <div class="col-sm-10">
        <select class="form-group" name="prioridad_admin">
              <option value="baja">baja</option>
              <option value="media">media</option>
              <option value="alta">alta</option>
        </select>
    </div>
  </div>

<div class="form-group">
  {{Form::submit('Grabar',array('class'=>'btn btn-success'))}}
  {{Form::submit('Cerrar Ticket',array('class'=>'btn btn-default'))}}
</div>


@endforeach
</br>
{{Form::close()}}

@stop