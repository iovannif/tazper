<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class PedidoClienteDetalle extends Model
{
    protected $table='PedidosClientesDetalle';
    protected $fillable=[
        'Id_PedCli',        
        'PCD_ArtCant'
    ];
    public $timestamps=false;   

    public function pedido_cliente(){
        return $this->belongsTo('Tazper\PedidoCliente','Id_PedCli','Id_PedCli');
    }     
    public function articulos(){
        return $this->belongsToMany('Tazper\Articulo','Id_Art','Id_Art'); //varios prod en un pedido
    }
}