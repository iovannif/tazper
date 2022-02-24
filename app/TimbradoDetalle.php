<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class TimbradoDetalle extends Model
{
    protected $table='TimbradoDetalle';
    protected $fillable=[
        'Id_Timb',
        'TD_NroFact',
        'TD_FactCod',
        'Id_Ven',        
        'TD_FactEst',
    ];
    public $timestamps = false;

        protected $primaryKey='TD_FactCod'; //para manipular un reg pide su id
    
    public function timbrado(){
        return $this->belongsTo('Tazper\Timbrado','Id_Timb','Id_Timb');
    } 
    public function venta(){
        return $this->hasMany('Tazper\Venta','Id_Ven','Id_Ven');
    } 
}