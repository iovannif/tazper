<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

//framework, laravl
class Compra extends Model //este modelo, clase que hereda de la Class Model, de eloquent, db
{
    //registro
    protected $table='Compras';
    protected $primaryKey = 'Id_Com';
    protected $fillable=[ //sist
        'Id_Pag',
        'Com_Fe',
        'Com_Ho',
        'Com_Fac',
        
        'Id_Arq',        
        'Id_Suc',
        'Id_PtoExp',
        
        'Id_PedProv',
        'Id_OC',
        'Id_Prov',

        'Com_ConPag',
        'Com_MedPag',
        
        'Com_StExe',
        'Com_St5',
        'Com_St10',
        
        'Com_Total',
        
        'Com_Liq5',
        'Com_Liq10',
        'Com_TotIva',

        'Com_RegPor',
        'Com_RegUser'
    ];

    // public $timestamps = false;

    // por cada registro
    // public function pago(){
    //     return $this->hasOne('Tazper\Sucursal','Id_Pag','Id_Pag');
    // }
    public function arqueo(){
        return $this->belongsTo('Tazper\Arqueo','Id_Arq','Id_Arq');
    }
    public function sucursal(){
        return $this->belongsTo('Tazper\Sucursal','Id_Suc','Id_Suc');
    }
    public function pto_expedicion(){
        return $this->belongsTo('Tazper\PtoExpedicion','Id_PtoExp','Id_PtoExp');
    } 
    public function pedprov(){
        return $this->belongsTo('Tazper\ProveedorDetalle','Id_PedProv','Id_PedProv');
    }
    public function oc(){
        return $this->belongsTo('Tazper\OrdenCompra','Id_OC','Id_OC');
    } 
    public function proveedor(){
        return $this->belongsTo('Tazper\Proveedor','Id_Prov','Id_Prov');
    }            
    public function medio_pago(){
        return $this->belongsTo('Tazper\Medio_Pago','Id_MedPag','Id_MedPag');
    }
    public function compra_detalle(){
        return $this->hasOne('Tazper\CompraDetalle','Id_Com','Id_Com');
    } 
    //migration table, aca modelo
    //relaciones, entre modelos, modelos representan tablas, poo, clases
}