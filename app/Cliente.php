<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table='Clientes';
    protected $primaryKey = 'Id_Cli';
    protected $fillable=[
        'Cli_Nom',
        'Cli_Ape',
        'Cli_Ruc',
        'Id_Lp',
        // 'Cli_FeNac',
        // 'Cli_Gen',
        // 'Cli_Cel',
        // 'Cli_Dir',
        // 'Cli_Ciu',
        // 'Cli_Bar',
        'Cli_Est',
        'Cli_Obs',

        'Cli_RegPor',
        'Cli_RegUser',
        // 'Cli_MdfPor',
        // 'Cli_MdfUser',
    ];
    
    public function lp(){
        return $this->belongsTo('Tazper\ListaPrecio','Id_Lp','Id_Lp');
    }
    public function pedido_cliente(){
        return $this->hasMany('Tazper\PedidoCliente','Id_Cli','Id_Cli');
    }
    public function descuento_detalle(){
        return $this->hasMany('Tazper\DescuentoDetalle','Id_Cli','Id_Cli');
    }  
    public function venta(){
        return $this->hasMany('Tazper\Venta','Id_Cli','Id_Cli');
    }    
}