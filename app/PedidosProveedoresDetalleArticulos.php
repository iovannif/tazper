<?php
namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class PedidosProveedoresDetalleArticulos extends Model
{
    protected $table='PedidosProveedoresDetalleArticulos';
    protected $fillable=[
        "Id_PedProv",
        "Id_Art"
    ];  
    public $timestamps=false;   

    // public function pedprov_detalle(){        
    //     return $this->hasOne('Tazper\PedidosProveedoresDetalle','Id_PedProv','Id_PedProv');        
    // }
    // public function articulos(){        
    //     return $this->hasOne('Tazper\Articulo','Id_Art','Id_Art');    
    // } 
}