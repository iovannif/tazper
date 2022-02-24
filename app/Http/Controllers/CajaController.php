<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Auth;

//tablas
use Tazper\Caja;
//relaciones
use Tazper\Sucursal;
use Tazper\PtoExpedicion;

use Tazper\Arqueo;

class CajaController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }

    //LISTADO
    public function index()
    {
        $cajas=Caja::all();
            $cant=$cajas->count();

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Caja.index",compact('cajas','cant'));
    }

    //MOSTRAR
    public function show($id)
    {
        $caja=Caja::findOrFail($id);
            $sucursales=Sucursal::all();
            $puntos=PtoExpedicion::all();
         
            $previous = Caja::where('Id_Caj', '<', $caja->Id_Caj)->max('Id_Caj');
            $next = Caja::where('Id_Caj', '>', $caja->Id_Caj)->min('Id_Caj');
            
        if(Auth::user()->Id_Prf==2){ 
            $nivel='Admin';

            $arq='';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';

            $arq=Arqueo::orderBy('Id_Arq', 'DESC')->first();            
        }
        
        return view("$nivel.Caja.show",
        compact("caja",'sucursales','puntos','previous','next','arq'));
    }    
}