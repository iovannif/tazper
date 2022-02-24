<?php
namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class CompraDetalleArticulos extends Model
{
    protected $table='ComprasDetalleArticulos';
    protected $fillable=[
        "Id_Com",
        "Id_Art"
    ]; 
    public $timestamps = false;

    // public function produccion_detalle(){        
    //     return $this->hasOne('Tazper\PedidosProveedoresDetalle','Id_PedProv','Id_PedProv');        
    // }
    // public function articulos(){        
    //     return $this->hasOne('Tazper\Articulo','Id_Art','Id_Art');    
    // } 
}