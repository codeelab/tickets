<?php
class SoporteController extends BaseController{

	public function mostrarTickets(){
		//$tickets = Tickets::all();
        // obtenemos todos los tickets y los pasamos a la vista 
        $tickets = DB::table('view_cerrarticket')->where('soporte_id', Auth::user()->id)->get();
        $usuario_soporte = DB::table('tb_usuarios')->where('tipo_usuario', 'S')->get();
        return View::make('soporte.soporte', array('tickets' => $tickets,'usuario_soporte' => $usuario_soporte ));
	}


	public function cerrarTickets(){
		$id=$_GET['id'];
		$tickets = DB::table('view_cerrarticket')->where('id_tickets',$id)->get();
		$usuariosoportes = DB::table('tb_usuarios')->where('tipo_usuario','S')->get();
		$empresas = Empresa::all();
		$lineas = Linea::all();
		$soportes = Soporte::all();
		$soporteDetalles = SoporteDetalle::all();
		// obtenemos todas las empresas y lo pasamos a la vista o select
       return View::make('soporte.cierre', array('tickets'=>$tickets,'usuariosoportes'=>$usuariosoportes));
	}

	public function updateCierre(){
			$id=$_GET['id'];
			$tiempo_solucion=Input::get('tiempo_solucion');
			$detalle_solucion=Input::get('detalle_solucion');
			$estado=Input::get('estado');

			DB::table('tb_tickets')
            ->where('id_tickets', $id)
            ->update(array('tiempo_solucion' => $tiempo_solucion,'detalle_solucion' => $detalle_solucion,'estado' => $estado ));
		
		$tickets = DB::table('view_cerrarticket')->where('soporte_id', Auth::user()->id)->get();
        $usuario_soporte = DB::table('tb_usuarios')->where('tipo_usuario', 'S')->get();
		return View::make('soporte.soporte',array('tickets' => $tickets,'usuario_soporte' => $usuario_soporte ));
	}

}