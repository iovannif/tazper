<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    protected $table='Produccion';
    protected $primaryKey = 'Id_Pdc';
    protected $fillable=[
        'Id_Prod',
        'Pdc_Cant',
        'Pdc_Con',
        'Pdc_Est',
        'Pdc_Obs',

        // Id_Usu
    ];
    
    public function producto(){
        return $this->belongsTo('Tazper\Articulo','Id_Prod','Id_Art');
    }
    public function produccion_detalle(){
        return $this->hasOne('Tazper\ProduccionDetalle','Id_Pdc','Id_Pdc');
    } 
    //en one, de ambos lados son el mismo, se trata del mismo, en dos
    //manytomany ya se trata dos, en el pivot
    //porque yo hago ambos laos :v, con uno basta jsjs, pero en pivot ambos
}