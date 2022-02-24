<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Arqueo extends Model
{
    protected $table='ArqueoCaja';
    protected $primaryKey = 'Id_Arq';
    public $timestamps = false;
    protected $fillable=[
        'Id_Caj',
        'Arq_Est',

        'Arq_Ape',
        'Arq_ApePor',
        'Arq_ApeUser',
        
        'Arq_Cie',
        'Arq_CiePor',
        'Arq_CieUser',
                
        'Arq_FonIni',        
        'Arq_FonFin', 

        //si no esta id usu no se puede guardar
    ];

    public function caja(){
        return $this->belongsTo('Tazper\Caja','Id_Caj','Id_Caj');
    }   
    /*
    public function ocd(){
        return $this->hasOne('Tazper\ArqueoDetalle','Id_Arq','Id_Arq');
    }
    */
    public function compra(){
        return $this->hasMany('Tazper\Compra','Id_Arq','Id_Arq');
    }
    public function venta(){
        return $this->hasMany('Tazper\Venta','Id_Arq','Id_Arq');
    }
}