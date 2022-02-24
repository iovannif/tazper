<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class PedidoCliente extends Model
{
    protected $table='PedidosClientes';
    protected $primaryKey = 'Id_PedCli';
    protected $fillable=[
        'Id_Suc',
        'Id_PtoExp',
        'PedCli_FeHo',
        'Id_Cli',
        'PedCli_CliLp',
        'PedCli_CliDesc', 
        'PedCli_FeEnt',
        'PedCli_CondCob',
        'Id_MedPag',
        'PedCli_Est',
        'PedCli_Obs',

        'PedCli_RegPor',
        'PedCli_RegUser',
    ];

    public function sucursal(){
        return $this->belongsTo('Tazper\Sucursal','Id_Suc','Id_Suc');
    }
    public function pto_expedicion(){
        return $this->hasOne('Tazper\PtoExpedicion','Id_PtoExp','Id_PtoExp');
    } 
    public function cliente(){
        return $this->belongsTo('Tazper\Cliente','Id_Cli','Id_Cli');
    }      
    public function medio_pago(){
        return $this->belongsTo('Tazper\Medio_Pago','Id_MedPag','Id_MedPag');
    }
    public function pedcli_detalle(){
        return $this->hasOne('Tazper\PedidoClienteDetalle','Id_PedCli','Id_PedCli');
    }    
    public function venta(){
        return $this->hasOne('Tazper\Venta','Id_PedCli','Id_PedCli');
    }
}