<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class ListaPrecio extends Model
{
    protected $table='ListaPrecio';    
    protected $primaryKey='Id_Lp';

    public function lp_detalle(){
        return $this->hasOne('Tazper\ListaPrecioDetalle','Id_Lp','Id_Lp');
    }    
    public function lp(){
        return $this->hasMany('Tazper\ArticuloDetalle','Id_Lp','Id_Lp');
    }
    public function cliente(){
        return $this->hasMany('Tazper\Cliente','Id_Lp','Id_Lp');
    } 
    //este es un reg, un lp
    public function descuento_detalle(){
        return $this->hasMany('Tazper\DescuentoDetalle','Id_Lp','Id_Lp');
    }   
}