<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class ListaPrecioDetalle extends Model
{
    protected $table='ListaPrecioDetalle';    
    
    public function lp(){
        return $this->belongsTo('Tazper\ListaPrecio','Id_Lp','Id_Lp');
    }    
}