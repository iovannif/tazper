<?php

namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class Medio_Pago extends Model
{
    protected $table='Medio_Pago';
    protected $primaryKey = 'Id_MedPag';
    public $timestamps = false;

    public function pedido_proveedor(){
        return $this->hasMany('Tazper\PedidoProveedor','Id_MedPag','Id_MedPag');
    }
    public function compra(){
        return $this->hasMany('Tazper\Compra','Id_MedPag','Id_MedPag');
    }
    public function pedido_cliente(){
        return $this->hasMany('Tazper\PedidoCliente','Id_MedPag','Id_MedPag');
    }
    public function venta(){
        return $this->hasMany('Tazper\Venta','Id_MedPag','Id_MedPag');
    }
}