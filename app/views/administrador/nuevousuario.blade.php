@extends('plantillaInicioAdministrador')
@section('contenido')

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

@stop