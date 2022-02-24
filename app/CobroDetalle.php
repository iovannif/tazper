<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class CobroDetalle extends Model
{
    protected $table='CobrosDetalle';    
    protected $fillable=[
        'Id_Cob',
        'CD_Art',
        'CD_ArtPre',
        'CD_ArtCant',
        'CD_ArtDesc',
        'CD_ArtTot',
    ];
    public $timestamps = false;

    public function cobro(){
        return $this->belongsTo('Tazper\Cobro','Id_Cob','Id_Cob');
    }  
}