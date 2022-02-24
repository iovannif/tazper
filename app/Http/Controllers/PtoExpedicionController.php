<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

use Illuminate\Database\Eloquent\ModelNotFoundException;

//tabla
use Tazper\PtoExpedicion;
//relacion
use Tazper\Sucursal;

class PtoExpedicionController extends Controller
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
            $puntos=PtoExpedicion::all();
                $cant=$puntos->count();
                $sucursales=Sucursal::all();

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.PtoExpedicion.index",compact('puntos','cant','sucursales'));
        }else{
            return view('Vend.restrincted');
        }
    }

    //MOSTRAR
    public function show($id)
    {
        if(Auth::user()->Id_Prf==2){
            try{
                $punto=PtoExpedicion::findOrFail($id);
                    $sucursales=Sucursal::all();

                    $previous = PtoExpedicion::where('Id_PtoExp', '<', $punto->Id_PtoExp)->max('Id_PtoExp');
                    $next = PtoExpedicion::where('Id_PtoExp', '>', $punto->Id_PtoExp)->min('Id_PtoExp');

                    if(Auth::user()->Id_Prf==2){
                        $nivel='Admin';
                    }else if(Auth::user()->Id_Prf==1){
                        $nivel='Vend';
                    }

                return view("$nivel.PtoExpedicion.show",compact("punto",'previous','next','sucursales'));
            }catch(ModelNotFoundException $e){    
                return back();
            }
        }else{
            return view('Vend.restrincted');
        }
    }
}