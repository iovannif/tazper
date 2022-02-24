<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDF;

//tablas
use Tazper\Arqueo;
use Tazper\ArqueoDetalle;
//relaciones
use Tazper\Caja;
use Tazper\User; use Auth;
use Tazper\Pago;
// use Tazper\Cobro;
use Tazper\Venta;
 //detalle

use Tazper\Cliente;
use Tazper\Sucursal;
use Tazper\PtoExpedicion;
use Tazper\Medio_Pago;
use Tazper\Compra;

class ArqueoController extends Controller
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
                $arqueos=Arqueo::orderBy('Id_Arq','DESC')->simplePaginate($paginacion=20);
                $mostrados=$arqueos->count();
                $cant=Arqueo::all()->count();        
                $cajas=Caja::all();

            //ult pag
            if($mostrados>0){
                $lastPage=ceil($cant/$paginacion);
            }else{
                $lastPage=1;
            }

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

                if($request->ajax()){
                    $view=view("Admin.Arqueo.js.paginas",compact('arqueos','cant','mostrados','cajas','lastPage'))->renderSections();
                    return response()->json([
                        'paginacion'=>$view['navegacion_1'],
                        'contenido'=>$view['contenido'],
                    ]);
                }
            
            return view($nivel.'.Arqueo.index',compact('arqueos','cant','mostrados','cajas','lastPage'));
        }else{
            return view('Vend.restrincted');
        }                
    }

        public function buscador(Request $request)
        {
            if($request->busqueda!=''){
                Session::put('busqueda',$request->busqueda);
            }            
            $busqueda=Session::get('busqueda');                        

            $resultados=Arqueo::where('Arq_Ape','like',"%".$busqueda."%")->orderBy('Id_Arq','DESC')->simplePaginate($paginacion=20);
                $count=$resultados->count();                
                $todos=Arqueo::where('Arq_Ape','like',"%".$busqueda."%")->count();        
                $cajas=Caja::all();

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

                $view=view("$nivel.Arqueo.js.resultados",compact("resultados",'count','todos','cajas','lastPage'))->renderSections();
                return response()->json([
                    'paginacion'=>$view['navegacion_1'],
                    'contenido'=>$view['contenido'],
                ]);
        }

    //MOSTRAR
    public function show($id) //registro
    {
        if(Auth::user()->Id_Prf==2){
            try{            
                $arqueo=Arqueo::findOrFail($id);
                $caja=Caja::first();
                $users=User::all();
                // $arqueos=Arqueo::all();
                // $pagos=Pago::all();
                $pagos=Pago::where('Id_Arq','=',$id)->get();
                // $cobros=Cobro::all();
                $ventas=Venta::where('Id_Arq','=',$id)
                            ->where('Ven_Est','=','Válida')
                            ->get();                    
                    $cli=Cliente::all();
                    $suc=Sucursal::all();
                    $punto=PtoExpedicion::all();
                    $med=Medio_Pago::all();                     
                $compras=Compra::all();

                $previous = Arqueo::where('Id_Arq', '<', $arqueo->Id_Arq)->max('Id_Arq');
                $next = Arqueo::where('Id_Arq', '>', $arqueo->Id_Arq)->min('Id_Arq');

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

                return view("$nivel".'.Arqueo.show',
                compact("arqueo",'previous','next',"caja",'users','pagos','ventas','cli','suc','punto','med','compras'));  
                                        
            }catch(ModelNotFoundException $e){    
                return back();
            }
        }else{
            return view('Vend.restrincted');
        } 
    }

    //ABRIR CAJA
    public function abrir_caja()
    {
        // $ult_arq=Arqueo::latest()->first(); //latest:created_at //first:limit 1
        // $ult_arq=Arqueo::first();
        
        $ult_arq=Arqueo::orderBy('Id_Arq', 'DESC')->first();

        if($ult_arq){
            $estado=$ult_arq->Arq_Est;
        }else if(!$ult_arq){        
            $estado='';
        }

        if($estado=='' || $estado=='Cerrado'){
            $cajas=Caja::all();
            if($cajas){
                foreach($cajas as $caja){
                    if($caja->Caj_Est=='Activa'){
                        $la_caja=$caja;
                    }
                }
            }

            $arqueo=new Arqueo;
                $arqueo->Arq_Est='Abierto';
                $arqueo->Arq_Ape=date('Y-m-d H:i:s');
                $arqueo->Arq_ApePor=Auth::user()->Id_Usu;
                $arqueo->Arq_ApeUser=Auth::user()->Usu_User;
                $arqueo->Arq_FonIni=$la_caja->Caj_Fon;
            $arqueo->save();
                // $arqueo->Arq_FonApe=$la_caja->Caj_Fon;
                // $arqueo->Arq_Sal=$la_caja->Caj_Fon;
                // $arqueo->Id_Caj=$la_caja->Id_Caj;
                
            Session::flash('caja_abierta','Abierta');
        }else{
            Session::flash('no_cerrada','Cerrar anterior');        
        }    

        return back();     
    }

    //CERRAR CAJA
    public function cerrar_caja()
    {
        $arqueo=Arqueo::orderBy('Id_Arq', 'DESC')->first();
        $caja=Caja::find($arqueo->Id_Caj);
        
        if($arqueo && $arqueo->Arq_Est=='Abierto'){
            $arqueo->update([
                'Arq_Cie'=>date('Y-m-d H:i:s'),
                'Arq_CiePor'=>Auth::user()->Id_Usu,                
                'Arq_CieUser'=>Auth::user()->Usu_User,                
                'Arq_Est'=>'Cerrado',
                'Arq_FonFin'=>$caja->Caj_Fon
            ]);            
            
            Session::flash('caja_cerrada','Cerrada');
        }else{
            Session::flash('no_abierta','No hay caja abierta');
        }        
        return back();
    }

    //logout
    public function logout()
    {
        $arqueo=Arqueo::orderBy('Id_Arq', 'DESC')->first();    
        $caja=Caja::find($arqueo->Id_Caj);
        if($arqueo && $arqueo->Arq_Est=='Abierto'){
            $arqueo->update([
                'Arq_Est'=>'Cerrado',
                'Arq_Cie'=>date('Y-m-d H:i:s'),
                'Arq_FonFin'=>$caja->Caj_Fon,

                'Arq_CiePor'=>Auth::user()->Id_Usu,                
                'Arq_CieUser'=>Auth::user()->Usu_User
            ]);            
        }                  
        //cierran pero no redirecciona, queda en esa ruta          
        Auth::logout(); 
        return redirect('login'); //refresh php
        // Session::flush(); 
        //borra todo, si tuvieses sesionados por mas de una sesion de user        
    }

    //informe arqueo        
    // public function informe($id)
    // {
    //     // if cerrado

    //     // $compras=Compra::all();
    //     // foreach($compras as $compra){
    //     //     if($id==$compra->Id_Com){

    //         //si hay, sino back
    //             if(Auth::user()->Id_Prf==2){
    //                 $nivel='Admin';
    //             }else if(Auth::user()->Id_Prf==1){
    //                 $nivel='Vend';
    //             }
        
    //             $pdf=PDF::loadView("$nivel.Arqueo.informe",compact('id'));        
    //             return $pdf->stream();                       
    // //         }else{
    // //             return back();
    // //         }
    // //     }        
    // }
    
    public function informe($id)
    {
        if(Auth::user()->Id_Prf==2){                    
            if($arqueo=Arqueo::find($id)){            
                $caja=Caja::find($arqueo->Id_Caj);                            
                $pagos=Pago::where('Id_Arq','=',$id)->get();            
                $ventas=Venta::where('Id_Arq','=',$id)
                            ->where('Ven_Est','=','Válida')
                            ->get();                    
                    $cli=Cliente::all();
                    $suc=Sucursal::all();
                    $punto=PtoExpedicion::all();
                    $med=Medio_Pago::all();                     
                $compras=Compra::all();                

                    if(Auth::user()->Id_Prf==2){
                        $nivel='Admin';
                    }else if(Auth::user()->Id_Prf==1){
                        $nivel='Vend';
                    }        
            
                $pdf=PDF::loadView("$nivel.Arqueo.reporte",
                    compact("arqueo","caja",'pagos','ventas','cli','suc','punto','med','compras'));     
                $pdf->setPaper('a4', 'landscape');  
                return $pdf->stream();
            }else{
                return back();
            }
        }else{
            return view('Vend.restrincted');
        }
    }
}