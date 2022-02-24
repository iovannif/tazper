<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model //danilo
{
    protected $table='ComprasDetalle';
    // protected $primaryKey = 'Id_Com';
    protected $fillable=[
        'Id_Com',
        // 'Id_Art',
        // 'CD_ArtDes',
        // 'CD_ArtPreUn',
        'CD_ArtCant',
        'CD_ArtExen',
        'CD_ArtIva5',
        'CD_ArtIva10'
    ];
    public $timestamps = false;

    public function compra(){
        return $this->belongsTo('Tazper\Compra','Id_Com','Id_Com');
    }    
    // public function cd_articulos(){
    //     return $this->belongsToMany('Tazper\CompraDetalleArticulos','Id_Com','Id_Com');
    // }
    public function articulos(){
        return $this->belongsToMany('Tazper\Articulo','Id_Art','Id_Art'); //varios art en una compra
    }
    //con el metodo belongstomany laravel determina la relacion, el modelo pivot
}