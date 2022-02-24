<?php
namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class PagoDetalle extends Model
{
    protected $table='PagosDetalle';
    protected $fillable=[
        'Id_Pag',
        'PD_Art',
        'PD_ArtPre',
        'PD_ArtCant',
        'PD_ArtTot',
    ]; 
    public $timestamps = false;

    public function pago(){
        return $this->belongsTo('Tazper\Pago','Id_Pag','Id_Pag');
    }  
}