<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    protected $table='Impuestos';
    protected $primaryKey='Id_Imp';

    public function articulo(){
        return $this->hasMany('Tazper\Articulo','Id_Imp','Id_Imp');
    }
}