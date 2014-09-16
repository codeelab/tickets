<?php
class AdministradorController extends BaseController{

	public function mostrarTickets(){
		//$tickets = Tickets::all();
        // obtenemos todos los tickets y los pasamos a la vista 
        $tickets = DB::table('view_ticketsAdministrador')->get();
        $usuario_soporte = DB::table('tb_usuarios')->where('tipo_usuario', 'S')->get();
        return View::make('administrador.administrador', array('tickets' => $tickets,'usuario_soporte' => $usuario_soporte ));
	}


	public function mostrarNuevo(){
		
		$empresas = Empresa::all();
		$lineas = Linea::all();
		$soportes = Soporte::all();
		$soporteDetalles = SoporteDetalle::all();

		// obtenemos todas las empresas y lo pasamos a la vista o select 
       return View::make('administrador.nuevousuario', array('empresas'=>$empresas,'lineas'=>$lineas,'soportes'=>$soportes,'soporteDetalles'=>$soporteDetalles));
	}

	public function mostrarAsignar(){
		$id=$_GET['id'];
		$tickets = DB::table('view_asignarsoporte')->where('id_tickets',$id)->get();
		$usuariosoportes = DB::table('tb_usuarios')->where('tipo_usuario','S')->get();
		$empresas = Empresa::all();
		$lineas = Linea::all();
		$soportes = Soporte::all();
		$soporteDetalles = SoporteDetalle::all();
		// obtenemos todas las empresas y lo pasamos a la vista o select
       return View::make('administrador.asignarsoporte', array('tickets'=>$tickets,'usuariosoportes'=>$usuariosoportes));
	}

	public function updateTicket(){
			$id=$_GET['id'];
			$usuario_soporte=Input::get('usuario_soporte');
			$prioridad_admin=Input::get('prioridad_admin');
			$estado=Input::get('estado');

			DB::table('tb_tickets')
            ->where('id_tickets', $id)
            ->update(array('usuario_soporte' => $usuario_soporte,'prioridad_admin' => $prioridad_admin,'estado' => $estado ));
		
		$tickets = DB::table('view_ticketsAdministrador')->get();
        $usuario_soporte = DB::table('tb_usuarios')->where('tipo_usuario', 'S')->get();
		return View::make('administrador.administrador',array('tickets' => $tickets,'usuario_soporte' => $usuario_soporte ));
	}

	public function crearTicket(){
        $respuesta = Tickets::agregarNuevoTicket(Input::all());
        return Redirect::to('usuario');
    }


    public function mostrarReportes() {

    }


    public function jsticketabierto() {
    	if(Request::ajax()){
     		$filtro = e(Input::get('filtro'));
     		
     		switch ($filtro) {
    			case 1:
    				$tickets = DB::table('view_ticketsAdministrador')->get();
    			    $html='<table class="table table-bordered table-hover table-striped tablesorter">
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
 								</tr>';
    					foreach ($tickets as $ticket ) {
    						$html=$html.'<tr>
    								<td>'.$ticket->id_ticket.'</td>
    								<td>'.$ticket->usuario.'</td>
    								<td>'.$ticket->asunto.'</td>
    								<td>'.$ticket->detalle.'</td>
    								<td>'.$ticket->empresa.'</td>
    								<td>'.$ticket->tipo_soporte.'</td>
    								<td>'.$ticket->prioridad.'</td>
    								<td>'.$ticket->estado.'</td>
    								<td>'.$ticket->usuario_soporte.'</td>
    								<td>'.$ticket->hora_inicio.'</td>
    								<td>
    								';

									$directorio=opendir("./imagenes/".$ticket->id_ticket); //ruta actual
                            			while($archivo= readdir($directorio)){
                            		 	   if(is_dir($archivo)){
                            		 	        if($archivo <> "." and $archivo <> ".." ){                             	
                            		 	       }
                            		 	   }else{
                            		 	       if($archivo <> "." and $archivo <> ".." ){
                            		 	        $html=$html.'<a href="./imagenes/'.$ticket->id_ticket.'/'.utf8_encode($archivo).'" TARGET="_blank">'.utf8_encode($archivo).'<br/></a>';
                            		 	       }                                    
                            		  	  }
                            		}
                            		$html=$html.'</td>
                            		<td>';
										if($ticket->estado=='Abierto'){ 
										     $html=$html.'<a class="btn btn-success" href="administrador/asignarsoporte?id='.$ticket->id_ticket.'" >Asignar Sorporte</a>';
										  }if($ticket->estado=='Pendiente'){ 
										        $html=$html.'<a class="btn btn-small btn-info" href="administrador/asignarsoporte?id='.$ticket->id_ticket.'">Modificar</a>';
										    }
									$html=$html.'</td>
												</tr>';
    						}
    					$html=$html.'</table>';
    			    break;
    			case 2:
    				$tickets_abiertos = DB::table('view_ticketsAdministrador')->where('estado', 'Abierto')->get();
    				$html='<table class="table table-bordered table-hover table-striped tablesorter">
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
 							<FORM action="http://algunsitio.com/prog/usuarionuevo" method="post">';
    					foreach ($tickets_abiertos as $ticket ) {
    						$html=$html.'<tr>
    								<td>'.$ticket->id_ticket.'</td>
    								<td>'.$ticket->usuario.'</td>
    								<td>'.$ticket->asunto.'</td>
    								<td>'.$ticket->detalle.'</td>
    								<td>'.$ticket->empresa.'</td>
    								<td>'.$ticket->tipo_soporte.'</td>
    								<td>'.$ticket->prioridad.'</td>
    								<td>'.$ticket->estado.'</td>
    								<td>'.$ticket->usuario_soporte.'</td>
    								<td>'.$ticket->hora_inicio.'</td>
    								<td>
    								';

									$directorio=opendir("./imagenes/".$ticket->id_ticket); //ruta actual
                            			while($archivo= readdir($directorio)){
                            		 	   if(is_dir($archivo)){
                            		 	        if($archivo <> "." and $archivo <> ".." ){                             	
                            		 	       }
                            		 	   }else{
                            		 	       if($archivo <> "." and $archivo <> ".." ){
                            		 	        $html=$html.'<a href="./imagenes/'.$ticket->id_ticket.'/'.utf8_encode($archivo).'" TARGET="_blank">'.utf8_encode($archivo).'<br/></a>';
                            		 	       }                                    
                            		  	  }
                            		}
                            		$html=$html.'</td>
                            		<td>
                            		 <a class="btn btn-success" href="administrador/asignarsoporte?id='.$ticket->id_ticket.'" >Asignar Sorporte</a>
                            		</td>
    								</tr>';
    						}
    					$html=$html.
    					' </table>
						</FORM>';
    			    break;
    			case 3:
    			    $tickets_abiertos = DB::table('view_ticketsAdministrador')->where('estado', 'Pendiente')->get();
    				$html='<table class="table table-bordered table-hover table-striped tablesorter">
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
 								</tr>';
    					foreach ($tickets_abiertos as $ticket ) {
    						$html=$html.'<tr>
    								<td>'.$ticket->id_ticket.'</td>
    								<td>'.$ticket->usuario.'</td>
    								<td>'.$ticket->asunto.'</td>
    								<td>'.$ticket->detalle.'</td>
    								<td>'.$ticket->empresa.'</td>
    								<td>'.$ticket->tipo_soporte.'</td>
    								<td>'.$ticket->prioridad.'</td>
    								<td>'.$ticket->estado.'</td>
    								<td>'.$ticket->usuario_soporte.'</td>
    								<td>'.$ticket->hora_inicio.'</td>
    								<td>
    								';
									$directorio=opendir("./imagenes/".$ticket->id_ticket); //ruta actual
                            			while($archivo= readdir($directorio)){
                            		 	   if(is_dir($archivo)){
                            		 	        if($archivo <> "." and $archivo <> ".." ){                             	
                            		 	       }
                            		 	   }else{
                            		 	       if($archivo <> "." and $archivo <> ".." ){
                            		 	        $html=$html.'<a href="./imagenes/'.$ticket->id_ticket.'/'.utf8_encode($archivo).'" TARGET="_blank">'.utf8_encode($archivo).'<br/></a>';
                            		 	       }                                    
                            		  	  }
                            		}
                            		$html=$html.'</td>
                            		<td>
                            		 <a class="btn btn-small btn-info" href="administrador/asignarsoporte?id='.$ticket->id_ticket.'">Modificar</a>
                            		</td>
    								</tr>';
    						}
    					$html=$html.
    					' </table>
						';
    			    break;
    			case 4:
    			    $tickets_abiertos = DB::table('view_ticketsAdministrador')->where('estado', 'Pendiente')->get();
    				$html='<table class="table table-bordered table-hover table-striped tablesorter">
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
 							<FORM action="http://algunsitio.com/prog/usuarionuevo" method="post">';
    					foreach ($tickets_abiertos as $ticket ) {
    						$html=$html.'<tr>
    								<td>'.$ticket->id_ticket.'</td>
    								<td>'.$ticket->usuario.'</td>
    								<td>'.$ticket->asunto.'</td>
    								<td>'.$ticket->detalle.'</td>
    								<td>'.$ticket->empresa.'</td>
    								<td>'.$ticket->tipo_soporte.'</td>
    								<td>'.$ticket->prioridad.'</td>
    								<td>'.$ticket->estado.'</td>
    								<td>'.$ticket->usuario_soporte.'</td>
    								<td>'.$ticket->hora_inicio.'</td>
    								<td>
    								';
									$directorio=opendir("./imagenes/".$ticket->id_ticket); //ruta actual
                            			while($archivo= readdir($directorio)){
                            		 	   if(is_dir($archivo)){
                            		 	        if($archivo <> "." and $archivo <> ".." ){                             	
                            		 	       }
                            		 	   }else{
                            		 	       if($archivo <> "." and $archivo <> ".." ){
                            		 	        $html=$html.'<a href="./imagenes/'.$ticket->id_ticket.'/'.utf8_encode($archivo).'" TARGET="_blank">'.utf8_encode($archivo).'<br/></a>';
                            		 	       }                                    
                            		  	  }
                            		}
                            		$html=$html.'</td>
                            		<td>                            		 
                            		</td>
    								</tr>';
    						}
    					$html=$html.
    					' </table>
						</FORM>';
    			    break;
			}
     		return $html;
    	}
    }

}