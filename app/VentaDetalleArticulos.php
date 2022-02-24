<?php

namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class VentaDetalleArticulos extends Model
{
    protected $table='VentasDetalle_Articulos';
    protected $fillable=[
        "Id_Ven",
        "Id_Art"
    ]; 
    public $timestamps = false;
}
