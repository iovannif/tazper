<?php

namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class PedidoClienteDetalleArticulos extends Model
{
    protected $table='PedidosClientesDetalle_Articulos';
    protected $fillable=[
        "Id_PedCli",
        "Id_Art"
    ];  
    public $timestamps=false;   

    //rel art en ped det
}