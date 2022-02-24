<?php
namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class PerfilDetalle extends Model
{
    protected $table='PerfilDetalle';

    public function perfil(){
        return $this->belongsTo('Tazper\Perfil','Id_Prf','Id_Prf');
    }
}