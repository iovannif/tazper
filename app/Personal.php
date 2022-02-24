<?php
namespace Tazper;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table='Personal';
    protected $primaryKey = 'Id_Per';
    protected $fillable=[        
        'Per_Nom',
        'Per_Ape',
        'Per_CI',
        'Per_Car',

        'Per_FeNac',
        'Per_LugNac',
        'Per_Nac',
        'Per_Gen',
        'Per_EstCiv',
        'Per_Hij',

        'Per_Tel',
        'Per_Cel',
        'Per_Email',
        'Per_Dir',
        'Per_Ciu',
        'Per_Bar',
        
        'Per_Ini',
        'Per_Tur',        
        'Per_Est',
        'Per_Obs',
        
        'Per_RegPor',
        'Per_RegUser',
        'Per_MdfPor',
        'Per_MdfUser'
    ];    

    public function user(){
        return $this->hasMany('Tazper\User','Id_Per','Id_Per');
    }   
}