<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//tablas
use Tazper\PedidoProveedor;
 //detalle
use Tazper\PedidoProveedorDetalle;
use Tazper\PedidosProveedoresDetalleArticulos;
//relaciones
use Tazper\Sucursal;
use Tazper\PtoExpedicion;
use Tazper\Proveedor;
use Tazper\Medio_Pago;
use Tazper\Articulo;

use Tazper\User; 

use Tazper\OrdenCompra; 
use Tazper\OrdenCompraDetalle; 
use Tazper\OrdenCompraDetalleArticulos; 

use Tazper\Compra;

class PedidosProveedoresController extends Controller
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
            if($request->filtro){
                Session::put('filtro',$request->filtro);        
            }
            // Session::forget('filtro')
            
            if(Session::get('filtro')){            
                $filtro=Session::get('filtro');

                if($filtro=='Pendiente'){ //pendientes
                    $pedidos=PedidoProveedor::where('PedProv_Est','=',$filtro)
                                            ->orderBy('Id_PedProv','desc')->simplePaginate($paginacion=20); //feho
                    $cant=PedidoProveedor::where('PedProv_Est','=',$filtro)->count();                        
                }else{ //todos
                    $pedidos=PedidoProveedor::orderBy('Id_PedProv','desc')->simplePaginate($paginacion=20);                                      
                    $cant=PedidoProveedor::all()->count();    
                }    
            }else{ //no ajax...
                $pedidos=PedidoProveedor::orderBy('Id_PedProv','desc')->simplePaginate($paginacion=20);                                      
                $cant=PedidoProveedor::all()->count();

                $filtro='';
            }        
                $mostrados=$pedidos->count();
                $proveedores=Proveedor::all();    

                //ultima pagina
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
                    $view=view("$nivel.PedidoProveedor.js.paginas",compact('pedidos','cant','mostrados','lastPage','proveedores','filtro'))->renderSections();                
                    return response()->json([
                        'paginacion'=>$view['navegacion_1'],
                        'contenido'=>$view['contenido'],
                    ]);
                }

            return view("$nivel.PedidoProveedor.index",compact('pedidos','cant','mostrados','lastPage','proveedores','filtro'));
        }else{
            return view('Vend.restrincted');
        }
    }

    //AGREGAR
    public function create()
    {
        if(Auth::user()->Id_Prf==2){
            $proveedores=Proveedor::all();
            $med_pag=Medio_Pago::all();              
            $materiales=Articulo::all();
            
            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

            return view("$nivel.PedidoProveedor.create",compact('proveedores','materiales','med_pag'));
        }else{
            return view('Vend.restrincted');
        }
    }

        public function busca_proveedor(Request $request)
        {    
            $proveedores=Proveedor::where('Prov_Des','like',$request->busca_prov."%")
                                    ->orderBy('Prov_Des')->take(5)->get();

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.PedidoProveedor.js.cuadro.proveedor",compact("proveedores"));        
        }

        public function busca_articulo(Request $request)
        {
            $busqueda=$request->busca_material;        
            $materiales=Articulo::where('Art_DesLar','like',$busqueda."%")
                                ->orderBy('Art_DesLar')->take(10)->get();            

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }
                
            return view("$nivel.PedidoProveedor.js.cuadro.materiales",compact("materiales"));
        }

    public function store(Request $request)
    {        
            $this->validate($request, [                                          
                // 'Id_Suc' => 'required|integer|digits_between:1,1|min:1|max:1',
                // 'Id_PtoExp' => 'required|integer|digits_between:1,1|min:1|max:1',
                // 'PedProv_FeHo' => 'required|date',                
                // 'PedProv_ConPag' => 'required|string|min:7|max:7',
                // 'PedProv_MedPag' => 'required|string|min:8|max:8',
                // 'PedProv_Est' => 'required|string|min:8|max:9',
                
                'Id_Prov' => 'required|integer|digits_between:1,4|min:1|max:9999',
                'Id_MedPag' =>'required|integer|digits_between:1,2|min:1', 
                'PedProv_FeEnt' => 'required|date', 
                'PedProv_Obs' => 'max:140',     

                'Id_Art_1' => 'required|integer|digits_between:1,4|min:1|max:9999',
                'Art_Cant_1' => 'required|numeric|min:0|max:9999',                
                'Id_Art_2' => 'max:9999',
                'Art_Cant_2' => 'max:9999',
                'Id_Art_3' => 'max:9999',
                'Art_Cant_3' => 'max:9999',
                'Id_Art_4' => 'max:9999',
                'Art_Cant_4' => 'max:9999',
                'Id_Art_5' => 'max:9999',
                'Art_Cant_5' => 'max:9999',
                'Id_Art_6' => 'max:9999',
                'Art_Cant_6' => 'max:9999',
                'Id_Art_7' => 'max:9999',
                'Art_Cant_7' => 'max:9999',
                'Id_Art_8' => 'max:9999',
                'Art_Cant_8' => 'max:9999',
            ]); 

        //pedido
        $pedido=new PedidoProveedor;
            $pedido->Id_Suc=1;
            $pedido->Id_PtoExp=1;
            $pedido->PedProv_FeHo=\Carbon\Carbon::now();
            $pedido->PedProv_ConPag='Contado';
            // $pedido->PedProv_MedPag='Efectivo';            
            $pedido->PedProv_Est='Pendiente';
        
        $pedido->Id_Prov=$request->Id_Prov;
        $pedido->PedProv_FeEnt=$request->PedProv_FeEnt;            
        $pedido->Id_MedPag=$request->Id_MedPag;
        $pedido->PedProv_Obs=$request->PedProv_Obs;                                

            $pedido->PedProv_RegPor=Auth::user()->Id_Usu;
            $pedido->PedProv_RegUser=Auth::user()->Usu_User;                        
        $pedido->save();   

            //det
            $ult_pedprov=PedidoProveedor::latest()->first()->Id_PedProv;      
            
            $l=1;
            for($l==1; $l<=8; $l++){ //lineas det
                $art='Id_Art_'.$l;
                $cant='Art_Cant_'.$l;                

                if($request->$art!=''){
                    //detalle
                    $detalle=new PedidoProveedorDetalle;            
                        $detalle->Id_PedProv=$ult_pedprov;    
                        $detalle->PPD_ArtCant=$request->$cant;              
                    $detalle->save();     

                    //ppda
                    $pivot=new PedidosProveedoresDetalleArticulos;
                        $pivot->Id_PedProv=$ult_pedprov;
                        $pivot->Id_Art=$request->$art;                            
                    $pivot->save();                                    
                }
            }

            //Orden Compra
            $pedprov=PedidoProveedor::find($ult_pedprov);

                $pedprov_det=PedidoProveedorDetalle::where('Id_PedProv','=',$ult_pedprov)->get();
                $ppd_a=PedidosProveedoresDetalleArticulos::where('Id_PedProv','=',$ult_pedprov)->get();
                $articulos=Articulo::all();

                $i=0;
                $total=0;
                $totales=[];

                foreach($pedprov_det as $det){
                    foreach($articulos as $articulo){
                        if($articulo->Id_Art==$ppd_a[$i]->Id_Art){
                            $importe=$det->PPD_ArtCant*$articulo->Art_PreCom;                            
                        }
                    }                      
                    $i++;
                    $total+=$importe;
                    array_push($totales, $importe);                    
                }                

                $medios=Medio_Pago::all();

                foreach($medios as $medio){
                    if($pedprov->Id_MedPag==$medio->Id_MedPag){                        
                        $med=$medio->MedPag_Des;
                    }else{
                        $med='';
                    }
                }                   

                // $obs="Condición de pago: $pedprov->PedProv_ConPag\nMedio de pago: $med\n$pedprov->PedProv_Obs";  
                
                if($pedprov->PedProv_Obs){
                    $obs="Condición de pago: $pedprov->PedProv_ConPag, Medio de pago: $med, $pedprov->PedProv_Obs";  
                }else{
                    $obs="Condición de pago: $pedprov->PedProv_ConPag, Medio de pago: $med";  
                }                                

            $orden=new OrdenCompra;
                $orden->Id_PedProv=$ult_pedprov;
                $orden->Id_Prov=$pedprov->Id_Prov;
                $orden->OC_Fe=date('Y-m-d');
                $orden->Id_Suc=$pedprov->Id_Suc;
                $orden->Id_PtoExp=$pedprov->Id_PtoExp;
                $orden->OC_FeEnt=$pedprov->PedProv_FeEnt;
                $orden->OC_Obs=$obs;
                $orden->OC_Est=$pedprov->PedProv_Est;                                
                $orden->OC_SubTot=$total;                              
                
                $orden->OC_RegPor=$pedprov->PedProv_RegPor;
                $orden->OC_RegUser=$pedprov->PedProv_RegUser;             
            $orden->save();   

                //detalle
            $ult_oc=OrdenCompra::latest()->first();                              
            $j=0;
            foreach($pedprov_det as $det){
                $oc_det=new OrdenCompraDetalle;            
                    $oc_det->Id_OC=$ult_oc->Id_OC;    
                    $oc_det->OCD_ArtCant=$det->PPD_ArtCant;
                    $oc_det->OCD_ArtTot=$totales[$j];
                $oc_det->save();
                $j++;                                                                                                              
            }

                //pivot            
            foreach($ppd_a as $piv){
                $ocd_a=new OrdenCompraDetalleArticulos;
                    $ocd_a->Id_OC=$ult_oc->Id_OC;    
                    $ocd_a->Id_Art=$piv->Id_Art;                            
                $ocd_a->save();  
            }

        if(!$request->ajax()){                            
                Session::flash('pedprov_agregado','Registro agregado');
            return redirect("/PedidoProveedor");
        }
    }

    //MOSTRAR
    public function show($id)
    {
        if(Auth::user()->Id_Prf==2){
            try{
            $pedido=PedidoProveedor::findOrFail($id);
                $proveedor=Proveedor::findOrFail($pedido->Id_Prov);
                $sucursal=Sucursal::findOrFail($pedido->Id_Suc);
                $punto=PtoExpedicion::findOrFail($pedido->Id_PtoExp);  
                $medios_pag=Medio_Pago::all();          
                $users=User::all();     
                $oc=OrdenCompra::where('Id_PedProv','=',$id)->first()->Id_OC;
                $compra=Compra::where('Id_PedProv', '=', $id)->first(); //colecction, array, de arrays

                    if($compra){
                        $compra=$compra->Id_Com;                    
                    }else{
                        $compra='';
                    }
                
                if(Session::get('filtro')){             
                    $filtro=Session::get('filtro');
                    
                    if($filtro=='Pendiente'){                    
                        // ult time = id desc
                        $previous = PedidoProveedor::where('PedProv_Est','=',$filtro)
                            ->where('Id_PedProv', '>', $pedido->Id_PedProv)->min('Id_PedProv');
                        $next = PedidoProveedor::where('PedProv_Est','=',$filtro)
                            ->where('Id_PedProv', '<', $pedido->Id_PedProv)->max('Id_PedProv');                

                        // $previous = PedidoProveedor::where('PedProv_Est','=',$filtro)
                        //     ->where('PedProv_FeHo', '>', $pedido->PedProv_FeHo)->max('Id_PedProv');
                        // $next = PedidoProveedor::where('PedProv_Est','=',$filtro)
                        //     ->where('PedProv_FeHo', '<=', $pedido->PedProv_FeHo)->min('Id_PedProv');
                    }else{
                        $previous = PedidoProveedor::where('Id_PedProv', '>', $pedido->Id_PedProv)->min('Id_PedProv');
                        $next = PedidoProveedor::where('Id_PedProv', '<', $pedido->Id_PedProv)->max('Id_PedProv');

                        // $previous = PedidoProveedor::where('PedProv_FeHo', '>', $pedido->PedProv_FeHo)->max('Id_PedProv');
                        // $next = PedidoProveedor::where('PedProv_FeHo', '<=', $pedido->PedProv_FeHo)->min('Id_PedProv');
                    }
                }else{
                    $previous = PedidoProveedor::where('Id_PedProv', '>', $pedido->Id_PedProv)->min('Id_PedProv');
                    $next = PedidoProveedor::where('Id_PedProv', '<', $pedido->Id_PedProv)->max('Id_PedProv');

                    // $previous = PedidoProveedor::where('PedProv_FeHo', '>', $pedido->PedProv_FeHo)->max('Id_PedProv');
                    // $next = PedidoProveedor::where('PedProv_FeHo', '<=', $pedido->PedProv_FeHo)->min('Id_PedProv');
                }
                // evitar comparar con sigo mismo            

            $detalles=PedidoProveedorDetalle::where('Id_PedProv','=',$id)->get();       
            $det_art=PedidosProveedoresDetalleArticulos::where('Id_PedProv','=',$id)->get();   
                $articulos=Articulo::all();       
            
                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }
            
            return view("$nivel.PedidoProveedor.show",compact("pedido",'previous','next','medios_pag','oc','compra',
                    'proveedor','sucursal','punto','users','detalles','det_art','articulos','filtro'));
            }catch(ModelNotFoundException $e){   
                return back();
            }
        }else{
            return view('Vend.restrincted');
        }
    }

    //ELIMINAR
    public function destroy(Request $request, $id)
    {                             
            // Compra::where('Id_PedProv','=',$id)->delete();
            Compra::where('Id_PedProv','=',$id)->update(['Id_PedProv'=>NULL,'Id_OC'=>NULL]);
            //if [0]

            OrdenCompra::where('Id_PedProv','=',$id)->delete();        
        
        $pedido=PedidoProveedor::findOrFail($id);
            $estado=$pedido->PedProv_Est;            
        $pedido->delete();  
                        

        if(!$request->ajax()){                            
            if($estado=='Pendiente'){
                Session::flash('pedprov_cancelado','Registro cancelado');
            }else{
                Session::flash('pedprov_eliminado','Registro eliminado');
            }                                

            return redirect("/PedidoProveedor");
        }
    }
}