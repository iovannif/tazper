<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    protected $table='OrdenCompra';
    protected $primaryKey = 'Id_OC';
    protected $fillable=[
        "Id_PedProv",
        "Id_Prov",        
        "OC_Fe",        
        "OC_CliNum",
        "Id_Suc",        
        "Id_PtoExp", 

        "OC_MedEnv",
        "OC_FOB",
        "OC_CondEnv",
        "OC_FeEnt",
        "OC_Obs",
        
        "OC_SubTot",
        "OC_Iva",
        "OC_Env",
        "OC_Otr",
        "OC_Tot",
        "OC_Est",

        "OC_RegPor",
        "OC_RegUser",
        "OC_MdfPor",
        "OC_MdfUser",

        // "OC_EmpProv",
        // "OC_EmpDir",
        // "OC_EmpTel",
        // "OC_EmpWeb",

        // "OC_Fecha",
        // "OC_NumOrd",
        // "OC_CliNum",
                
        // "OC_VenEmp",
        // "OC_VenDep",
        // "OC_VenDir",
        // "OC_VenTel",
        // "OC_VenEmail",

        // "OC_EnvEnc",
        // "OC_EnvEmp",
        // "Oc_EnvDir",
        // "OC_EnvTel",
        // "OC_EnvEmail",

        // "OC_MedEnv",
        // "OC_FOB",
        // "OC_CondEnv",
        // "OC_FechaEnt",
        
        // "OC_CondEsp",
        // "OC_Subtotal",
        // "OC_Iva",
        // "OC_Envio",
        // "OC_Otro",
        // "OC_Total",                
    ];

    public function pedido_proveedor(){
        return $this->belongsTo('Tazper\OrdenCompraDetalle','Id_OC','Id_OC');
    }
    public function proveedor(){
        return $this->belongsTo('Tazper\Proveedor','Id_Prov','Id_Prov');
    }
    public function sucursal(){
        return $this->belongsTo('Tazper\Sucursal','Id_Suc','Id_Suc');
    }
    public function pto_expedicion(){
        return $this->belongsTo('Tazper\PtoExpedicion','Id_PtoExp','Id_PtoExp');
    }
    public function ocd(){
        return $this->hasOne('Tazper\OrdenCompraDetalle','Id_OC','Id_OC');
    }
    public function compra(){
        return $this->hasOne('Tazper\Compra','Id_OC','Id_OC');
    }
}