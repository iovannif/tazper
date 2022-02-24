<?php
namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class PedidoProveedorDetalle extends Model
{
    protected $table='PedidosProveedoresDetalle';
    protected $fillable=[
        'Id_PedProv',        
        'PPD_ArtCant'
    ];
    public $timestamps=false;   

    public function pedido_proveedor(){
        return $this->belongsTo('Tazper\PedidoProveedor','Id_PedProv','Id_PedProv');
    }    
    // public function ppd_articulos(){
    //     return $this->belongsToMany('Tazper\ProveedorDetalleArticulos','Id_PedProv','Id_PedProv');
    // }
    public function articulos(){
        return $this->belongsToMany('Tazper\Articulo','Id_Art','Id_Art'); //varios art en un pedido
    }
}