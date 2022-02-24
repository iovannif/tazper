<?php
namespace Tazper\Http\Controllers;

use Illuminate\Support\Facades\Session;

use Tazper\User;
use Auth;

class usuarioController extends Controller
{
    // Acceso al Sistema
    public function check()
    {
            $users=User::all()->count();

        if($users==0){ // primer admin
            return redirect(url('/register'));
        }else if($users>0){
            return redirect(url('/login'));
        }
    }

    // Redireccion post-registro
    public function registrado()
    {
            $cant=User::all()->count();

        if($cant==1){ // primer admin
            return redirect(url('/login'));
        }else if($cant>1){
                Session::flash('user_agregado','Registro agregado');
            return redirect(url('/Usuarios')); // Session::flush();
        }
    }
}