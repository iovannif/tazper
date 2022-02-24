<?php
namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class ProduccionDetalleArticulos extends Model
{
    protected $table='ProduccionDetalleArticulos';
    protected $fillable=[
        "Id_Pdc",
        "Id_Art"
    ];  
    public $timestamps=false;   

    // public function produccion_detalle(){        
    //     return $this->hasOne('Tazper\ProduccionDetalle','Id_Pdc','Id_Pdc');        
    // }
    // public function articulos(){        
    //     return $this->hasOne('Tazper\Articulo','Id_Art','Id_Art');    
    // }
}