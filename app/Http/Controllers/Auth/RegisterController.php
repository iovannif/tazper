<?php
namespace Tazper\Http\Controllers\Auth;

use Tazper\User;
use Tazper\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Auth;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller
{
    use RegistersUsers;
    
     protected $redirectTo = '/registrado'; // user registrado

    // Validacion
    protected function validator(array $data)
    {                
        return Validator::make($data, [
            'Usu_User' => 'required|string|max:20|unique:users',
            'Id_Prf' => 'required|integer|digits_between:1,4',
            'Usu_Pass' => 'required|string|min:8|max:20|confirmed',                
            'Id_Per' => 'required|integer|digits_between:1,4|unique:users',
            'Usu_Est' => 'required|string|min:6|max:8',
            'Usu_Obs' => 'max:140'                                                                    
        ]);        
    }

    // Creacion
    protected function create(array $data)
    {
        $users=User::all()->count();
        if($users==0){ // primer admin
            return User::create([
                'Usu_User' => $data['Usu_User'],
                'Id_Prf' => $data['Id_Prf'],
                'Usu_Pass' => bcrypt($data['Usu_Pass']),
                'Id_Per'=>Input::get('Id_Per'), //
                'Usu_Est' => $data['Usu_Est'],
                'Usu_Obs' => $data['Usu_Obs']
            ]);
        }else{
            return User::create([
                'Usu_User' => $data['Usu_User'],
                'Id_Prf' => $data['Id_Prf'],
                'Usu_Pass' => bcrypt($data['Usu_Pass']),
                'Id_Per'=>Input::get('Id_Per'),
                'Usu_Est' => $data['Usu_Est'],
                'Usu_Obs' => $data['Usu_Obs'],
                
                'Usu_RegPor' => Auth::id(),
                'Usu_RegUser' => Auth::user()->Usu_User
            ]);
        }        
    }
}