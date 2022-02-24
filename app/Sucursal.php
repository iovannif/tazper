<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table='Sucursal';
    protected $primaryKey='Id_Suc';    
    protected $fillable=[
        'Suc_NomFan',
        'Suc_Des',
        
        'Suc_Tel',
        'Suc_Dir',
        'Suc_Ciu',        
        'Suc_Bar',
        'Suc_Red1',
        'Suc_Red2',    
        'Suc_Email',        

        'Suc_Ruc',
        'Suc_RazSoc',
        'Suc_Enc',    
        
        'Suc_Est',
        'Suc_Obs',
    ];    
    public $timestamps=false;    

    public function caja(){
        return $this->hasOne('Tazper\Caja','Id_Suc','Id_Suc');
    }
    public function pedidoproveedor(){
        return $this->hasMany('Tazper\PedidoProveedor','Id_Suc','Id_Suc');
    }
    public function oc(){
        return $this->hasMany('Tazper\OrdenCompra','Id_Suc','Id_Suc'); //uno, este, tiene muchos
    } 
    public function compra(){
        return $this->hasMany('Tazper\Compra','Id_Suc','Id_Suc');
    }
    public function pedido_cliente(){
        return $this->hasMany('Tazper\PedidoCliente','Id_Suc','Id_Suc');
    }
    public function venta(){
        return $this->hasMany('Tazper\Venta','Id_Suc','Id_Suc');
    }
    public function timbrado(){
        return $this->hasMany('Tazper\Timbrado','Id_Timb','Id_Timb');
    }
}