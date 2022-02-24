<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class ArticuloDetalle extends Model
{
    protected $table='ArticulosDetalle';    
    public $timestamps = false;

    public function articulo(){
        return $this->belongsTo('Tazper\Articulo','Id_Art','Id_Art');
    }
    public function lp(){
        return $this->belongsTo('Tazper\ListaPrecio','Id_Lp','Id_Lp');
    }
}