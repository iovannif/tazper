<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='Ventas';
    protected $primaryKey = 'Id_Ven';
    protected $fillable=[
        'Id_Cob',
        'Ven_Fe',
        'Ven_Ho',
        'Id_Suc',
        'Id_PtoExp',
        'Id_Arq',

        'Id_Timb',
        'Ven_Fact',
        'Ven_Tip',
        'Id_PedCli',
        'Id_Cli', 
        'Ven_CliLp',
        'Ven_CliDesc',    
        'Ven_DescDia',    
        'Ven_CondCob',
        'Id_MedPag',
        'Ven_Est',
                   
        'Ven_StExe',
        'Ven_St5',
        'Ven_St10',
        'Ven_Tot',
        'Ven_Liq5',
        'Ven_Liq10',
        'Ven_TotIva',
            
        'Ven_RegPor',
        'Ven_RegUser',        

        // 'Id_Usu'
    ];

    public function sucursal(){
        return $this->belongsTo('Tazper\Sucursal','Id_Suc','Id_Suc');
    }
    public function pto_expedicion(){
        return $this->belongsTo('Tazper\PtoExpedicion','Id_PtoExp','Id_PtoExp');
    } 
    public function arqueo(){
        return $this->belongsTo('Tazper\Arqueo','Id_Arq','Id_Arq');
    }
    public function timbrado(){
        return $this->belongsTo('Tazper\Timbrado','Id_Timb','Id_Timb');
    }
    public function pedido_cliente(){
        return $this->belongsTo('Tazper\PedidoCliente','Id_PedCli','Id_PedCli');
    }   
    public function cliente(){
        return $this->belongsTo('Tazper\Cliente','Id_Cli','Id_Cli');
    }            
    public function medio_pago(){
        return $this->belongsTo('Tazper\Medio_Pago','Id_MedPag','Id_MedPag');
    }
    public function venta_detalle(){
        return $this->hasOne('Tazper\VentaDetalle','Id_Ven','Id_Ven');
    } 
    public function venta(){
        return $this->hasOne('Tazper\Cobro','Id_Ven','Id_Ven'); //un reg ven, tiene un 
    }
}