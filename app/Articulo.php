<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='Articulos';
    protected $primaryKey='Id_Art';
    protected $fillable=[
        "Art_Tip",
        "Id_Mat",
        "Id_Prod",
        "Art_DesLar",
        "Art_DesCor",
        "Art_ProdTip",
        "Id_Cat",
        "Id_Imp",        
        "Art_GanMin",                                
        "Art_PreCom",
        "Art_PreVen",   
        "Art_UniMed",             
        "Art_St",
        "Art_StMn",
        "Art_StMx",
        "Id_Prov",
        "Art_Est",
        "Art_Obs",

        "Art_RegPor",
        "Art_RegUser",
        "Art_MdfPor",
        "Art_MdfUser"
        //Id_Usu
    ];    

    public function categoria(){
        return $this->belongsTo('Tazper\Categoria','Id_Cat','Id_Cat');
    }
    public function impuesto(){
        return $this->belongsTo('Tazper\Impuesto','Id_Imp','Id_Imp');
    }
    public function proveedor(){
        return $this->belongsTo('Tazper\Proveedor','Id_Prov','Id_Prov');
    }
    public function articulo_detalle(){
        return $this->hasOne('Tazper\ArticuloDetalle','Id_Art','Id_Art');
    }   
    public function produccion(){
        return $this->hasMany('Tazper\Articulo','Id_Art','Id_Art'); //un prod varios pdc, se repite el reg en tab
    }
    public function descuento_detalle(){
        return $this->hasMany('Tazper\DescuentoDetalle','Id_Art','Id_Art');
    } 
    // public function pd_articulos(){ 
    //     return $this->belongsToMany('Tazper\ProduccionDetalleArticulos','Id_Art','Id_Art');        
    // }  
    
        // public function user(){
        //     return $this->belongsTo('Tazper\User','Id_Usu','Id_Usu');
        // }
    public function compras_detalles(){
        return $this->belongsToMany('Tazper\Compra','Id_Com','Id_Com'); //este un art en varios compras, detalles
    }
    //para fomar el modelo pivot //se refiere al campo de la tabla pivot
    public function pp_detalles(){
        return $this->belongsToMany('Tazper\PedidoProveedor','Id_PedProv','Id_PedProv'); //este un art en varios pedidos, detalles
    }
    public function pdc_detalles(){
        return $this->belongsToMany('Tazper\Produccion','Id_Pdc','Id_Pdc'); //este un art en varios producciones, detalles
    }
    //ambos modelos belongs, al pivot que les une
    public function oc_detalles(){
        return $this->belongsToMany('Tazper\OrdenCompra','Id_OC','Id_OC'); //este un art en varios producciones, detalles
    } //los oc de aca, registros del pivot, pertenecen a varios oc, varios a varios, tabla a tabla
    public function pc_detalles(){
        return $this->belongsToMany('Tazper\PedidoCliente','Id_PedCli','Id_PedCli'); //detalle
    }     
    public function venta_detalles(){
        return $this->belongsToMany('Tazper\Venta','Id_Ven','Id_Ven');
    }
}