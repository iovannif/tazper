<?php
namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table='Perfil';
    protected $primaryKey='Id_Prf';

    public function perfil_detalle(){
        return $this->hasOne('Tazper\PerfilDetalle','Id_Prf','Id_Prf');
    }
    public function user(){
        return $this->hasMany('Tazper\User','Id_Prf','Id_Prf');
    }
}