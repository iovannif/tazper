<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    protected $table='VentasDetalle';
    protected $fillable=[
        'Id_Ven',

        'VD_ArtCant',
        'VD_ArtPre',
        'Id_Desc',
        'VD_ArtDesc',

        'VD_ArtExen',
        'VD_ArtIva5',
        'VD_ArtIva10'
    ];
    public $timestamps = false;

    public function venta(){
        return $this->belongsTo('Tazper\Venta','Id_Ven','Id_Ven');
    }
    public function desc(){
        return $this->belongsTo('Tazper\Descuento','Id_Desc','Id_Desc');
    }
    //un a varios desde alla, uno aca, registro
    
    public function articulos(){
        return $this->belongsToMany('Tazper\Articulo','Id_Art','Id_Art');
    }
}