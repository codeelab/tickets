<?php
class UsuarioController extends BaseController{

	public function mostrarTickets(){
		//$tickets = Tickets::all();
        // obtenemos todos los tickets y los pasamos a la vista 

        $tickets = DB::table('view_tickets')->where('usuario', Auth::user()->id)->get();

        return View::make('usuario.usuario', array('tickets' => $tickets ));
	}


	public function cerrarTicket(){
		//$tickets = Tickets::all();
        // obtenemos todos los tickets y los pasamos a la vista
	     $id=$_GET['id'];
        DB::table('tb_tickets')
            ->where('id_tickets', $id)
            ->update(array('estado' => 'Cerrado'));

        $data=array(
            'ticket'=>'00011',
            'usuario'=>'usuario_prueba');

     /*    Mail::send('tmRegistroTicket', $data, function($message)
        {
           $message->to('jorge.lopez@gruposiglo.net')->subject('Nuevo ticket');
        });

         Mail::send('tmRegistroTicket', $data, function($message)
        {
           $message->to('soportetiperu@gruposiglo.net')->subject('Nuevo ticket');
        });
        */
                 echo "<script language='JavaScript'> 
                alert('Ticket Cerrado..!!');
            </script>";

        return Redirect::to('usuario');

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
       		if(Input::hasFile('archivo')) {
       			DB::table('tb_tickets')
            		->where('id_tickets', $maxs->id_tickets)
            		->update(array('archivo_adjunto' => '1'));
        	}
       	endforeach;

       	if(Input::hasFile('archivo')) {
        	$file = Input::file('archivo'); 
		      $filename = $file->getClientOriginalName();		
		      Input::file('archivo')->move('imagenes/'.$maxs->id_tickets,$filename);
    	   }

     /*   $data=array(
            'ticket'=>'00011',
            'usuario'=>'usuario_prueba');

         Mail::send('tmRegistroTicket', $data, function($message)
        {
           $message->to('jorge.lopez@gruposiglo.net')->subject('Nuevo ticket');
        });

         Mail::send('tmRegistroTicket', $data, function($message)
        {
           $message->to('soportetiperu@gruposiglo.net')->subject('Nuevo ticket');
        }); */

         echo "<script language='JavaScript'> 
                alert('Ticket Creado..!!,');
              </script>";

        return Redirect::to('usuario');      
    }

}