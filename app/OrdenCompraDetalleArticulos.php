<?php

namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class OrdenCompraDetalleArticulos extends Model
{
    protected $table='OrdenCompraDetalle_Articulos';
    protected $fillable=[
        "Id_OC",
        "Id_Art"
    ]; 
    public $timestamps = false;    
}
