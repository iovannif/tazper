<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table='Caja';
    protected $primaryKey = 'Id_Caj';
    protected $fillable=[
        'Caj_Fon'
    ];
    public $timestamps = false;

    public function arqueo(){
        return $this->hasMany('Tazper\Arqueo','Id_Caj','Id_Caj');
    }
    public function sucursal(){
        return $this->belongsTo('Tazper\Sucursal','Id_Suc','Id_Suc');
    }
    public function pto_expedicion(){
        return $this->belongsTo('Tazper\PtoExpedicion','Id_PtoExp','Id_PtoExp');
    }
}