<?php
namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class PedidoProveedor extends Model
{
    protected $table='PedidosProveedores';
    protected $primaryKey = 'Id_PedProv';
    protected $fillable=[
        'Id_Suc',
        'Id_PtoExp',
        'PedProv_FeHo',
        'Id_Prov',
        'PedProv_FeEnt',
        'PedProv_ConPag',
        // 'PedProv_MedPag',
        'Id_MedPag',
        'PedProv_Est',
        'PedProv_Obs',

        'PedProv_RegPor',
        'PedProv_RegUser',
    ];

    public function sucursal(){
        return $this->belongsTo('Tazper\Sucursal','Id_Suc','Id_Suc');
    }
    public function pto_expedicion(){
        return $this->hasOne('Tazper\PtoExpedicion','Id_PtoExp','Id_PtoExp');
    } 
    public function proveedor(){
        return $this->belongsTo('Tazper\Proveedor','Id_Prov','Id_Prov');
    }  
    public function medio_pago(){
        return $this->belongsTo('Tazper\Medio_Pago','Id_MedPag','Id_MedPag');
    }
    public function oc(){
        return $this->hasOne('Tazper\OrdenCompra','Id_PedProv','Id_PedProv');
    }  
    public function pedprov_detalle(){
        return $this->hasOne('Tazper\PedidoProveedorDetalle','Id_PedProv','Id_PedProv');
    }    
    public function compra(){
        return $this->hasOne('Tazper\Compra','Id_PedProv','Id_PedProv');
    }
}