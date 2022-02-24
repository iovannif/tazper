<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use PDF;
use Session;

//tabla
use Tazper\Cobro;
use Tazper\CobroDetalle;
//relaciones
use Tazper\Venta;

use Tazper\Medio_Pago;
use Tazper\Cliente;
use Tazper\Timbrado;

// use Tazper\User; 

use Tazper\Descuento;

class CobrosController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }

    //LISTADO
    public function index(Request $request)
    {            
        if(Auth::user()->Id_Prf==2){
            $cobros=Cobro::orderBy('Id_Cob','DESC')->simplePaginate($paginacion=20);
                $mostrados=$cobros->count();
                $cant=Cobro::all()->count();
                $ventas=Venta::all();

                $clientes=Cliente::all();

                //ult pag
                if($mostrados!=0){
                    $lastPage=ceil($cant/$paginacion);
                }else{
                    $lastPage=1;
                }

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            if($request->ajax()){ //ajax paginacion
                $view=view("$nivel.Cobros.js.paginas",compact('cobros','cant','mostrados','lastPage','ventas','clientes'))->renderSections();                
                return response()->json([
                    'paginacion'=>$view['navegacion_1'],
                    'contenido'=>$view['contenido'],
                ]);
            }

            return view("$nivel.Cobros.index",compact('cobros','cant','mostrados','lastPage','ventas','clientes')); 
        }else{
            return view('Vend.restrincted');
        }                            
    }

        //resultados
        public function buscador(Request $request)
        {
            if($request->busqueda!=''){
                Session::put('busqueda',$request->busqueda);
            }            
            $busqueda=Session::get('busqueda');                        

            $resultados=Cobro::where('created_at','like',"%".$busqueda."%")->orderBy('Id_Cob','DESC')->simplePaginate($paginacion=20);
                $count=$resultados->count();                
                $todos=Cobro::where('created_at','like',"%".$busqueda."%")->count();  
                
                $ventas=Venta::all();

                $clientes=Cliente::all();

                //ult pag
                if($count>0){
                    $lastPage=ceil($todos/$paginacion);
                }else{
                    $lastPage=1;
                }

                if(Auth::user()->Id_Prf==2){ //nivel
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }                

            $view=view("$nivel.Cobros.js.resultados",compact("resultados",'count','todos','lastPage','ventas','clientes'))->renderSections();
            return response()->json([
                'paginacion'=>$view['navegacion_1'],
                'contenido'=>$view['contenido'],
            ]);
        }

    //show informe
    public function informe($id)
    {
        if(Auth::user()->Id_Prf==2){     
            if(Cobro::find($id)){
                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

                $cob=Cobro::find($id);
                $det=CobroDetalle::where('Id_Cob','=',$id)->get();

                        $ven=Venta::find($cob->Id_Ven);
                    $med=Medio_Pago::find($ven->Id_MedPag)->MedPag_Des;
                    $cli=Cliente::find($ven->Id_Cli);
                    $timbrado=Timbrado::find($ven->Id_Timb)->Timb_Num;  
                    
                    $desc=Descuento::all();
        
                $pdf=PDF::loadView("$nivel.Cobros.informe",
                compact('id','cob','det','med','ven','cli','timbrado','desc'));        
                return $pdf->stream();                       
            }else{
                return back();
            }       
        }else{
            return view('Vend.restrincted');
        }  
    }

    // //MOSTRAR
    // public function show($id)
    // {
    //     $cobro=Cobro::findOrFail($id);
    //     $users=User::all();
    //         $previous = Cobro::where('Id_Cob', '<', $cobro->Id_Cob)->max('Id_Cob');
    //         $next = Cobro::where('Id_Cob', '>', $cobro->Id_Cob)->min('Id_Cob');

    //         if(Auth::user()->Id_Prf==2){
    //             $nivel='Admin';
    //         }else if(Auth::user()->Id_Prf==1){
    //             $nivel='Vend';
    //         }

    //     return view("$nivel.Cobros.show",compact("cobro",'previous','next','users'));
    // }    
    
    // //Cuentas a cobrar
    // public function index_cobrar()
    // {
    //     // $cobros=Cobro::where('Cob_Est','=','Pendiente')->simplePaginate($paginacion=20);
    //     $cobros=Cobro::simplePaginate($paginacion=20);
    //     $mostrados=$cobros->count();
    //     $cant=Cobro::all()->count();

    //     //ult pag
    //     if($mostrados!=0){
    //         $lastPage=ceil($cant/$paginacion);
    //     }else{
    //         $lastPage=1;
    //     }

    //     if(Auth::user()->Id_Prf==2){
    //         $nivel='Admin';
    //     }else if(Auth::user()->Id_Prf==1){
    //         $nivel='Vend';
    //     }

    //     return view("$nivel.Cobros.cuentas_cobrar",compact('cobros','cant','mostrados','lastPage'));
    // }

    // //Mostrar pendiente
    // public function show_cc($id)
    // {
    //     $cobro=Cobro::findOrFail($id);
    //     $users=User::all();
    //         // $previous = Cobro::where('Cob_Est','=','Pendiente')->where('Id_Cob', '<', $cobro->Id_Cob)->max('Id_Cob');
    //         // $next = Cobro::where('Cob_Est','=','Pendiente')->where('Id_Cob', '>', $cobro->Id_Cob)->min('Id_Cob');

    //         $previous = Cobro::where('Id_Cob', '<', $cobro->Id_Cob)->max('Id_Cob');
    //         $next = Cobro::where('Id_Cob', '>', $cobro->Id_Cob)->min('Id_Cob');

    //         if(Auth::user()->Id_Prf==2){
    //             $nivel='Admin';
    //         }else if(Auth::user()->Id_Prf==1){
    //             $nivel='Vend';
    //         }
        
    //     return view("$nivel.Cobros.show_cc",compact("cobro",'previous','next','users'));
    // }
}