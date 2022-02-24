<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//tablas
use Tazper\PedidoCliente;
 //detalle
use Tazper\PedidoClienteDetalle;
use Tazper\PedidoClienteDetalleArticulos;
//relaciones
use Tazper\Sucursal;
use Tazper\PtoExpedicion;
use Tazper\Cliente;
use Tazper\Descuento;
use Tazper\DescuentoDetalle;
use Tazper\Medio_Pago;
use Tazper\Articulo;

use Tazper\User; 

use Tazper\Venta;

use Tazper\ListaPrecio;

class PedidosClientesController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }

    //LISTADO
    public function index(Request $request)
    {                        
        if($request->filtro){
            Session::put('filtro',$request->filtro);        
        }        
        
        if(Session::get('filtro')){            
            $filtro=Session::get('filtro');

            if($filtro=='Pendiente'){ //pendientes
                $pedidos=PedidoCliente::where('PedCli_Est','=',$filtro)
                                        ->orderBy('Id_PedCli','desc')->simplePaginate($paginacion=20); //feho
                $cant=PedidoCliente::where('PedCli_Est','=',$filtro)->count();                        
            }else{ //todos
                $pedidos=PedidoCliente::orderBy('Id_PedCli','desc')->simplePaginate($paginacion=20);                                      
                $cant=PedidoCliente::all()->count();    
            }    
        }else{ //no ajax
            $pedidos=PedidoCliente::orderBy('Id_PedCli','desc')->simplePaginate($paginacion=20);                                      
            $cant=PedidoCliente::all()->count();

            $filtro='';
        }        
            $mostrados=$pedidos->count();
            $clientes=Cliente::all(); 
            $listas=ListaPrecio::all(); 

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
                $view=view("$nivel.PedidoCliente.js.paginas",compact('pedidos','cant','mostrados','lastPage','clientes','filtro','listas'))->renderSections();                
                return response()->json([
                    'paginacion'=>$view['navegacion_1'],
                    'contenido'=>$view['contenido'],
                ]);
            }

        return view("$nivel.PedidoCliente.index",compact('pedidos','cant','mostrados','lastPage','clientes','filtro','listas'));
    }

    //AGREGAR
    public function create()
    {
        $clientes=Cliente::all();
        $med_pag=Medio_Pago::all();              
        $productos=Articulo::where('Art_Tip','=','Producto')->get();        
        $listas=ListaPrecio::all();        
        
        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.PedidoCliente.create",compact('clientes','productos','med_pag','listas'));        
    }

        public function busca_cliente(Request $request)
        {    
            $clientes=Cliente::where('Cli_Nom','like',"%".$request->busca_cli."%")
                                ->orWhere('Cli_Ape','like',"%".$request->busca_cli."%")
                                ->orderBy('Id_Cli')->take(5)->get();
            $listas=ListaPrecio::all();                                 

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.PedidoCliente.js.cuadro.clientes",compact("clientes",'listas'));        
        }

        public function busca_producto(Request $request)
        {
            $busqueda=$request->busca_prod;        
            $productos=Articulo::where('Art_Tip','=','Producto')->where('Art_DesLar','like',$busqueda."%")
                                ->orderBy('Id_Art')->take(10)->get();            

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }
                
            return view("$nivel.PedidoCliente.js.cuadro.productos",compact("productos"));
        }

    public function store(Request $request)
    {        
            $this->validate($request, [ //da igual para ajax, request                                                                          
                'Id_Cli' => 'required|integer|digits_between:1,4|min:1|max:9999',                
                'PedCli_Tip' => 'required|string|min:9|max:9',
                'PedCli_FeEnt' => 'required|date',
                'PedCli_CondCob' => 'required|string', //
                'Id_MedPag' =>'required|integer|digits_between:1,2|min:1', 
                'PedCli_Obs' => 'max:140',     

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
        $pedido=new PedidoCliente;
            $pedido->Id_Suc=1;
            $pedido->Id_PtoExp=1;
            $pedido->PedCli_FeHo=\Carbon\Carbon::now();
            $pedido->Id_Cli=$request->Id_Cli;
            $pedido->PedCli_CliLp=$request->PedCli_CliLp;
            $pedido->PedCli_CliDesc=substr($request->PedCli_CliDesc,0,-1);
            $pedido->PedCli_Tip=$request->PedCli_Tip; //
            $pedido->PedCli_FeEnt=$request->PedCli_FeEnt;        
            $pedido->PedCli_CondCob=$request->PedCli_CondCob;        
            $pedido->Id_MedPag=$request->Id_MedPag;
            $pedido->PedCli_Est='Pendiente';                                                
            $pedido->PedCli_Obs=$request->PedCli_Obs;                                

            $pedido->PedCli_RegPor=Auth::user()->Id_Usu;
            $pedido->PedCli_RegUser=Auth::user()->Usu_User;                        
        $pedido->save();   
        //todo, metodo uno a uno, ej update

            //det
            $ult_PedCli=PedidoCliente::latest()->first()->Id_PedCli;      
            
            $l=1;
            for($l==1; $l<=8; $l++){ //lineas det
                $art='Id_Art_'.$l;
                $cant='Art_Cant_'.$l;                

                if($request->$art!=''){
                    //detalle
                    $detalle=new PedidoClienteDetalle;            
                        $detalle->Id_PedCli=$ult_PedCli;    
                        $detalle->PCD_ArtCant=$request->$cant;          
                        // //may    
                        // if($request->$cant>=15){
                        //     $detalle->Id_Desc=1;                                      
                        // }
                        // // else{
                        // //     $detalle->Id_Desc=1;                                      
                        // // }
                    $detalle->save();     

                    //ppda
                    $pivot=new PedidoClienteDetalleArticulos;
                        $pivot->Id_PedCli=$ult_PedCli;
                        $pivot->Id_Art=$request->$art;                            
                    $pivot->save();                                    
                }
            }            

        // if(!$request->ajax()){                            
                Session::flash('pedcli_agregado','Registro agregado');
            return redirect("/PedidoCliente");
        // }
    }

    //MOSTRAR
    public function show($id)
    {
        try{
        $pedido=PedidoCliente::findOrFail($id);
            $cliente=Cliente::findOrFail($pedido->Id_Cli);
            $sucursal=Sucursal::findOrFail($pedido->Id_Suc);
            $punto=PtoExpedicion::findOrFail($pedido->Id_PtoExp);  
            $medios_pag=Medio_Pago::all();          
            $users=User::all();     
            $listas=ListaPrecio::all();   
                // $desc=Descuento::where('Desc_Des','=','Mayorista')->get()[0]->Id_Desc;  
                // $mayorista=DescuentoDetalle::where('Id_Desc','=',$desc)->get(); //
                // $mayorista=$mayorista->get(0)->DD_Porc; 
                // get es coleccion, aunque sea un elemento, debes entrar
            
            $venta=Venta::where('Id_PedCli', '=', $id)->first(); //colecction, array, de arrays
            //pedcli

                if($venta){
                    $venta=$venta->Id_Ven;                    
                }else{
                    $venta='';
                }
            
            if(Session::get('filtro')){             
                $filtro=Session::get('filtro');
                
                if($filtro=='Pendiente'){                    
                    // ult time = id desc
                    $previous = PedidoCliente::where('PedCli_Est','=',$filtro)
                        ->where('Id_PedCli', '>', $pedido->Id_PedCli)->min('Id_PedCli');
                    $next = PedidoCliente::where('PedCli_Est','=',$filtro)
                        ->where('Id_PedCli', '<', $pedido->Id_PedCli)->max('Id_PedCli');                                    
                }else{
                    $previous = PedidoCliente::where('Id_PedCli', '>', $pedido->Id_PedCli)->min('Id_PedCli');
                    $next = PedidoCliente::where('Id_PedCli', '<', $pedido->Id_PedCli)->max('Id_PedCli');                    
                }
            }else{
                $previous = PedidoCliente::where('Id_PedCli', '>', $pedido->Id_PedCli)->min('Id_PedCli');
                $next = PedidoCliente::where('Id_PedCli', '<', $pedido->Id_PedCli)->max('Id_PedCli');                
            }            

        $detalles=PedidoClienteDetalle::where('Id_PedCli','=',$id)->get();       
        $det_art=PedidoClienteDetalleArticulos::where('Id_PedCli','=',$id)->get();   
            $articulos=Articulo::all();       
        
            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }
        
        return view("$nivel.PedidoCliente.show",compact("pedido",'previous','next','medios_pag','venta',
                'cliente','sucursal','punto','users','detalles','det_art','articulos','filtro','listas'));
        }catch(ModelNotFoundException $e){   
            return back();
        }
    }

    //ELIMINAR
    public function destroy(Request $request, $id)
    {                             
            // Venta::where('Id_PedCli','=',$id)->delete();    
            Venta::where('Id_PedCli','=',$id)->update(['Id_PedCli'=>NULL]);
            //if [0]                   
        
        $pedido=PedidoCliente::findOrFail($id);
            $estado=$pedido->PedCli_Est;            
        $pedido->delete();                          

        if(!$request->ajax()){                            
            if($estado=='Pendiente'){
                Session::flash('pedcli_cancelado','Registro cancelado');
            }else{
                Session::flash('pedcli_eliminado','Registro eliminado');
            }                                

            return redirect("/PedidoCliente");
        }
    }
}