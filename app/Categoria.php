<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='Categoria';
    protected $primaryKey = 'Id_Cat';
    protected $fillable=[
        'Cat_Des',
        'Cat_Est',
        'Cat_Obs',

        'Cat_RegPor',
        'Cat_RegUser',
        'Cat_MdfPor',
        'Cat_MdfUser'

        //Id_Usu
    ];

    public function categoria_detalle(){
        return $this->hasOne('Tazper\CategoriaDatalle','Id_Cat','Id_Cat');
    }
    public function articulo(){
        return $this->hasMany('Tazper\Articulo','Id_Cat','Id_Cat');
    }
    public function descuento_detalle(){
        return $this->hasMany('Tazper\DescuentoDetalle','Id_Cat','Id_Cat');
    } 
}