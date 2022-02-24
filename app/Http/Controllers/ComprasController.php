<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDF;

//modelos
use Tazper\Compra;
use Tazper\CompraDetalle;
use Tazper\CompraDetalleArticulos;
//relaciones
use Tazper\Sucursal;
use Tazper\PtoExpedicion;
use Tazper\Arqueo;
use Tazper\Proveedor;
use Tazper\PedidoProveedor;
use Tazper\OrdenCompra;
use Tazper\Medio_Pago;
use Tazper\User;
 //detalles
use Tazper\Articulo;
use Tazper\Impuesto;

use Tazper\PedidoProveedorDetalle;
use Tazper\PedidosProveedoresDetalleArticulos;

use Tazper\Pago;
use Tazper\PagoDetalle;
use Tazper\Caja;

class ComprasController extends Controller
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
            $compras=Compra::orderBy('Id_Com','desc')->simplePaginate($paginacion=20);
                $mostrados=$compras->count();
                $cant=Compra::all()->count();
                $proveedores=Proveedor::all();

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
                    $view=view("$nivel.Compras.js.paginas",compact('compras','cant','mostrados','lastPage','proveedores'))->renderSections();                
                    return response()->json([
                        'paginacion'=>$view['navegacion_1'],
                        'contenido'=>$view['contenido'],
                    ]);
                }

            return view("$nivel.Compras.index",compact('compras','cant','mostrados','lastPage','proveedores'));
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

            $resultados=Compra::where('Com_Fe','like',"%".$busqueda."%")->simplePaginate($paginacion=20);
                $count=$resultados->count();                
                $todos=Compra::where('Com_Fe','like',"%".$busqueda."%")->count();    
                $proveedores=Proveedor::all();                    

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

            $view=view("$nivel.Compras.js.resultados",compact("resultados",'count','todos','lastPage','proveedores'))->renderSections();
            return response()->json([
                'paginacion'=>$view['navegacion_1'],
                'contenido'=>$view['contenido'],
            ]);
        }

    //REGISTRAR
    public function create()
    {
        if(Auth::user()->Id_Prf==2){
            $ult_arq=Arqueo::orderBy('Id_Arq', 'DESC')->first();
                // $ult_arq=Arqueo::orderBy('Id_Arq', 'DESC')->get(); $ult_arq[0]

            //valida
            if($ult_arq && $ult_arq->Arq_Est=='Abierto'){
                // $sucursal=Sucursal::findOrFail(1)->Id_Suc;
                // $punto=PtoExpedicion::findOrFail(1)->Id_PtoExp;
                // $arqueo=$ult_arq;                   
                $med_pag=Medio_Pago::all();              
                    //pedidos oc

                    // //error
                    // $proveedores                

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

                return view("$nivel.Compras.create",compact('med_pag')); // 'sucursal','punto','arqueo','caja'
            }else{
                    Session::flash('abrir_caja','Cerrada');
                return back();
            } 
        }else{
            return view('Vend.restrincted');
        }       
    }

        public function busca_pedido(Request $request) //fetch
        {    
            $pedido=PedidoProveedor::find($request->busca_ped);

            if($pedido && $pedido->PedProv_Est=='Pendiente'){ //si existe el registro            
                $proveedor=Proveedor::find($pedido->Id_Prov);
                $oc=OrdenCompra::where('Id_PedProv','=',$request->busca_ped)->first();
                    $detalles=PedidoProveedorDetalle::where('Id_PedProv','=',$request->busca_ped)->get();
                    $det_art=PedidosProveedoresDetalleArticulos::where('Id_PedProv','=',$request->busca_ped)->get();
                        $articulos=Articulo::all();
            }
            else{
                $pedido='';
            }

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.Compras.js.cuadro.pedido",compact("proveedor",'oc','detalles','det_art','articulos','pedido'));        
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

            return view("$nivel.Compras.js.cuadro.proveedor",compact("proveedores"));        
        }
        
        public function busca_articulo(Request $request)
        {
            $impuestos=Impuesto::all();
            $articulos=Articulo::where('Art_DesLar','like',$request->busqueda."%")
                                ->orderBy('Art_DesLar')->take(10)->get();
                
                if(Auth::user()->Id_Prf==2){ //el archivo
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.Compras.js.cuadro.productos",compact("articulos",'impuestos')); //devuelve el cuadro
        }

    public function store(Request $request) //registra compra
    {   
            $this->validate($request, [                                          
                // Com_Fe
                // Com_Ho
                // Id_Arq
                // Id_Suc
                // Id_PtoExp
                // Com_ConPag                

                'Com_Fac' => 'required|string|max:15|unique:Compras',
                'Id_MedPag' =>'required|integer|digits_between:1,2|min:1', 
                // Id_PedProv 
                // Id_Prov
                // Id_OC                

                'Id_Art_1' => 'required|integer|digits_between:1,4|min:1|max:9999',
                'Art_Cant_1' => 'required|numeric|min:0.5|max:9999',                
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

                'Com_Total'=>'required|integer|digits_between:3,7|max:9999999',
                // Com_StExe
                // Com_St5
                // Com_St10                
                // Com_Liq5
                // Com_Liq10
                // Com_TotIva                
            ]);     

            $arq=Arqueo::orderBy('Id_Arq', 'DESC')->first()->Id_Arq;
            // $arq=Arqueo::latest()->first()->Id_Arq; //haces con orderby DESC
            //es abierto, sino no te deja entrar a transaccion            
        
        $compra=new Compra;
        //cabecera
            $compra->Com_Fe=date('Y-m-d');
            $compra->Com_Ho=date('H:i');
            $compra->Com_Fac=$request->Com_Fac;            
            $compra->Id_Arq=$arq;
            $compra->Id_Suc=1;
            $compra->Id_PtoExp=1;
                //referencia a fk
                if($request->Id_PedProv!=''){
                    $compra->Id_PedProv=$request->Id_PedProv;     
                }else{
                    $compra->Id_PedProv=NULL;     
                }

                if($request->Id_Prov!=''){
                    $compra->Id_Prov=$request->Id_Prov;     
                }else{
                    $compra->Id_Prov=NULL;     
                }
                
                if($request->Id_OC!=''){
                    $compra->Id_OC=$request->Id_OC;     
                }else{
                    $compra->Id_OC=NULL;     
                }

            // $request->Id_PedProv
            // $compra->Id_Prov=$request->Id_Prov;     
            // $compra->Id_OC=$request->Id_OC;     
            $compra->Com_ConPag='Contado';
            $compra->Id_MedPag=$request->Id_MedPag;            
            
        //total
            $compra->Com_StExe=$request->Com_StExe;
            $compra->Com_St5=$request->Com_St5;
            $compra->Com_St10=$request->Com_St10;                
            $compra->Com_Total=$request->Com_Total;            
            $compra->Com_Liq5=$request->Com_Liq5;
            $compra->Com_Liq10=$request->Com_Liq10;
            $compra->Com_TotIva=$request->Com_TotIva;

            $compra->Com_RegPor=Auth::id();
            $compra->Com_RegUser=Auth::user()->Usu_User;
        $compra->save();         

            $ult_compra=Compra::latest()->first();
        
        //detalle            
            // $i=1;
            // for($i==1; $i==8; $i++){
                // $art='Articulo_'.$i;
                //if($request->$art!=""){
                    // $detalle=new CompraDetalle;                    
                        // $detalle->CD_ArtDes=$request->$art;
                        // $detalle->CD_ArtDes=Input::get('Articulo_1');
                    // $detalle->save();
                //}
            // }

            $l=1;
            for($l==1; $l<=8; $l++){
                $art='Id_Art_'.$l;
                $cant='Art_Cant_'.$l;
                $exen='Art_Exen_'.$l;
                $iva5='Art_Iva5_'.$l;
                $iva10='Art_Iva10_'.$l;

                if($request->$art!=''){
                    //det
                    $detalle=new CompraDetalle;            
                        $detalle->Id_Com=$ult_compra->Id_Com;    
                        $detalle->CD_ArtCant=$request->$cant;              
                        $detalle->CD_ArtExen=$request->$exen;              
                        $detalle->CD_ArtIva5=$request->$iva5;              
                        $detalle->CD_ArtIva10=$request->$iva10;              
                    $detalle->save(); 
                    
                    //piv
                    $pivot=new CompraDetalleArticulos;
                        $pivot->Id_Com=$ult_compra->Id_Com;    
                        $pivot->Id_Art=$request->$art;                            
                    $pivot->save();

                        //resta existencia
                        $material=Articulo::findOrFail($request->$art);                        
                            $existencia=$material->Art_St+$request->$cant;            
                        $material->update(['Art_St'=>$existencia]);

                            $material->update(['Art_MdfPor'=>Auth::user()->Id_Usu,
                                            'Art_MdfUser'=>Auth::user()->Usu_User]);        
                }
            }
        
        // se genera pago    
            if($ult_compra->Id_Prov!=''){
                $proveedores=Proveedor::all();
                foreach($proveedores as $proveedor){
                    if($proveedor->Id_Prov==$ult_compra->Id_Prov){
                        $prov=$proveedor->Prov_Des;
                    }
                }   
            }else{
                $prov=NULL;
            }             
                                         
        $pago=new Pago;    
            $pago->Id_Pag=$ult_compra->Id_Com;      
            $pago->Id_Arq=$ult_compra->Id_Arq;      
            $pago->Id_Com=$ult_compra->Id_Com;      
            $pago->Pag_ConPag=$ult_compra->Com_ConPag;      
            $pago->Id_MedPag=$ult_compra->Id_MedPag;      
            $pago->Pag_Eg=$ult_compra->Com_Total;                                            
            $pago->Pag_Fac=$ult_compra->Com_Fac;      
            $pago->Id_Caj=1;      
            $pago->Pag_Prov=$prov;      
            $pago->Id_Suc=$ult_compra->Id_Suc;      
            $pago->Id_PtoExp=$ult_compra->Id_PtoExp;      

            $pago->Pag_RegPor=$ult_compra->Com_RegPor;      
            $pago->Pag_RegUser=$ult_compra->Com_RegUser;           
        $pago->save();         
                
        //pag det 
            $det=CompraDetalle::where('Id_Com','=',$ult_compra->Id_Com)->get();
            $piv=CompraDetalleArticulos::where('Id_Com','=',$ult_compra->Id_Com)->get(); 
            $articulos=Articulo::all();          
            $i=0;

        foreach($det as $com_det){            
            foreach($articulos as $articulo){              
            if($articulo->Id_Art==$piv[$i]->Id_Art){ //art           
            $pag_det=new PagoDetalle;    
                $pag_det->Id_Pag=$ult_compra->Id_Com;
                $pag_det->PD_Art=$articulo->Art_DesLar;
                $pag_det->Pd_ArtPre=$articulo->Art_PreCom;
                $pag_det->Pd_ArtCant=$com_det->CD_ArtCant;
                if($com_det->CD_ArtExen!=''){
                    $pag_det->PD_ArtTot=$com_det->CD_ArtExen;
                }elseif($com_det->CD_ArtIva5!=''){
                    $pag_det->PD_ArtTot=$com_det->CD_ArtIva5;
                }else if($com_det->CD_ArtIva10!=''){
                    $pag_det->PD_ArtTot=$com_det->CD_ArtIva10;
                }                                                
            $pag_det->save();    
            }} $i++;            
        }                                            

            //compra
            $id_pag=Pago::latest()->first()->Id_Pag;

            $ult_compra->update([
                'Id_Pag'=>$id_pag
            ]);

            //ped oc recibido
            if($ult_compra->Id_PedProv!=''){
                $pedido=PedidoProveedor::find($ult_compra->Id_PedProv);
                $oc=OrdenCompra::find($ult_compra->Id_OC);

                $pedido->update([
                    'PedProv_Est'=>'Recibido'
                ]);
                $oc->update([
                    'OC_Est'=>'Recibido',

                    'OC_MdfPor'=>Auth::user()->Id_Usu,
                    'OC_MdfUser'=>Auth::user()->Usu_User
                ]);                
            }

            //caja
            $caja=Caja::find(1);                        
            // $caja->Caj_Fon;                        
            $caja->update([
                'Caj_Fon'=>$caja->Caj_Fon-$ult_compra->Com_Total
            ]); 
        
            //Redireccion:
            //ult pag
            // $compras=Compra::simplePaginate($paginacion=20);
            // $mostrados=$compras->count();
            // $cant=Compra::all()->count();        
            
            // if($mostrados!=0){
            //     $lastPage=ceil($cant/$paginacion);
            // }else{
            //     $lastPage=1;
            // }

            // return redirect("/Compras"."?page=$lastPage");             

        if(!$request->ajax()){
                Session::flash('compra_agregada','Registro agregado');
            return redirect("/Compras");
        }    
    }    
    
    //MOSTRAR
    public function show($id)
    {
        if(Auth::user()->Id_Prf==2){
            try{
                $compra=Compra::findOrFail($id); 
                    $previous = Compra::where('Id_Com', '>', $compra->Id_Com)->min('Id_Com');
                    $next = Compra::where('Id_Com', '<', $compra->Id_Com)->max('Id_Com');

                    $medios_pag=Medio_Pago::all();
                    $proveedores=Proveedor::all();

                    $compra_det=CompraDetalle::where('Id_Com','=',$id)->get();   

                    $det_art=CompraDetalleArticulos::where('Id_Com','=',$id)->get();   
                    $articulos=Articulo::all();            

                    if(Auth::user()->Id_Prf==2){
                        $nivel='Admin';
                    }else if(Auth::user()->Id_Prf==1){
                        $nivel='Vend';
                    }

                return view("$nivel.Compras.show",compact(
                    'compra','previous','next','proveedores','medios_pag','compra_det','det_art','articulos'
                ));
            }catch(ModelNotFoundException $e){    
                return back();
            }
        }else{
            return view('Vend.restrincted');
        }
    }

    //informe
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
        
                $pdf=PDF::loadView("$nivel.Pagos.informe",compact('pago','detalle','medio','prov'));        
                return $pdf->stream();                       
            }else{
                return back();
            }        
        }else{
            return view('Vend.restrincted');
        }
    }

    //ELIMINAR
    public function destroy(Request $request, $id)
    {
        $compra=Compra::find($id);
            $pedido=$compra->Id_PedProv;
            $orden=$compra->Id_OC;
        $compra->delete();                  

            //despues porque fk
            if($pedido!=''){
                OrdenCompra::find($orden)->delete();
                PedidoProveedor::find($pedido)->delete();
            }

        if(!$request->ajax()){
                Session::flash('compra_borrada','Registro borrado');
            return redirect("/Compras");
        }
    }

    //Anular Pago
    public function anular($id)
    {
            $compra=Compra::find($id);
            $pago=Pago::find($compra->Id_Pag);                    
            $caja=Caja::find(1);                                    
            
            $caja->update([
                'Caj_Fon'=>$caja->Caj_Fon+$pago->Pag_Eg
            ]); 

            // restar art
            $productos=Articulo::all();
            $det=CompraDetalle::where('Id_Com','=',$compra->Id_Com)->get();
            $det_a=CompraDetalleArticulos::where('Id_Com','=',$compra->Id_Com)->get();

            $i=0;
            $art=[];
            $cant=[];            

            foreach($det as $d){                       
                array_push($cant, $d->CD_ArtCant);
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
        
        $compra->delete();       
        $pago->delete();       

            return redirect("/Compras");        
    }
}