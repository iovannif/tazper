<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class ProduccionDetalle extends Model
{
    protected $table='ProduccionDetalle';
    // protected $primaryKey = 'Id_Pdc'; //para order by
    protected $fillable=[
        'Id_Pdc',        
        'PD_MatCant'
    ];
    public $timestamps=false;   

    public function produccion(){
        return $this->belongsTo('Tazper\Produccion','Id_Pdc','Id_Pdc');
    }
    // public function pd_articulos(){ 
    //     return $this->belongsToMany('Tazper\ProduccionDetalleArticulos','Id_Pdc','Id_Pdc');        
    // }
    public function articulos(){
        return $this->belongsToMany('Tazper\Articulo','Id_Art','Id_Art'); //varios art en una pdc
    }
}