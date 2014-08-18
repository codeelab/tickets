
<!DOCTYPE html>
<html>
<head>
	<title>Administrador</title>
	<!--Icluimos el CSS de bootstrap y el CSS de la plantilla
	que usamos con los helpers de laravel-->
	{{HTML::style('css/bootstrap.min.css')}}
	{{HTML::style('css/jumbotron-narrow.css')}}
	{{HTML::style('css/main.css')}}
	{{ HTML::script('js/functions.js')}}
</head>
<body>
<div class="container">
	<div class="header">
		<ul class="nav nav-pills pull-right">
			<li>{{HTML::link('/administrador','Administrar')}}</li>
			<li>{{HTML::link('/administrador/nuevousuario','Nuevo Usuario')}}</li>
			<li>{{HTML::link('/login','Salir')}}</li>
		</ul>
		<h1 class="text-muted" >Administrador</h1>
	</div>	
	 @yield('contenido')
	 <!-- Aqui se incluiran los codigos de las vistas
	 que use cada metodo de los controladores -->
	 <div class="footer">
	 <p>&copy; 2014 - <?php echo date('Y') ?> by JALOPR ©Siglo Outsourcing.<?php echo "Todos los Derechos Reservados" ?></p>
	 </div>
</div>
	<!--Incluimos la libreria Jquery -->
	<script type="https://code.jquery.com/jquery.js"></script>
	<!--Incluimos el js de bootstrap con el Helper de laravel -->
		{{HTML::script('js/bootstrap.min.js')}}
</body>
</html>