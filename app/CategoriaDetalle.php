<?php
namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class CategoriaDetalle extends Model
{
    protected $table='CategoriaDetalle';
    public $timestamps=false;

    public function categoria(){
        return $this->belongsTo('Tazper\Categoria','Id_Cat','Id_Cat');
    }
}