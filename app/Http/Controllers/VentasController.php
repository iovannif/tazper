<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDF;
use Carbon\Carbon;

//modelos
use Tazper\Venta;
use Tazper\VentaDetalle;
use Tazper\VentaDetalleArticulos;
//relaciones
use Tazper\Sucursal;
use Tazper\PtoExpedicion;
use Tazper\Arqueo;
use Tazper\Cliente;
use Tazper\PedidoCliente;
use Tazper\Timbrado;
use Tazper\TimbradoDetalle;
use Tazper\Descuento;
use Tazper\Medio_Pago;
use Tazper\User;
 //detalles
use Tazper\Articulo;
use Tazper\Impuesto;

use Tazper\PedidoClienteDetalle;
use Tazper\PedidoClienteDetalleArticulos;

use Tazper\Cobro;
use Tazper\CobroDetalle;
use Tazper\Caja;

use Tazper\ListaPrecio;

use Tazper\Categoria;
use Tazper\DescuentoDetalle;

class VentasController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //LISTADO
    public function index(Request $request)
    {
        $ventas=Venta::orderBy('Id_Ven','desc')->simplePaginate($paginacion=20);
            $mostrados=$ventas->count();
            $cant=Venta::all()->count();
            $clientes=Cliente::all();
                $listas=ListaPrecio::all();

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
                $view=view("$nivel.Ventas.js.paginas",compact('ventas','cant','mostrados','lastPage','clientes'))->renderSections();                
                return response()->json([
                    'paginacion'=>$view['navegacion_1'],
                    'contenido'=>$view['contenido'],
                ]);
            }

        return view("$nivel.Ventas.index",compact('ventas','cant','mostrados','lastPage','clientes','listas'));
    }

        //resultados
        public function buscador(Request $request)
        {
            if($request->busqueda!=''){
                Session::put('busqueda',$request->busqueda);
            }            
            $busqueda=Session::get('busqueda');                        

            $resultados=Venta::where('Ven_Fe','like',"%".$busqueda."%")
                            ->orderBy('Id_Ven','desc')
                            ->simplePaginate($paginacion=20);
                $count=$resultados->count();                
                $todos=Venta::where('Ven_Fe','like',"%".$busqueda."%")->count();    
                $clientes=Cliente::all();                    

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

            $view=view("$nivel.Ventas.js.resultados",compact("resultados",'count','todos','lastPage','clientes'))->renderSections(); //,'paginacion'
            return response()->json([
                'paginacion'=>$view['navegacion_1'],
                'contenido'=>$view['contenido'],
            ]);
        }

        public function filtros(Request $request)
        {                                                    
            $ven_fe=$request->ven_fe;
            $id_ven=$request->id_ven;
            $ven_fact=$request->ven_fact;
            $ven_tip=$request->ven_tip;
            $ven_cli=$request->ven_cli;
                // $ven_cliLp=$request->ven_cliLp;
                // $ven_cliDesc=$request->ven_cliDesc;
            $ven_est=$request->ven_est;                            

            $resultados=Venta::orderBy('Id_Ven','desc');  
            $todos=Venta::orderBy('Id_Ven','desc');              
                $clientes=Cliente::all();                                              

            //Filtros
            // fecha                                                                                                
            if($ven_fe){
                if($ven_fe!='""'){
                    Session::put('ven_fe',$ven_fe);                                                                     
                }else{
                    Session::forget('ven_fe');
                } 
            } 
                if(Session::get('ven_fe')){
                    $resultados=$resultados->where('Ven_Fe','like',Session::get('ven_fe')); 
                    $todos=$todos->where('created_at','like',Session::get('ven_fe')); 
                }

            //id ven
            if($id_ven){
                if($id_ven!='""'){
                    Session::put('id_ven',$id_ven);                                                                     
                }else{
                    Session::forget('id_ven');
                } 
            } 
                if(Session::get('id_ven')){
                    $resultados=$resultados->where('Id_Ven','like',"%".Session::get('id_ven')."%");  
                    $todos=$todos->where('Id_Ven','like',"%".Session::get('id_ven')."%"); 
                }                 

            //fact
            if($ven_fact){
                if($ven_fact!='""'){
                    Session::put('ven_fact',$ven_fact);                                                                     
                }else{
                    Session::forget('ven_fact');
                }             
            }
                if(Session::get('ven_fact')){
                    $resultados=$resultados->where('Ven_Fact','like',"%".Session::get('ven_fact')."%"); 
                    $todos=$todos->where('Ven_Fact','like',"%".Session::get('ven_fact')."%"); 
                }            

            // tipo
            if($ven_tip){
                if($ven_tip!='""'){
                    Session::put('ven_tip',$ven_tip);                                                                     
                }else{
                    Session::forget('ven_tip');
                } 
            } 
                if(Session::get('ven_tip')){
                    $resultados=$resultados->where('Ven_Tip','like',Session::get('ven_tip')."%");  
                    $todos=$todos->where('Ven_Tip','like',Session::get('ven_tip')."%"); 
                }
            
                ////cliente
                // if($ven_cli!='""'){                          
                //     // foreach($clientes as $cli){
                //     //     if(strtolower($ven_cli)==strtolower($cli->Cli_Nom) ||
                //     //     strtolower($ven_cli)==strtolower($cli->Cli_Ape)){
                //     //         $ven_cli=$cli->Id_Cli;
                //     //     }
                //     // }

                //     Session::put('ven_cli',$ven_cli);                            
                //     $ven_cli=Session::get('ven_cli');        

                //     $resultados=$resultados->where('Id_Cli','like',"%".$ven_cli."%");            
                //     $todos=$todos->where('Id_Cli','like',"%".$ven_cli."%");                                                                         
                // }

            // // cli
            // if($ven_cli){
            //     if($ven_cli!='""'){
            //         Session::put('ven_cli',$ven_cli);                                                                     
            //     }else{
            //         Session::forget('ven_cli');
            //     } 
            // } 
            //     if(Session::get('ven_cli')){
            //         $resultados=$resultados->where('Id_Cli','like',Session::get('ven_cli'));  
            //         $todos=$todos->where('Id_Cli','like',Session::get('ven_cli')); 
            //     }

                // cli nom
                if($ven_cli){
                    if($ven_cli!='""'){
                        Session::put('ven_cli',$ven_cli);                                                                     
                    }else{
                        Session::forget('ven_cli');
                    } 
                }else{
                    $id_clientes=[];
                    $ventas_cli=[];
                } 
                    if(Session::get('ven_cli')){
                            // $resultados=''; 
                            
                            //clientes
                            $clientes=Cliente::where('Cli_Nom','like',Session::get('ven_cli')."%")
                                            ->orWhere('Cli_Ape','like',Session::get('ven_cli')."%")
                                            ->get();                                             
                            $id_clientes=[];                                        
                            foreach($clientes as $cli){
                                array_push($id_clientes,$cli->Id_Cli);
                            }                        

                        //ventas
                        $ventas=Venta::all();
                        $ventas_cli=[];                                     
                        foreach($ventas as $venta){
                            foreach($id_clientes as $id_cli){
                                if($venta->Id_Cli==$id_cli){                                    
                                    array_push($ventas_cli,$venta->Id_Ven);                                
                                    // array_push($ventas_cli,$venta);  
                                }                                
                            }
                        }         
                        
                        if(empty($ventas_cli==1)){
                            // $c = new Collection;                
                            // $resultados = collect([]);
                            // $todos='';
                        }
                                                                        
                            // $id_clientes=collect($clientes);
                            // $resultados=$resultados->get();     
                            
                            //unset forget :/                                                                                                                  
                       
                            $clientes=Cliente::all();      
                    }

                // categoria cli                    

                // descuento cat cli
                
            // estado
            if($ven_est){
                if($ven_est!='""'){
                    Session::put('ven_est',$ven_est);                                                                     
                }else{
                    Session::forget('ven_est');
                } 
            } 
                if(Session::get('ven_est')){
                    $resultados=$resultados->where('Ven_Est','like',Session::get('ven_est')."%");  
                    $todos=$todos->where('Ven_Est','like',Session::get('ven_est')."%"); 
                } //al comparar un con var que no existe,trae como está //ej sesion id_ven                        

            
            $resultados=$resultados->simplePaginate($paginacion=20);
            $count=$resultados->count();
            $todos=$todos->count();            
            
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
                
                    // if(empty($ventas_cli)==1){
                    //     $re='resultados';
                    // }else{
                    //     $re='resultados_cli';
                    // }

            $view=view("$nivel.Ventas.js.resultados", //$re
                        compact("resultados",'count','todos','lastPage','clientes'
                                ,'id_clientes','ventas','ventas_cli'))->renderSections(); //,'paginacion' 
            return response()->json([
                'paginacion'=>$view['navegacion_1'],
                'contenido'=>$view['contenido'],
            ]);
        }

    // //REGISTRAR   
    public function create()
    {
            $timbrados=Timbrado::all();
            foreach($timbrados as $tim){
                if($tim->Timb_FinVig==Carbon::today()->toDateString()){
                    $tim->update([                
                        'Timb_Est'=>'Expirado'
                    ]);
                }
            }

        $ult_arq=Arqueo::orderBy('Id_Arq', 'DESC')->first();            
        
        if($ult_arq && $ult_arq->Arq_Est=='Abierto'){ //valida           
            $sucursal=Sucursal::find(1);
            $punto=PtoExpedicion::find(1);
            $arqueo=$ult_arq->Id_Arq;
            $caja=Caja::find(1);
            $med_pag=Medio_Pago::all();             

            //venta
            $ult_ven=Venta::latest()->first(); //lrvl //saca de una coleccion          
            if($ult_ven){
                $venta=$ult_ven->Id_Ven+1;
            }else{
                $venta=1;                                        
            }

            //fact
            $timb=Timbrado::where('Timb_Est','=','Activo')->get();                
            if($timb->count()>0){ //crea coleccion aunque sea de 0
                $timb=$timb[0];

                $ult_fact=TimbradoDetalle::orderBy('TD_FactCod', 'DESC')->first(); //uno

                if($ult_fact){
                    if($ult_fact->TD_FactCod+1 <= $timb->Timb_FinFact){ //rang
                        $factura=$ult_fact->TD_FactCod+1;
                    }else{
                        $timb->update([
                            'Timb_Est'=>'Agotado'
                        ]);
                        Session::flash('limite','Limite de timbrado');
                        return back();
                        // limite de facturacion                        
                    }                                        
                }else{    
                    $factura=$timb->Timb_IniFact;                                            
                }   
            }else{
                    // $timb='';
                    Session::flash('timbrado','No hay timbrado');
                return back();
                // no hay timbrado
            }                                                    

            //desc
            $desc=Descuento::where('Desc_Est','=','Activado')->get(); //El Activado  
            if($desc->count()>0){
                // if($desc[0]->Desc_Des!='Mayorista'){ //() function must be a string
                    
                    //Del Descuento Activado:
                    $descuento=$desc[0]->Desc_Des; //nombre
                    $id_desc=$desc[0]->Id_Desc; // id                    
                    $desc_det=DescuentoDetalle::where('Id_Desc','=',$id_desc)->get(); //lineas

                // }else{
                //     $descuento='';    
                //     $id_desc='';    
                //     $desc_det='';                
                // }

            }else{ //No hay Activado (Sin Descuento día)
                $descuento=''; 
                $id_desc='';                                
                $desc_det='';
            }            

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.Ventas.create",
                compact('punto','sucursal','arqueo','caja','venta','timb','factura','med_pag',
                        'descuento','id_desc','desc_det'));

        }else{
                Session::flash('abrir_caja','Cerrada');
            return back();
        }        
    }        
    
        public function busca_cliente(Request $request)
        {    
            $clientes=Cliente::where('Cli_Nom','like',"%".$request->busca_prov."%")
                            ->orWhere('Cli_Ape','like',"%".$request->busca_prov."%")
                            ->orderBy('Id_Cli')->take(5)->get();
            $listas=ListaPrecio::all();     
            
            //descuent dia (lp cli)   

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.Ventas.js.cuadro.proveedor",compact("clientes",'listas'));        
        }
        
        public function busca_producto(Request $request)
        {
            $impuestos=Impuesto::all();
            $articulos=Articulo::where('Art_Tip','=','Producto')
                ->where('Art_DesLar','like',$request->busqueda."%")->orderBy('Id_Art')->take(10)->get();
            $categorias=Categoria::all();

                //descuent dia (prod cat)
                
                if(Auth::user()->Id_Prf==2){ //el archivo
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.Ventas.js.cuadro.productos",compact("articulos",'impuestos','categorias'));
        }

        public function busca_pedido(Request $request) //fetch
        {    
            $pedido=PedidoCliente::find($request->busca_ped);

            if($pedido && $pedido->PedCli_Est=='Pendiente'){ //si existe el registro            
                $cliente=Cliente::find($pedido->Id_Cli);                
                $listas=ListaPrecio::all();             
                    $detalles=PedidoClienteDetalle::where('Id_PedCli','=',$request->busca_ped)->get();
                    $det_art=PedidoClienteDetalleArticulos::where('Id_PedCli','=',$request->busca_ped)->get();
                        $articulos=Articulo::all();
            }else{
                $pedido='';
            }

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.Ventas.js.cuadro.pedido",compact("cliente",'detalles','det_art','articulos','pedido','listas'));        
        } // public function pedido_productos(Request $request){}
        
    public function store(Request $request) //guarda venta
    {   
            $this->validate($request, [                                          
                'Id_Timb' => 'required|integer',
                'Ven_Fact' => 'required|string|max:7|unique:Ventas',
                'Ven_Tip' => 'required|string|max:9',                
                'Id_Cli' => 'required|integer|min:1',                                                         
                'cli_cat' => 'required|string|max:20', //                                                         
                'cli_desc' => 'required',                                                        
                // cond
                'Id_MedPag' => 'required|integer|digits_between:1,2|min:1',                                                         

                'Id_Art_1' => 'required|integer|digits_between:1,4|min:1|max:9999',
                'Art_Cant_1' => 'required|integer|min:1|max:9999',                
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

                'Com_Total'=>'required|integer|digits_between:3,7|min:500|max:9999999',               
            ]);     

            $arq=Arqueo::orderBy('Id_Arq', 'DESC')->first()->Id_Arq;           
        
        $venta=new Venta;
        //cabecera
            $venta->Ven_Fe=date('Y-m-d');
            $venta->Ven_Ho=date('H:i');
            $venta->Id_Suc=1;
            $venta->Id_PtoExp=1;
            $venta->Id_Arq=$arq;
            $venta->Id_Timb=$request->Id_Timb;
            $venta->Ven_Fact=str_pad($request->Ven_Fact, 7, "0", STR_PAD_LEFT);                        
            $venta->Ven_Tip=$request->Ven_Tip;                                    
                //referencia a fk //debe existir el reg en esa tabla
                if($request->Id_PedCli!=''){ 
                    $venta->Id_PedCli=$request->Id_PedCli; //vent pedcli     
                }                                                            
            $venta->Id_Cli=$request->Id_Cli;     
            $venta->Ven_CliLp=$request->cli_cat;     
            $venta->Ven_CliDesc=rtrim($request->cli_desc,'%');                        
            $venta->Ven_DescDia=$request->desc_des;            
            $venta->Ven_CondCob='Contado';
            $venta->Id_MedPag=$request->Id_MedPag;            
            $venta->Ven_Est='Válida';         
        //total
            $venta->Ven_StExe=$request->Com_StExe;
            $venta->Ven_St5=$request->Com_St5;
            $venta->Ven_St10=$request->Com_St10;                
            $venta->Ven_Tot=$request->Com_Total;            
            $venta->Ven_Liq5=$request->Com_Liq5;
            $venta->Ven_Liq10=$request->Com_Liq10;
            $venta->Ven_TotIva=$request->Com_TotIva;

            $venta->Ven_RegPor=Auth::id();
            $venta->Ven_RegUser=Auth::user()->Usu_User;
        $venta->save();         

            $ult_venta=Venta::latest()->first();
        
        //detalle                       
            $l=1;
            for($l==1; $l<=8; $l++){
                $art='Id_Art_'.$l;
                $cant='Art_Cant_'.$l;
                $pre='Pre_Art_'.$l;
                $exen='Art_Exen_'.$l;
                $iva5='Art_Iva5_'.$l;
                $iva10='Art_Iva10_'.$l;

                if($request->$art!=''){
                    //det
                    $detalle=new VentaDetalle;            
                        $detalle->Id_Ven=$ult_venta->Id_Ven;    
                        $detalle->VD_ArtCant=$request->$cant;              
                                    
                        $detalle->VD_ArtPre=$request->$pre;              
                        $detalle->Id_Desc=$request->Id_Desc;              
                        $detalle->VD_ArtDesc=$request->porc;

                        $detalle->VD_ArtExen=$request->$exen;              
                        $detalle->VD_ArtIva5=$request->$iva5;              
                        $detalle->VD_ArtIva10=$request->$iva10;              
                    $detalle->save(); 
                    
                    //piv
                    $pivot=new VentaDetalleArticulos;
                        $pivot->Id_Ven=$ult_venta->Id_Ven;    
                        $pivot->Id_Art=$request->$art;                            
                    $pivot->save();

                        //stock
                        $producto=Articulo::find($request->$art);                        
                            $stock=$producto->Art_St-$request->$cant;            
                        $producto->update(['Art_St'=>$stock]);

                            $producto->update(['Art_MdfPor'=>Auth::user()->Id_Usu,
                                            'Art_MdfUser'=>Auth::user()->Usu_User]);  
                }
            }
        
        // se genera cobro                                                     
        $cobro=new Cobro;    
            $cobro->Id_Cob=$ult_venta->Id_Ven;      
            $cobro->Id_Ven=$ult_venta->Id_Ven;      
            $cobro->Cob_Est='Válido';              

            $cobro->Cob_RegPor=$ult_venta->Ven_RegPor;      
            $cobro->Cob_RegUser=$ult_venta->Ven_RegUser;           
        $cobro->save();         
                
        //pag det 
            $det=VentaDetalle::where('Id_Ven','=',$ult_venta->Id_Ven)->get();
            $piv=VentaDetalleArticulos::where('Id_Ven','=',$ult_venta->Id_Ven)->get(); 
            $articulos=Articulo::all();          
            $i=0;

        foreach($det as $ven_det){            
            foreach($articulos as $articulo){              
                if($articulo->Id_Art==$piv[$i]->Id_Art){ //art           
                    $cob_det=new CobroDetalle;    
                        $cob_det->Id_Cob=$ult_venta->Id_Ven;
                        $cob_det->CD_Art=$articulo->Art_DesLar;
                        $cob_det->CD_ArtPre=$articulo->Art_PreVen;
                        $cob_det->CD_ArtCant=$ven_det->VD_ArtCant;
                        $cob_det->CD_ArtDesc=$ven_det->VD_ArtDesc;
                        
                        if($ven_det->VD_ArtExen!=''){
                            $cob_det->CD_ArtTot=$ven_det->VD_ArtExen;
                        }else if($ven_det->VD_ArtIva5!=''){
                            $cob_det->CD_ArtTot=$ven_det->VD_ArtIva5;
                        }else if($ven_det->VD_ArtIva10!=''){
                            $cob_det->CD_ArtTot=$ven_det->VD_ArtIva10;
                        }                                                
                    $cob_det->save();    
                }
            } 
            $i++;            
        }                                            

            //compra
            $id_cob=Cobro::latest()->first()->Id_Cob;
            $ult_venta->update([
                'Id_Cob'=>$id_cob
            ]);

            //ped
            if($ult_venta->Id_PedCli!=''){
                $pedido=PedidoCliente::find($ult_venta->Id_PedCli);                
                $pedido->update([
                    'PedCli_Est'=>'Entregado'
                ]);                
            }

            //fondo
            $caja=Caja::find(1);                                                      
            $caja->update([
                'Caj_Fon'=>$caja->Caj_Fon+$ult_venta->Ven_Tot
            ]);                                          
                
        //facturar            
            $num=TimbradoDetalle::all()->count()+1;

        $factura=new TimbradoDetalle;
            $factura->Id_Timb=$request->Id_Timb;
            $factura->TD_NroFact=$num;
            $factura->TD_FactCod=$request->Ven_Fact;
            $factura->Id_Ven=$ult_venta->Id_Ven;
            $factura->TD_FactEst='Válida';
        $factura->save();            

        //cli lp cant vent
        $cli_ventas=Venta::where('Id_Cli','=',$request->Id_Cli)
                        ->where('Ven_Est','=','Válida')
                        ->count();
        $cli=Cliente::find($request->Id_Cli);

        if($cli_ventas>=15 && $cli_ventas<30){
            if($cli->Id_Lp!=2){
                $cli->update([
                    'Id_Lp'=>2
                ]);    
            }
        }else if($cli_ventas>=30){            
            if($cli->Id_Lp!=3){
                $cli->update([
                    'Id_Lp'=>3
                ]);
            }
        }

        return redirect("Ventas/factura/$ult_venta->Id_Ven");        
    }    

    public function factura($id)
    {       
        if($venta=Venta::find($id)){            
            $detalles=VentaDetalle::where('Id_Ven','=',$id)->get(); //varios, colecta
            $pivot=VentaDetalleArticulos::where('Id_Ven','=',$id)->get();
            $articulos=Articulo::all();
            $suc=Sucursal::find($venta->Id_Suc); //json no collection
            $punto=PtoExpedicion::find($venta->Id_PtoExp);
            $timbrado=Timbrado::find($venta->Id_Timb);
            $cliente=Cliente::find($venta->Id_Cli);
            // desc

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }
    
            $pdf=PDF::loadView("$nivel.Ventas.factura",
            compact('id','venta','detalles','pivot','articulos','suc','timbrado','punto','cliente'));        
            return $pdf->stream();                                 
        }else{
            return back();
        }        
    }
    
    //MOSTRAR
    public function show($id)
    {
        try{
            $venta=Venta::find($id); 
                $previous = Venta::where('Id_Ven', '>', $venta->Id_Ven)->min('Id_Ven');
                $next = Venta::where('Id_Ven', '<', $venta->Id_Ven)->max('Id_Ven');

                $medio_pag=Medio_Pago::find($venta->Id_MedPag);
                $cliente=Cliente::find($venta->Id_Cli);
                $sucursal=Sucursal::find($venta->Id_Suc);
                $punto=PtoExpedicion::find($venta->Id_PtoExp);
                $timb=Timbrado::find($venta->Id_Timb);

                $venta_det=VentaDetalle::where('Id_Ven','=',$id)->get();   
                $det_art=VentaDetalleArticulos::where('Id_Ven','=',$id)->get();   
                $articulos=Articulo::all();            

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }
            
                    //devolver art
                    // $productos=Articulo::all();
                    // $det=VentaDetalle::where('Id_Ven','=',$venta->Id_Ven)->get(); 
                    // $det_a=VentaDetalleArticulos::where('Id_Ven','=',$venta->Id_Ven)->get(); 
            
            return view("$nivel.Ventas.show",compact(
                'venta','previous','next','cliente','medio_pag',
                'venta_det','det_art','articulos','sucursal','punto','timb'
                    // ,'productos','det','det_a'
            ));
        }catch(ModelNotFoundException $e){    
            return back();
        }
    }    
    
    //Anular
    public function anular($id)
    {
            $venta=Venta::find($id); //var es este reg, obj con sus prop de tab,poo,fw
            $cob=Cobro::find($id);
            $fact=TimbradoDetalle::where('TD_FactCod','=',$venta->Ven_Fact)->get();
                if($fact->count()>0){
                    $fact=$fact[0];   
                }

                $caj=Caja::find(1); //cob caj, cob ven
                                                     
        $venta->update([
            'Ven_Est'=>'Anulada'
        ]); 

        $cob->update([
            'Cob_Est'=>'Anulado'
        ]); 

        $fact->update([
            'TD_FactEst'=>'Anulada'
        ]); 

            $caj->update([
                'Caj_Fon'=>$caj->Caj_Fon - $venta->Ven_Tot
            ]); 


            //devolver art
            $productos=Articulo::all();
            $det=VentaDetalle::where('Id_Ven','=',$venta->Id_Ven)->get(); 
            $det_a=VentaDetalleArticulos::where('Id_Ven','=',$venta->Id_Ven)->get(); 

            $i=0;
            $art=[];
            $cant=[];            

            foreach($det as $d){                       
                array_push($cant, $d->VD_ArtCant);
                array_push($art, $det_a[$i]->Id_Art);                                        
                $i++;
            } 
            $art=array_flip($art);
            
            $j=0;
            foreach($art as $key=>$a){
                $art[$key]=$cant[$j];
                $j++;
            }
            //print_r($art); //id //cant

            foreach($productos as $prod){
                foreach($art as $key=>$a){                
                    if($key==$prod->Id_Art){
                        //echo $key;     

                        $prod->update([
                            'Art_St'=> $prod->Art_St+$a                            
                        ]);               
                    }                                          
                }  
            }
                    
            return back();        
    }

    //Desanular
    public function desanular($id)
    {
            $venta=Venta::find($id);
            $cob=Cobro::find($id);
            $fact=TimbradoDetalle::where('TD_FactCod','=',$venta->Ven_Fact)->get();
                //id
                if($fact->count()>0){
                    $fact=$fact[0];   
                }

                $caj=Caja::find(1);
                                                    
        $venta->update([
            'Ven_Est'=>'Válida'
        ]); 

        $cob->update([
            'Cob_Est'=>'Válido'
        ]); 

        $fact->update([
            'TD_FactEst'=>'Válida'
        ]); 

            $caj->update([
                'Caj_Fon'=>$caj->Caj_Fon + $venta->Ven_Tot
            ]); //no cambia si no es su dt

            
            //devolver art
            $productos=Articulo::all();
            $det=VentaDetalle::where('Id_Ven','=',$venta->Id_Ven)->get(); 
            $det_a=VentaDetalleArticulos::where('Id_Ven','=',$venta->Id_Ven)->get(); 

            $i=0;
            $art=[];
            $cant=[];            

            foreach($det as $d){                       
                array_push($cant, $d->VD_ArtCant);
                array_push($art, $det_a[$i]->Id_Art);                                        
                $i++;
            } 
            $art=array_flip($art);
            
            $j=0;
            foreach($art as $key=>$a){
                $art[$key]=$cant[$j];
                $j++;
            }            

            foreach($productos as $prod){
                foreach($art as $key=>$a){                
                    if($key==$prod->Id_Art){
                        $prod->update([
                            'Art_St'=> $prod->Art_St-$a                            
                        ]);               
                    }                                          
                }  
            }
                
            return back();     
    }    

    //informe    
    public function informe($id)
    {
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
    
            $pdf=PDF::loadView("$nivel.Cobros.informe",
            compact('id','cob','det','med','ven','cli','timbrado'));        
            return $pdf->stream();                       
        }else{
            return back();
        }         
    }

    //informe    
    public function comprobante($id) //factura html
    {
        if($venta=Venta::find($id)){    
            $detalles=VentaDetalle::where('Id_Ven','=',$id)->get(); //varios, colecta
            $pivot=VentaDetalleArticulos::where('Id_Ven','=',$id)->get();
            $articulos=Articulo::all();
            $suc=Sucursal::find($venta->Id_Suc); //json no collection
            $punto=PtoExpedicion::find($venta->Id_PtoExp);
            $timbrado=Timbrado::find($venta->Id_Timb);
            $cliente=Cliente::find($venta->Id_Cli);                                                 

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.Ventas.comprobante",compact(
                'id','venta','detalles','pivot','articulos','suc','timbrado','punto','cliente'
            ));
        }else{
            return back();
        }         
    }            
}