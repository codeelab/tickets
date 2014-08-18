@extends('plantillaLogin')
@section('contenido')


<div class="jumbotron">
    <h1 >SOPORTE TI SISTEMA DE TICKETS</h1>
<P class="lead"> </P> 
@if (Session::has('mensaje_login'))
<!-- Mensaje de session -->
<span>{{ Session::get('mensaje_login') }}</span>
@endif

<table width="100%">
<tr>
<td width= "15%">
{{ Form::open(array('url' => 'login', 'class'=>'form-signup')) }}
<!-- <h2 class="form-signup-heading">Please Register</h2> -->
<div class="form-group">
        {{Form::label('dni','Dni :')}}
        {{Form::text('dni', Input::old('dni'), array('class'=>'form-control', 'placeholder'=>' DNI', 'autocomplete'=>'off'))}}    
</div>
<div class="form-group">
    {{ Form::label('password', 'Clave :') }} 
    {{ Form::password('password', array( 'placeholder'=>' Password', 'class'=>'form-control'))}}
</div>
    {{ Form::submit('Ingresar'); }}
    {{ Form::close() }}
</td>
<td width= "30%">
    </br>
</td>
<td width= "50%">
</div>
<img src="../imagenes/contacto.jpg" alt=" " class="img-rounded">
</td>
</tr>
  </table>
</div>



<!--
<h2>
  Registro
</h2>
@if (Session::has('mensaje_registro'))
<span>{{ Session::get('mensaje_registro') }}</span>
@endif
 <div class="row-fluid">
<div class="span6">
{{ Form::open(array('url' => 'registro')) }}

    @if (Session::get('mensaje'))
        <div class="alert alert-success">{{Session::get('mensaje')}} </div>
    @endif
    <div class="form-group">
    {{ Form::label('nombres', 'Nombres :'); }}
    {{ Form::text('nombres', Input::old('nombres'), array( 'placelholder'=>'Nombre Usuario' , 'autocomplete'=>'off')); }}
    </div>
    @if($errors->has('nombres'))
        <div class="alert alert-danger">
            @foreach($errors->get('nombres') as $error)
                       *{{$error}}</br>
            @endforeach
        </div>
    @endif
    <div class="form-group">
    {{ Form::label('apellido', 'Apellidos :'); }}
    {{ Form::text('apellidos'); }}
    </div>
    <div class="form-group">
    {{ Form::label('dni', 'DNI :'); }}
    {{ Form::text('dni'); }}
    </div>
    <div class="form-group">
    {{ Form::label('correo', 'Correo : '); }}
    {{ Form::text('correo',Input::old('correo'),array( 'placelholder'=>'Correo' , 'autocomplete'=>'off')); }}
    </div>
    <div class="form-group">
    {{ Form::label('tipo_usuario', 'Tipo de usuario : '); }}
    {{ Form::select('tipo_usuario', array('A' => 'Administrador', 'S' => 'Soporte', 'U' => 'Usuario')); }}
    </div>
     <div class="form-group">
    {{ Form::label('password', 'Clave: '); }} 
    {{ Form::password('password'); }}
    </div>
    {{ Form::submit('Registrar'); }}
-->
{{ Form::close() }}



@stop