<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

use PDF;
use Session;

//tabla
use Tazper\Pago;
use Tazper\PagoDetalle;

use Tazper\Medio_Pago;

class PagosController extends Controller
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
            $pagos=Pago::orderBy('Id_Com','desc')->simplePaginate($paginacion=20);
            $mostrados=$pagos->count();
            $cant=Pago::all()->count();

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

                if($request->ajax()){ //ajax
                    $view=view("$nivel.Pagos.js.paginas",compact('pagos','cant','mostrados','lastPage'))->renderSections();                
                    return response()->json([
                        'paginacion'=>$view['navegacion_1'],
                        'contenido'=>$view['contenido'],
                    ]);
                }

            return view("$nivel.Pagos.index",compact('pagos','cant','mostrados','lastPage'));
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

            $resultados=Pago::orderBy('Id_Pag','desc')->where('created_at','like',"%".$busqueda."%")->simplePaginate($paginacion=20);
                $count=$resultados->count();                
                $todos=Pago::where('created_at','like',"%".$busqueda."%")->count();                                      

                //ult pag
                if($count>0){
                    $lastPage=ceil($todos/$paginacion);
                }else{
                    $lastPage=1;
                }

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }                

            $view=view("$nivel.Pagos.js.resultados",compact("resultados",'count','todos','lastPage'))->renderSections();
            return response()->json([
                'paginacion'=>$view['navegacion_1'],
                'contenido'=>$view['contenido'],
            ]);
        }

    // show informe    
    public function informe($id)
    {
        if(Auth::user()->Id_Prf==2){
            if(Pago::find($id)){
                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

                $pago=Pago::find($id);
                $detalle=PagoDetalle::where('Id_Pag','=',$id)->get();

                    $medio=Medio_Pago::find($pago->Id_MedPag)->MedPag_Des;
        
                $pdf=PDF::loadView("$nivel.Pagos.informe",compact('pago','detalle','medio'));        
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
    //     $pago=Pago::findOrFail($id);
    //     $users=User::all();
    //         $previous = Pago::where('Id_Pag', '<', $pago->Id_Pag)->max('Id_Pag');
    //         $next = Pago::where('Id_Pag', '>', $pago->Id_Pag)->min('Id_Pag');

    //         if(Auth::user()->Id_Prf==2){
    //             $nivel='Admin';
    //         }else if(Auth::user()->Id_Prf==1){
    //             $nivel='Vend';
    //         }

    //     return view("$nivel.Pagos.show",compact("pago",'previous','next','users'));
    // }    
    
    // //Cuentas a pagar
    // public function index_pagar()
    // {
    //     // $pagos=Pago::where('Pag_Est','=','Pendiente')->simplePaginate($paginacion=20);
    //     $pagos=Pago::simplePaginate($paginacion=20);
    //     $mostrados=$pagos->count();
    //     $cant=Pago::all()->count();

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

    //     return view("$nivel.Pagos.cuentas_pagar",compact('pagos','cant','mostrados','lastPage'));
    // }

    // //Mostrar pendiente
    // public function show_cp($id)
    // {
    //     $pago=Pago::findOrFail($id);
    //     $users=User::all();
    //         // $previous = Pago::where('Pag_Est','=','Pendiente')->where('Id_Pag', '<', $pago->Id_Pag)->max('Id_Pag');
    //         // $next = Pago::where('Pag_Est','=','Pendiente')->where('Id_Pag', '>', $pago->Id_Pag)->min('Id_Pag');

    //         $previous = Pago::where('Id_Pag', '<', $pago->Id_Pag)->max('Id_Pag');
    //         $next = Pago::where('Id_Pag', '>', $pago->Id_Pag)->min('Id_Pag');

    //         if(Auth::user()->Id_Prf==2){
    //             $nivel='Admin';
    //         }else if(Auth::user()->Id_Prf==1){
    //             $nivel='Vend';
    //         }

    //     return view("$nivel.Pagos.show_cp",compact("pago",'previous','next','users'));
    // }
}