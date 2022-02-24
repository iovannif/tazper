<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table='Proveedores';
    protected $primaryKey = 'Id_Prov';
    protected $fillable=[
        'Prov_Des',
        'Prov_RazSoc',
        'Prov_Ruc',

        'Prov_Tel',
        'Prov_Cel',
        'Prov_Email',        
        'Prov_Web',

        'Prov_Dir',
        'Prov_Ciu',
        'Prov_Bar',

        'Prov_Ho',
        'Prov_Est',
        'Prov_Obs',

        'Prov_RegPor',
        'Prov_RegUser',
        'Prov_MdfPor',
        'Prov_MdfUser'
        // Id_Usu
    ];

    // public function user(){
    //     return $this->belongsTo('Tazper\User','Id_Usu','Id_Usu');
    // }

    public function articulo(){
        return $this->hasMany('Tazper\Articulo','Id_Prov','Id_Prov');
    }
    public function pedidoproveedor(){
        return $this->hasMany('Tazper\PedidoProveedor','Id_Prov','Id_Prov');
    }
    public function oc(){
        return $this->hasMany('Tazper\OrdenCompra','Id_Prov','Id_Prov'); //uno, este, tiene muchos
    } 
    public function compra(){
        return $this->hasMany('Tazper\Proveedor','Id_Prov','Id_Prov');
    }
}