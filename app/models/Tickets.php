<?php


Class Tickets extends Eloquent {
 
    protected $table = 'tb_tickets';

    protected $fillable = array('fecha_emision', 'hora_emision', 'prioridad','asunto','tb_linea_negocio_id_linea','tb_empresa_id','tb_soporte_detalle_tb_soporte_id_soporte_ti','tb_soporte_detalle_id_soporte_detalle','detalle','tb_usuarios_id','estado');
    
    public static function agregarNuevoTicket($input){
        // función que recibe como parámetro la información del formulario para crear el Vendedor
        $respuesta = array();
        $ticket = static::create($input); 
        return $respuesta; 
      }
}
