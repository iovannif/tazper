<?php
namespace Tazper;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    protected $table='Descuento';
    protected $primaryKey = 'Id_Desc';
    protected $fillable=[
        'Desc_Tip',        
        'Desc_Des',        
        // 'Desc_Porc',        
        'Desc_Est',        
        'Desc_Obs',        

        'Desc_RegPor',
        'Desc_RegUser',
        'Desc_MdfPor',
        'Desc_MdfUser'
    ];

    //vent
}