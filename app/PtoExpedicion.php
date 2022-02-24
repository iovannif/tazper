<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class PtoExpedicion extends Model
{
    protected $table='PtoExpedicion';
    protected $primaryKey='Id_PtoExp';    

    public function caja(){
        return $this->hasOne('Tazper\Caja','Id_PtoExp','Id_PtoExp');
    }
    public function sucursal(){
        return $this->belongsTo('Tazper\Sucurusal','Id_Suc','Id_Suc');
    }
    public function pedidoproveedor(){
        return $this->hasMany('Tazper\PedidoProveedor','Id_PtoExp','Id_PtoExp');
    }
    public function oc(){
        return $this->hasMany('Tazper\OrdenCompra','Id_PtoExp','Id_PtoExp'); //uno, este, tiene muchos
    } 
    public function compra(){
        return $this->hasMany('Tazper\Compra','Id_PtoExp','Id_PtoExp');
    }
    public function pedido_cliente(){
        return $this->hasMany('Tazper\PedidoCliente','Id_PtoExp','Id_PtoExp');
    }
    public function venta(){
        return $this->hasMany('Tazper\Venta','Id_PtoExp','Id_PtoExp');
    }
    public function timbrado(){
        return $this->hasMany('Tazper\Timbrado','Id_Timb','Id_Timb');
    }
}