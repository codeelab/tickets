<?php
class UsuarioController extends BaseController{

	public function mostrarTickets(){
		//$tickets = Tickets::all();
        // obtenemos todos los tickets y los pasamos a la vista 
        $tickets = DB::table('view_tickets')->where('usuario', Auth::user()->id)->get();
        return View::make('usuario.usuario', array('tickets' => $tickets ));
	}



	public function mostrarNuevo(){
		
		$empresas = Empresa::all();
		$lineas = Linea::all();
		$soportes = Soporte::all();
		$soporteDetalles = SoporteDetalle::all();

		// obtenemos todas las empresas y lo pasamos a la vista o select 
       return View::make('usuario.nuevo', array('empresas'=>$empresas,'lineas'=>$lineas,'soportes'=>$soportes,'soporteDetalles'=>$soporteDetalles));
	}


	public function mostrarCambiarClave(){
		
		$empresas = Empresa::all();
		$lineas = Linea::all();
		$soportes = Soporte::all();
		$soporteDetalles = SoporteDetalle::all();

		// obtenemos todas las empresas y lo pasamos a la vista o select 
       return View::make('usuario.cambiarclave', array('empresas'=>$empresas,'lineas'=>$lineas,'soportes'=>$soportes,'soporteDetalles'=>$soporteDetalles));
	}

	public function crearTicket(){
 
        $respuesta = Tickets::agregarNuevoTicket(Input::all());

        $max = DB::table('tb_tickets')
                     ->select(DB::raw('max(id_tickets) as id_tickets'))                  
                     ->get();    
       foreach($max as $maxs):
       	mkdir("imagenes/".$maxs->id_tickets);
       	endforeach;

       	if(Input::hasFile('archivo')) {
    	$file = Input::file('archivo'); 
		$filename = $file->getClientOriginalName();
		
		Input::file('archivo')->move('imagenes/'.$maxs->id_tickets,$filename);
    	}


        return Redirect::to('usuario');      
    }

}