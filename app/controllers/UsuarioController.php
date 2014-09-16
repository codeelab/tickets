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

      $results = DB::select('select * from tb_tickets where id_tickets = ?', array($id));



      foreach($results as $result):
          $ticket=$result->id_tickets;
          $asunto=$result->asunto;
          $tipo_soporte=$result->tb_soporte_detalle_tb_soporte_id_soporte_ti;
          $id_usuario=$result->tb_usuarios_id;
      endforeach; // datos que van al correo

      $usuario = DB::select('select * from tb_usuarios where id = ?', array($id_usuario));

      foreach($usuario as $usuarios):
          $usuario_ticket=$usuarios->nombres." ".$usuarios->apellidos;
      endforeach; // usuario que creo el ticket

      $data=array(
            'ticket'=>$ticket,
            'usuario'=>Auth::user()->nombres.' '.Auth::user()->apellidos,
            'asunto'=>$asunto,
            'usuario_ticket'=>$usuario_ticket);
     

        Mail::send('tmCierreTicketUsuario', $data, function($message)
        {
           $message->to(Auth::user()->correo)->subject('Ticket Cerrado '.Auth::user()->nombres.' '.Auth::user()->apellidos);
        }); // envia correo al usuario que cerro el ticket

         if($tipo_soporte='1'){
                 Mail::send('tmCierreTicketUsuario', $data, function($message)
              {
                $message->to('soportesistemasperu@gruposiglo.net')->subject('Ticket Cerrado'.Auth::user()->nombres.' '.Auth::user()->apellidos);
             }); // manda correo a soreporte de sistemas -- Hector y/o Olga
         }else{
                  Mail::send('tmCierreTicketUsuario', $data, function($message)
                {
                  $message->to('soportetiperu@gruposiglo.net')->subject('Ticket Cerrado '.Auth::user()->nombres.' '.Auth::user()->apellidos);
               }); // manda correo a soporte de sistemas --Elizabhet --
         }

         echo "<script language='JavaScript'> 
             alert('Ticket Cerrado..!!');
           </script>";

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
       		if(Input::hasFile('archivo')) {
       			DB::table('tb_tickets')
            		->where('id_tickets', $maxs->id_tickets)
            		->update(array('archivo_adjunto' => '1'));
        	}
       	endforeach;

         $ticket_creado=$maxs->id_tickets;
       	if(Input::hasFile('archivo')) {
        	$file = Input::file('archivo'); 
		      $filename = $file->getClientOriginalName();		
		      Input::file('archivo')->move('imagenes/'.$maxs->id_tickets,$filename);         
    	   }

        $input = Input::all();
        $data=array(
            'ticket'=>$ticket_creado,
            'usuario'=>Auth::user()->nombres.' '.Auth::user()->apellidos,
            'asunto'=>$input['asunto']);

        Mail::send('tmRegistroTicket', $data, function($message)
        {
           $message->to(Auth::user()->correo)->subject('Nuevo ticket '.Auth::user()->nombres.' '.Auth::user()->apellidos);
        }); 

         if($input['tb_soporte_detalle_tb_soporte_id_soporte_ti']='1'){
                 Mail::send('tmRegistroTicket', $data, function($message)
              {
                $message->to('soportesistemasperu@gruposiglo.net')->subject('Nuevo ticket '.Auth::user()->nombres.' '.Auth::user()->apellidos);
             });
         }else{
                  Mail::send('tmRegistroTicket', $data, function($message)
                {
                  $message->to('soportetiperu@gruposiglo.net')->subject('Nuevo ticket '.Auth::user()->nombres.' '.Auth::user()->apellidos);
               });
         }

     echo "<script language='JavaScript'> 
            alert('Ticket Creado..!!');
            </script>";

      $tickets = DB::table('view_tickets')->where('usuario', Auth::user()->id)->get();

        
        return View::make('usuario.usuario', array('tickets' => $tickets ));

    }

}