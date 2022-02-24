<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    protected $table='Cobros';
    protected $primaryKey = 'Id_Cob';
    protected $fillable=[
        'Id_Cob',
        'Id_Ven',
        'Cob_Est',

        'Cob_RegPor',
        'Cob_RegUser',        
        // Id_usu
    ];

    public function venta(){
        return $this->belongsTo('Tazper\Venta','Id_Ven','Id_Ven');
    }   
    public function cobro_detalle(){
        return $this->hasOne('Tazper\CobroDetalle','Id_Cob','Id_Cob');
    } 
}