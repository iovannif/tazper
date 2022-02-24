<?php

namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class DescuentoDetalle extends Model
{
    protected $table='DescuentoDetalle';
    protected $fillable=[
        'Id_Desc',        
        'Id_Lp',        
        'Id_Cli',        
        'Id_Art',        
        'Id_Cat',    
        'DD_Porc',    

        'Desc_RegPor',
        'Desc_RegUser',
        'Desc_MdfPor',
        'Desc_MdfUser'
    ];
    public $timestamps = false;

    public function lp(){
        return $this->belongsTo('Tazper\ListaPrecio','Id_Lp','Id_Lp');
    }  
    public function cliente(){
        return $this->belongsTo('Tazper\Cliente','Id_Cli','Id_Cli');
    }  
    public function producto(){
        return $this->belongsTo('Tazper\Articulo','Id_Art','Id_Art');
    }  
    public function categoria(){
        return $this->belongsTo('Tazper\Categoria','Id_Cat','Id_Cat');
    }  
}