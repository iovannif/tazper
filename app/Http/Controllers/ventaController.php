<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Session;

use PDF;

//tablas
use Tazper\Venta;
use Tazper\VentaDetalle;
//relaciones
use Tazper\Arqueo;

use Tazper\User; use Auth;
 //detalle
use Tazper\Articulo;


//compras--------------------
use Tazper\Compra;
use Tazper\CompraDetalle;
//relaciones
use Tazper\FacturacionDetalle;
use Tazper\Sucursal;
use Tazper\PtoExpedicion;
use Tazper\Caja;
use Tazper\Proveedor;
use Tazper\PedidoProveedor;
use Tazper\OrdenCompra;
 //detalle
use Tazper\Impuesto;

class VentasController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //LISTADO
    public function index()
    {
        $ventas=Venta::simplePaginate(1);
        $mostrados=$ventas->count();
        $cant=Venta::all()->count();

        if($mostrados!=0){
            if($mostrados%2){
                $lastPage=ceil($cant/$mostrados);
            }else{
                $lastPage=floor($cant/$mostrados);
            }
        }else{
            $lastPage=1;
        }

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Ventas.index",compact('ventas','cant','mostrados','lastPage'));
    }

    //AGREGAR
    public function create()
    {
        $ult_arq=Arqueo::orderBy('Id_Arq', 'DESC')->first();

        if($ult_arq && $ult_arq->Arq_Est=='Abierto'){        
            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

            return view("$nivel.Ventas.create");
        }else{
            Session::flash('abrir_caja','Cerrada');
            return back();
        }
    }

    public function store(Request $request)
    {   
        //Registro:
        $entrada=$request->all();
        Venta::create($entrada);

        //detalle
        $i=1;
        for($i==1; $i<=8; $i++){
            $art='Articulo_'.$i;
            if($request->$art!=""){
                $detalle=new VentaDetalle;
                $last_record=Venta::latest()->first();
                $detalle->Id_Com=$last_record->Id_Com;
                $detalle->Articulo=$request->$art;
                $detalle->save();
            }
        }

        $venta=Venta::latest()->first();
        $venta->update(['Com_RegPor'=>Auth::user()->Id_Usu]);
        
        //Redireccion:
        //ultima pagina
        $ventas=Venta::simplePaginate(1);
        $mostrados=$ventas->count();
        $cant=Venta::all()->count();        
        if($mostrados%2){
            $lastPage=ceil($cant/$mostrados);
        }else{
            $lastPage=floor($cant/$mostrados);
        }

        return redirect("/Ventas"."?page=$lastPage");

        // se genera pago

        //-----------------
        return redirect("Ventas/factura/$ult_ven->Id_Ven");
    }

    public function factura($id)
    {       
        if(Venta::find($id)){
            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }
    
            $pdf=PDF::loadView("$nivel.Ventas.factura",compact('id'));        
            return $pdf->stream();                       

            // return view("$nivel.Compras.factura");
        }else{
            return back();
        }        
    }
    
    //MOSTRAR
    // public function show($id)
    // {
    //     $venta=Venta::findOrFail($id); 
    //     $venta_det=VentaDetalle::where('Id_Ven', '=', $id)->get();
    //     $articulos=Articulo::all();
    //         // $previous = Venta::where('Id_Com', '<', $venta->Id_Com)->max('Id_Com');
    //         // $next = Venta::where('Id_Com', '>', $venta->Id_Com)->min('Id_Com');

    //         if(Auth::user()->Id_Prf==2){
    //             $nivel='Admin';
    //         }else if(Auth::user()->Id_Prf==1){
    //             $nivel='Vend';
    //         }

    //     return view("$nivel.Ventas.show",compact("venta","venta_det",'articulos'));
    // }

    public function show($id)
    {
        $proveedores=Proveedor::all();
        $compra=Compra::findOrFail($id); 
        $compra_det=CompraDetalle::all();
            $previous = Compra::where('Id_Com', '<', $compra->Id_Com)->max('Id_Com');
            $next = Compra::where('Id_Com', '>', $compra->Id_Com)->min('Id_Com');

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Ventas.show",compact("compra","compra_det",'previous','next','proveedores'));
    }

    //informe    
    public function informe($id)
    {
        if(Venta::find($id)){
            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }
    
            $pdf=PDF::loadView("$nivel.Cobros.informe",compact('id'));        
            return $pdf->stream();                       
        }else{
            return back();
        }        
    }
}
