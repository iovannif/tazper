<?php
namespace Tazper\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;

use Tazper\Venta;
use Tazper\VentaDetalle;
use Tazper\VentaDetalleArticulos;
use Tazper\Pago;
use Tazper\PagoDetalle;
use Tazper\Compra;
use Tazper\Cliente;
use Tazper\Articulo;

use Tazper\Cobro;
use Tazper\CobroDetalle;

class InformeListasController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }

    //filtrar
    public function filtros()
    {                
        if(Auth::user()->Id_Prf==2){
            return view("Admin.Informe_Listas.f_filtros");        
            // return redirect("/Usuarios/$id");
        }else{
            return view('Vend.restrincted');
        }
    }                            

    //reporte
    public function informe(Request $request)
    {        
        if(Auth::user()->Id_Prf==2){
            $de=$request->de;
            $tipo=$request->tipo;

            $inicio=$request->inicio;
            $fin=$request->fin;

                $ventas='';
                    $v_det='';
                    $v_det_a='';
                $compras='';    
                    $c_det='';
                    $c_det_a='';    
                    
                $clientes=Cliente::all();
                $articulos=Articulo::all();

            if($de=='venta'){ // = obliga a entrar siempre, aunque no haya                
                // $ventas=Venta::where('Ven_Est','=','Válida')->get();
                //carga collection aunque sea 0              

                    // {{--@if($ventas[0]->Ven_Fe=='2021-03-14')
                    // $ventas
                    // @endif--}}    

                $ventas=Venta::where('Ven_Est','!=','Anulada')
                                ->where('Ven_Fe','>=',$inicio)->where('Ven_Fe','<=',$fin)->get();                    
            
                if($tipo=='detallado'){
                    $v_det=VentaDetalle::all();
                    $v_det_a=VentaDetalleArticulos::all();

                    $cobros=Cobro::all();
                    $cobros_det=CobroDetalle::all();
                }
                 
            }else if($de=='compra'){
                    $fin=$fin.' 23:59';
                $compras=Pago::where('created_at','>=',$inicio)->where('created_at','<=',$fin)->get();    
                $egresos=Compra::all();

                if($tipo=='detallado'){
                    $c_det=PagoDetalle::all();                                            
                }

            }else if($de=='todo'){
                // $ventas=Venta::where('Ven_Est','=','Válida')->get();
                $ventas=Venta::where('Ven_Est','!=','Anulada')
                            ->where('Ven_Fe','>=',$inicio)->where('Ven_Fe','<=',$fin)->get(); 
                    $fin=$fin.' 23:59';    
                $compras=Pago::where('created_at','>=',$inicio)->where('created_at','<=',$fin)->get();    
                $egresos=Compra::all();

                if($tipo=='detallado'){
                    $v_det=VentaDetalle::all();
                    $v_det_a=VentaDetalleArticulos::all();

                    $cobros=Cobro::all();
                    $cobros_det=CobroDetalle::all();

                    $c_det=PagoDetalle::all();                    
                }

            }                                       

            // return view("Admin.Informe_Listas.informe");            
            if($tipo=='detallado'){
                $informe='reporte_det';
            }else{
                $informe='reporte_simple';
            }
            
            $pdf=PDF::loadView("Admin.Informe_Listas.$informe",            
                compact('inicio','fin',
                        'ventas','v_det','v_det_a','clientes',
                        'compras','c_det','egresos',
                        'cobros','cobros_det','pagos','pagos_det',
                        'articulos'));   
                        
                if($de=='todo'){                                                        
                    if($tipo=='simple'){                             
                        $pdf=$pdf->setPaper('a4', 'landscape');
                    }                    
                }        
            
            return $pdf->stream();        

        }else{
            return view('Vend.restrincted');
        }
    }        
}