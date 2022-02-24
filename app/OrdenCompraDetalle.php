<?php

namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class OrdenCompraDetalle extends Model
{
    protected $table='OrdenCompraDetalle';
    protected $fillable=[
        "Id_OC",
        "OCD_ArtCant",
        "OCD_ArtTot"

        // "OCD_ArtNum",
        // "OCD_ArtDes",
        // "OCD_ArtCant",
        // "OCD_ArtPreUn",
        // "OCD_ArtTotal"        
    ];
    public $timestamps = false;

    public function oc(){
        return $this->belongsTo('Tazper\OrdenCompra','Id_OC','Id_OC');
    }
    public function articulos(){
        return $this->belongsToMany('Tazper\Articulo','Id_Art','Id_Art'); //varios art en una oc
    }
}