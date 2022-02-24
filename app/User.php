<?php
namespace Tazper;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $table='Users';
    protected $primaryKey = 'Id_Usu';

    // campos manejados por el sistema
    protected $fillable = [
        'Usu_User',
        'Id_Prf',
        'Usu_Pass',
        'Id_Per',
        'Usu_Est',
        'Usu_Obs',
        
        'Usu_RegPor',
        'Usu_RegUser',
        'Usu_MdfPor',
        'Usu_MdfUser',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Usu_Pass', 'remember_token',
    ];

    //pass field custom name
    public function getAuthPassword()
    {
        return $this->Usu_Pass;
    }

    public function perfil(){
        return $this->belongsTo('Tazper\Perfil','Id_Prf','Id_Prf');
    }
    public function personal(){
        return $this->belongsTo('Tazper\Personal','Id_Per','Id_Per');
    }   
}