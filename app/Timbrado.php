<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Timbrado extends Model
{
    protected $table='Timbrado';
    protected $primaryKey='Id_Timb';
    protected $fillable=[
        //'Id_Timb', toma como autonum, duplica pk, no puede haber dos
        'Id_Suc',
        'Id_PtoExp',
        'Timb_Num',
        'Timb_IniVig',
        'Timb_FinVig',
        'Timb_Rang',
        'Timb_IniFact',
        'Timb_FinFact',
        'Timb_Est',
        'Timb_Obs',

        'Timb_RegPor',
        'Timb_RegUser',

        //'Id_Usu'
    ];    

    public function sucursal(){
        return $this->belongsTo('Tazper\Sucursal','Id_Suc','Id_Suc');
    }
    public function pto_expedicion(){
        return $this->belongsTo('Tazper\PtoExpedicion','Id_PtoExp','Id_PtoExp');
    }
    public function timbrado_detalle(){
        return $this->hasOne('Tazper\TimbradoDetalle','Id_Timb','Id_Timb');
    }  
    public function venta(){
        return $this->hasMany('Tazper\Venta','Id_Timb','Id_Timb');
    }
}