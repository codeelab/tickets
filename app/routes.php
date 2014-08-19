<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
Route::get('/', function()
{
	return View::make('hello');
});

*/

// esta sera la ruta principal de nuestra aplicación
// aquí va a estar el formulario para registrase y para inicio de sesión
// esta ruta debe ser publica y por lo tanto no debe llegar el filtro auth

Route::get('login', function(){
    return View::make('login'); 
});
 
// esta ruta sera para crear al usuario 
Route::post('registro', function(){
 
    $input = Input::all();
    
    // al momento de crear el usuario la clave debe ser encriptada
    // para utilizamos la función estática make de la clase Hash
    // esta función encripta el texto para que sea almacenado de manera segura
    $input['password'] = Hash::make($input['password']);
 
    Usuarios::create($input);
 
    return Redirect::to('administrador')->with('mensaje_registro', 'Usuario Registrado');
});
 
// esta ruta servirá para iniciar la sesión por medio del correo y la clave 
// para esto utilizamos la función estática attemp de la clase Auth
// esta función recibe como parámetro un arreglo con el correo y la clave

Route::post('login', function(){
 
    // la función attempt se encarga automáticamente se hacer la encriptación de la clave para ser comparada con la que esta en la base de datos. 

    if (Auth::attempt( array('dni' => Input::get('dni'), 'password' => Input::get('password') ), true )){
        return Redirect::to('inicio');
    }else{
        return Redirect::to('login')->with('mensaje_login', 'Ingreso invalido');
    }
 
});
 
// Por ultimo crearemos un grupo con el filtro auth. 
// Para todas estas rutas el usuario debe haber iniciado sesión. 
// En caso de que se intente entrar y el usuario haya iniciado session 
// entonces sera redirigido a la ruta login
Route::group(array('before' => 'auth'), function()
{
    
    Route::get('inicio', function(){
        
        if(Auth::user()->tipo_usuario == "A"){
            //Lleva al menu de administrador
            return Redirect::to('administrador');
            
        }else if(Auth::user()->tipo_usuario == "U"){
            //Lleva al menu de usuario
            return Redirect::to('usuario');
        }else if(Auth::user()->tipo_usuario == "S"){
            //Lleva al menu de soporte
            return Redirect::to('soporte');
        }


        // Con la función Auth::user() podemos obtener cualquier dato del usuario 
        // que este en la sesión, en este caso usamos su correo y su id
        // Esta función esta disponible en cualquier parte del código
        // siempre y cuando haya un usuario con sesión iniciada
        echo 'Bienvenido '. Auth::user()->correo . ', su Id es: '.Auth::user()->id. 'Tipo de Usuario: '. Auth::user()->tipo_usuario;
        
    });
});


Route::get('administrador','AdministradorController@mostrarTickets');
Route::get('administrador/reporte','AdministradorController@mostrarReportes');
Route::get('administrador/nuevousuario','AdministradorController@mostrarNuevo');
Route::get('administrador/asignarsoporte','AdministradorController@mostrarAsignar');
Route::post('administrador','AdministradorController@updateTicket');



Route::get('soporte','SoporteController@mostrarTickets');
Route::get('soporte/cierre','SoporteController@cerrarTickets');
Route::post('soporte','SoporteController@updateCierre');


Route::get('usuario', 'UsuarioController@mostrarTickets');
Route::get('usuario/nuevo', 'UsuarioController@mostrarNuevo');
Route::get('usuario/cambiarclave', 'UsuarioController@mostrarCambiarClave');
Route::post('usuario', 'UsuarioController@crearTicket');
Route::get('usuario/cerrarTicket', 'UsuarioController@cerrarTicket');

Route::POST('usuario/jsoportedetalle', function(){

  if(Request::ajax()){
      $id_soporte = e(Input::get('id_soporte'));
      return ListaSoporteDetalle::where('tb_soporte_id_soporte_ti','=', $id_soporte)->get();
  }
});


