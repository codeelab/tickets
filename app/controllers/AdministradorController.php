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


}