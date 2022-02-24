<?php
namespace Tazper\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Auth;

//tablas
use Tazper\Perfil;
use Tazper\PerfilDetalle; //relacion

class PerfilController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }

    //LISTADO
    public function index()
    {
        if(Auth::user()->Id_Prf==2){
            $perfiles=Perfil::all();
            $cant=Perfil::all()->count();

            return view("Admin.Perfil.index",compact('perfiles','cant'));
        }else{
            return view('Vend.restrincted');
        }
    }

    //MOSTRAR
    public function show($id)
    {
        if(Auth::user()->Id_Prf==2){
            try{   
                $perfil=Perfil::findOrFail($id);
                $perfil_detalle=PerfilDetalle::all();
                    $previous = Perfil::where('Id_Prf', '<', $perfil->Id_Prf)->max('Id_Prf');
                    $next = Perfil::where('Id_Prf', '>', $perfil->Id_Prf)->min('Id_Prf');

                return view("Admin.Perfil.show",compact("perfil",'previous','next',"perfil_detalle"));
            }catch(ModelNotFoundException $e){    
                return back();
            }
        }else{
            return view('Vend.restrincted');
        }
    }
}