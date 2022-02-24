<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table='Pagos';
    protected $primaryKey = 'Id_Pag';
    protected $fillable=[
        'Id_Pag',
        'Id_Arq',
        'Id_Com',
        'Pag_ConPag',
        'Id_MedPag',
        'Pag_Eg',
        'Pag_Fac',
        'Id_Caj',
        'Pag_Prov',
        'Id_Suc',
        'Id_PtoExp',

        'Pag_RegPor',
        'Pag_RegUser',        
        // Id_usu
    ];    

    public function arqueo(){
        return $this->belongsTo('Tazper\Arqueo','Id_Arq','Id_Arq');
    }
    public function medio_pago(){
        return $this->belongsTo('Tazper\Medio_Pago','Id_MedPag','Id_MedPag');
    }
    public function caja(){
        return $this->belongsTo('Tazper\Caja','Id_Caj','Id_Caj');
    }
    public function sucursal(){
        return $this->belongsTo('Tazper\Sucursal','Id_Suc','Id_Suc');
    }
    public function pto_expedicion(){
        return $this->belongsTo('Tazper\PtoExpedicion','Id_PtoExp','Id_PtoExp');
    } 
    public function pago_detalle(){
        return $this->hasOne('Tazper\PagoDetalle','Id_Pag','Id_Pag');
    } 
}