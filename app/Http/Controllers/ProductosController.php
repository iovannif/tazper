<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Session;

//tablas
use Tazper\Articulo;
use Tazper\ArticuloDetalle;
//relaciones
use Tazper\Categoria;
use Tazper\Impuesto;
use Tazper\Proveedor;
use Tazper\User; use Auth;
 //detalle
use Tazper\ListaPrecio;

use Tazper\Produccion;
use Tazper\PedidosProveedoresDetalleArticulos;
use Tazper\CompraDetalleArticulos;
use Tazper\PedidoClienteDetalleArticulos;
use Tazper\VentaDetalleArticulos;
use Tazper\DescuentoDetalle;

use Tazper\Descuento;

class ProductosController extends Controller
{
        // ESTAR LOGEADO
        public function __construct()
        {
            $this->middleware('auth');            
        }

    //LISTADO
    public function index(Request $request)
    {
        $productos=Articulo::where('Art_Tip','=','Producto')->orderBy('Id_Art')->simplePaginate($paginacion=20);
            $todos=Articulo::where('Art_Tip','=','Producto')->get();
            $cant=$todos->count();
            $mostrados=$productos->count();
            $categorias=Categoria::all();
            $impuestos=Impuesto::all();

                $produccion=Produccion::all();                    
                $ped_prov=PedidosProveedoresDetalleArticulos::all();                    
                $compras=CompraDetalleArticulos::all();                    
                $ped_cli=PedidoClienteDetalleArticulos::all();                    
                $ventas=VentaDetalleArticulos::all();                    
                $descuentos=DescuentoDetalle::all();                    
        
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
                // return response()->json(['contenido'=>view('Admin.Producto.navegacion',compact('productos','impuestos','cant','mostrados','lastPage'))->render()]);
                $view=view("$nivel.Producto.js.paginas",compact
                    ('productos','cant','mostrados','categorias','impuestos','lastPage',
                    'produccion','ped_prov','compras','ped_cli','ventas','descuentos'))->renderSections();                    
                return response()->json([
                    'paginacion'=>$view['navegacion_1'],
                    'contenido'=>$view['contenido'],
                ]);
            }

        return view("$nivel.Producto.index",
        compact('productos','todos','cant','mostrados','categorias','impuestos','lastPage',
            'produccion','ped_prov','compras','ped_cli','ventas','descuentos'));
    }

        public function buscador(Request $request)
        {
            if($request->busqueda!=''){
                Session::put('busqueda',$request->busqueda); //permanece
            }            
            $busqueda=Session::get('busqueda');

            $resultados=Articulo::where('Art_Tip','=','Producto')
                                // ->where('Art_DesLar','like',"%".$busqueda."%")->simplePaginate($paginacion=20);
                                ->where('Art_DesLar','like',$busqueda."%")->simplePaginate($paginacion=20);
                $count=$resultados->count();
                $impuestos=Impuesto::all();
                $categorias=Categoria::all();
                // $todos=Articulo::where('Art_Tip','=','Producto')->where('Art_DesLar','like',"%".$busqueda."%")->count();
                $todos=Articulo::where('Art_Tip','=','Producto')->where('Art_DesLar','like',$busqueda."%")->count();

                    $produccion=Produccion::all();                    
                    $ped_prov=PedidosProveedoresDetalleArticulos::all();                    
                    $compras=CompraDetalleArticulos::all();                    
                    $ped_cli=PedidoClienteDetalleArticulos::all();                    
                    $ventas=VentaDetalleArticulos::all();                    
                    $descuentos=DescuentoDetalle::all();

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

            $view=view("$nivel.Producto.js.resultados",
            compact("resultados",'impuestos','categorias','count','todos','lastPage',
                'produccion','ped_prov','compras','ped_cli','ventas','descuentos'))->renderSections();
            return response()->json([
                'paginacion'=>$view['navegacion_1'],
                'contenido'=>$view['contenido'],
            ]);
        }

        public function filtros(Request $request)
        {            
                //sesion para cada uno, cuando hay muchos, paginado, pero como con filtros, pocos, (1)                

            $art_des=$request->art_des;
            $id_art=$request->id_art;
            $id_prod=$request->id_prod;
            $art_cat=$request->art_cat;
            $art_est=$request->art_est;
            $art_pre=$request->art_pre;
            $art_imp=$request->art_imp;
            
                // if($art_cat!='""'){ 
                //     $categorias=Categoria::all();
                //     foreach($categorias as $cat){
                //         if(strtolower($art_cat)==strtolower($cat->Cat_Des)){
                //             $art_cat=$cat->Id_Cat;
                //         }
                //     }
                // }

                // if($art_imp!='""'){
                //     $impuestos=Impuesto::all();
                //     foreach($impuestos as $imp){
                //         if(strtolower($art_imp)==strtolower($imp->Imp_Des)){
                //             $art_imp=$imp->Id_Imp;
                //         }
                //     }
                // }

            $resultados=Articulo::where('Art_Tip','=','Producto');
            $todos=Articulo::where('Art_Tip','=','Producto');
                
                //des //escribir igual                
                if($art_des){
                    if($art_des!='""'){
                        Session::put('art_des',$art_des);                                                                     
                    }else{
                        Session::forget('art_des');
                    } 
                } 
                    if(Session::get('art_des')){
                        $resultados=$resultados->where('Art_DesLar','like',"%".Session::get('art_des')."%");
                        $todos=$todos->where('Art_DesLar','like',"%".Session::get('art_des')."%");
                    }  

                //id art
                if($id_art){
                    if($id_art!='""'){
                        Session::put('id_art',$id_art);                                                                     
                    }else{
                        Session::forget('id_art');
                    } 
                } 
                    if(Session::get('id_art')){
                        $resultados=$resultados->where('Id_Art','like',"%".Session::get('id_art')."%");
                        $todos=$todos->where('Id_Art','like',"%".Session::get('id_art')."%");
                    }  
                
                //id prod
                if($id_prod){
                    if($id_prod!='""'){
                        Session::put('id_prod',$id_prod);                                                                     
                    }else{
                        Session::forget('id_prod');
                    } 
                } 
                    if(Session::get('id_prod')){
                        $resultados=$resultados->where('Id_Prod','like',"%".Session::get('id_prod')."%");
                        $todos=$todos->where('Id_Prod','like',"%".Session::get('id_prod')."%");
                    }   

                    //cat
                    // if($art_cat){
                    //     if($art_cat!='""'){
                    //         Session::put('art_cat',$art_cat);                                                                     
                    //     }else{
                    //         Session::forget('art_cat');
                    //     } 
                    // } 
                    //     if(Session::get('art_cat')){
                    //         $resultados=$resultados->where('Id_Cat','like',Session::get('art_cat'));
                    //         $todos=$todos->where('Id_Cat','like',Session::get('art_cat'));
                    //     }         
                    
                if($art_cat){
                    if($art_cat!='""'){
                        Session::put('art_cat',$art_cat);                                                                     
                    }else{
                        Session::forget('art_cat');
                    } 
                }else{
                    $id_cats=[];
                    $productos_cats=[];
                } 
                    if(Session::get('art_cat')){
                                                            
                        //categorias
                        $categorias=Categoria::where('Cat_Des','like',Session::get('art_cat')."%")->get();                                             
                        $id_cats=[];                                        
                        foreach($categorias as $cat){
                            array_push($id_cats,$cat->Id_Cat);
                        }                        

                        //productos
                        // $productos=Articulo::all();
                        $productos=Articulo::where('Art_Tip','=','Producto')->get();
                        $productos_cats=[];                                     
                        foreach($productos as $pro){
                            foreach($id_cats as $id_cat){
                                if($pro->Id_Cat==$id_cat){                                    
                                    array_push($productos_cats,$pro->Id_Art);                                                                    
                                }                                
                            }
                        }                                                                                                                            
                    }                
                     
                //est
                if($art_est){
                    if($art_est!='""'){
                        Session::put('art_est',$art_est);
                    }else{
                        Session::forget('art_est');
                    }                                                                                                                        
                }
                    if(Session::get('art_est')){
                        $resultados=$resultados->where('Art_Est','like',Session::get('art_est')."%");
                        $todos=$todos->where('Art_Est','like',Session::get('art_est')."%");
                    }

                //pre
                if($art_pre){
                    if($art_pre!='""'){
                        Session::put('art_pre',$art_pre);
                    }else{
                        Session::forget('art_pre');
                    }                                                                                                                        
                }
                    if(Session::get('art_pre')){
                        $resultados=$resultados->where('Art_PreVen','like',Session::get('art_pre')."%");
                        $todos=$todos->where('Art_PreVen','like',Session::get('art_pre')."%");
                    } 
                    
                    //imp
                    // if($art_imp){
                    //     if($art_imp!='""'){
                    //         Session::put('art_imp',$art_imp);
                    //     }else{
                    //         Session::forget('art_imp');
                    //     }                                                                                                                        
                    // }
                    //     if(Session::get('art_imp')){
                    //         $resultados=$resultados->where('Id_Imp','like',Session::get('art_imp'));
                    //         $todos=$todos->where('Id_Imp','like',Session::get('art_imp'));
                    //     }                                

                if($art_imp){
                    if($art_imp!='""'){
                        Session::put('art_imp',$art_imp);                                                                     
                    }else{
                        Session::forget('art_imp');
                    } 
                }else{
                    $ids_imp=[];
                    $productos_imp=[];
                } 
                    if(Session::get('art_imp')){
                                                            
                        //impuestos
                        $impuestos=Impuesto::where('Imp_Des','like',"%".Session::get('art_imp')."%")->get(); //%                                             
                        $ids_imp=[];                                        
                        foreach($impuestos as $imp){
                            array_push($ids_imp,$imp->Id_Imp);
                        }                        

                        //productos
                        $productos=Articulo::where('Art_Tip','=','Producto')->get();
                        $productos_imp=[];                                     
                        foreach($productos as $pro){
                            foreach($ids_imp as $id_imp){
                                // if($pro->Id_Imp!=NULL){ //all                                    
                                if($pro->Id_Imp==$id_imp){                                    
                                    array_push($productos_imp,$pro->Id_Art);                                                                    
                                }                                                                             
                                // }         
                            }
                        }                                                                                                                            
                    }    
                    
                    
                $resultados=$resultados->simplePaginate($paginacion=20);
                $todos=$todos->count();

                $count=$resultados->count();
                $impuestos=Impuesto::all();
                $categorias=Categoria::all();

                    //referencias
                    $produccion=Produccion::all();                    
                    $ped_prov=PedidosProveedoresDetalleArticulos::all();                    
                    $compras=CompraDetalleArticulos::all();                    
                    $ped_cli=PedidoClienteDetalleArticulos::all();                    
                    $ventas=VentaDetalleArticulos::all();                    
                    $descuentos=DescuentoDetalle::all();

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

                // if(empty($productos_imp)!=1 || empty($productos_cats)!=1){
                if(Session::get('art_imp') || Session::get('art_cat')){                    
                    $re='res_cat_imp';
                }else{
                    $re='resultados';
                }                    
            
            $view=view("$nivel.Producto.js.$re", //resultados
                        compact("resultados",'impuestos','categorias','count','todos','lastPage',
                                'produccion','ped_prov','compras','ped_cli','ventas','descuentos',
                                'productos_cats','productos_imp'))
                                ->renderSections();
            return response()->json([
                'paginacion'=>$view['navegacion_1'],
                'contenido'=>$view['contenido'],
            ]);
        }

    //AGREGAR
    public function create()
    {
            $categorias=Categoria::all();
            $impuestos=Impuesto::all();
            $proveedores=Proveedor::all();

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Producto.create",compact('categorias','impuestos','proveedores'));
    }

    public function busca_categoria_1(Request $request)
    {    
        $categorias=Categoria::where('Cat_Des','like',"%".$request->busca_cat."%")    
                        ->orderBy('Id_Cat')->take(5)->get();

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Producto.js.cuadro.categoria",compact("categorias"));        
    }
    public function busca_categoria_2()
    {    
        $categorias=Categoria::orderBy('Id_Cat')->take(5)->get();

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Producto.js.cuadro.categoria",compact("categorias"));        
    }

    public function store(Request $request)
    {
            $this->validate($request, [                
                'Art_DesLar' => 'required|string|max:35|unique:articulos',
                'Art_DesCor' => 'max:25', 
                'Id_Imp' => 'required|integer|digits_between:1,2|min:1|max:99',               
                'Art_PreCom' => 'required|integer|digits_between:3,7|min:500|max:1000000',
                'Art_GanMin' => 'required|integer|digits_between:3,7|min:500|max:4000000',
                'Art_PreVen' => 'required|integer|digits_between:3,7|min:500|max:5000000',                                      
                'Art_St' => 'required|numeric|digits_between:1,5|min:0|max:9999',  
                'Art_StMn' => 'integer|min:0|max:9999',  
                'Art_StMx' => 'integer|min:0|max:9999',  
                'Art_Est' => 'required|string|min:6|max:8',
                'Art_Obs' => 'max:140'            
            ]);  

            //id_prod
            $ult_prod=Articulo::where('Art_Tip','=','Producto')->latest()->first(); 
            //id desc ahorra el problema de misma hora
            if($ult_prod){
                $id_prod=$ult_prod->Id_Prod+1;
            }else{
                $id_prod=1;
            }

            //desc todos
            //si hay un descuento para todos, agregar el prod
            // count prod                        
            $cant_prod=Articulo::where('Art_Tip','=','Producto')->count();
            $descuentos=Descuento::all();
            $desc_det=DescuentoDetalle::all();
            $todos=[];

            foreach($descuentos as $desc){
                $cont=0;

                foreach($desc_det as $det){
                    if($det->Id_Desc==$desc->Id_Desc){
                        if($det->Id_Art!=''){
                            $cont++;
                        }
                    }                            
                }                                                            

                if($cont==$cant_prod){
                    array_push($todos, $desc->Id_Desc);                                        
                }                    
            }    

        $producto=new Articulo;
            $producto->Art_Tip='Producto';
            $producto->Id_Prod=$id_prod;
            $producto->Art_UniMed='Unidades';

            $producto->Art_DesLar=$request->Art_DesLar;                                                
            $producto->Art_DesCor=$request->Art_DesCor;  
            $producto->Art_ProdTip=$request->Tip_Prod;  
            $producto->Id_Cat=$request->Id_Cat;  
            $producto->Id_Imp=$request->Id_Imp;  
            $producto->Art_PreCom=$request->Art_PreCom;
            $producto->Art_GanMin=$request->Art_GanMin;  
            $producto->Art_PreVen=$request->Art_PreVen;
            $producto->Art_St=$request->Art_St;       
            $producto->Art_StMn=$request->Art_StMn;       
            $producto->Art_StMx=$request->Art_StMx;       
            $producto->Id_Prov=$request->Id_Prov;
            $producto->Art_Est=$request->Art_Est;
            $producto->Art_Obs=$request->Art_Obs;                        

            $producto->Art_RegPor=Auth::user()->Id_Usu;
            $producto->Art_RegUser=Auth::user()->Usu_User;
        $producto->save();
        
        // $entrada=$request->all();
        // Articulo::create($entrada);

            // $producto=Articulo::where('Art_Tip','=','Producto')->latest()->first();            
            // $producto->update([
            //     'Id_Prod'=>$id_prod,
            //     'Art_RegPor'=>Auth::user()->Id_Usu
            // ]);
        
            //detalle
            $listas=ListaPrecio::all();
            foreach($listas as $lista){
                $detalles=new ArticuloDetalle;
                    $detalles->Id_Art=$producto->Id_Art;
                    $detalles->Id_Lp=$lista->Id_Lp;
                $detalles->save();
            }                        
        
            // //agrega prod a desc todos
            // $prod=Articulo::where('Art_Tip','=','Producto')->latest()->first()->Id_Art;

            // foreach($todos as $tod){
            //     $desc_det=new DescuentoDetalle;
            //         $desc_det->Id_Desc=$tod;                    
            //         $desc_det->Id_Art=$prod;                    
            //     $desc_det->save();
            // }

            // //ult pag
            // $productos=Articulo::where('Art_Tip','=','Producto')->simplePaginate($paginacion=20);
            // $cant=Articulo::where('Art_Tip','=','Producto')->count();
            // $mostrados=$productos->count();
            //     $lastPage=ceil($cant/$paginacion);

            // return redirect("/Productos"."?page=$lastPage");

        if(!$request->ajax()){                            
                Session::flash('producto_agregado','Registro agregado');
            return redirect("Productos");
        }
    }

    //MOSTRAR
    public function show($id_prod)
    {
        $producto=Articulo::where('Id_Prod','=',$id_prod)->get();
        //si array no es vacio // cuando no hay sale offset porque en show [0]
        if($producto->count()>0){ 
            $producto=$producto[0];    
                $detalles=ArticuloDetalle::all();
                $categorias=Categoria::all();
                $impuestos=Impuesto::all();
                $proveedores=Proveedor::all();
                $users=User::all();
                $listas=ListaPrecio::all();
                
                $previous = Articulo::where('Id_Prod', '<', $id_prod)->max('Id_Prod');
                $next = Articulo::where('Id_Prod', '>', $id_prod)->min('Id_Prod');

                    // mientras
                    // $productos=Articulo::where('Art_Tip','=','Producto')->get()->count();                    
                    $produccion=Produccion::where('Id_Prod','=',$producto->Id_Art)->count();                    
                    $ped_prov=PedidosProveedoresDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                    $compras=CompraDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                    $ped_cli=PedidoClienteDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                    $ventas=VentaDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                    $descuentos=DescuentoDetalle::where('Id_Art','=',$producto->Id_Art)->count();                                                                  

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

            return view("$nivel.Producto.show",compact("producto",'detalles','previous','next',
                        "impuestos","proveedores","users","listas",'categorias',
                        'produccion','ped_prov','compras','ped_cli','ventas','descuentos'));
        }else{
            return back();
        }
    }

    //MODIFICAR
    public function edit($id_prod)
    {
        $producto=Articulo::where('Id_Prod','=',$id_prod)->get();

        if($producto->count()>0){
            $producto=$producto->get(0);       
                $categorias=Categoria::all();
                $impuestos=Impuesto::all();
                $proveedores=Proveedor::all();                

                // mientras
                // $productos=Articulo::where('Art_Tip','=','Producto')->get()->count();                    
                $produccion=Produccion::where('Id_Prod','=',$producto->Id_Art)->count();                    
                $ped_prov=PedidosProveedoresDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                $compras=CompraDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                $ped_cli=PedidoClienteDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                $ventas=VentaDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                $descuentos=DescuentoDetalle::where('Id_Art','=',$producto->Id_Art)->count();            

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

            return view("$nivel.Producto.edit",compact("producto","impuestos","proveedores",'categorias',
                'produccion','ped_prov','compras','ped_cli','ventas','descuentos'));
        }else{
            return back();
        }
    }
    
    public function update(Request $request, $id_prod) //un reg
    {
            $producto=Articulo::where('Id_Prod','=',$id_prod)->get()[0];    

            $this->validate($request, [                
                'Art_DesLar' => 'required|string|max:35|unique:articulos,Art_DesLar,'.$producto->Id_Art.',Id_Art',
                'Art_DesCor' => 'max:25',         
                'Id_Imp' => 'required|integer|digits_between:1,2|min:1|max:99',                
                'Art_PreCom' => 'required|integer|digits_between:3,7|min:500|max:1000000',
                'Art_GanMin' => 'required|integer|digits_between:3,7|min:500|max:4000000',
                'Art_PreVen' => 'required|integer|digits_between:3,7|min:500|max:5000000',
                'Art_St' => 'required|numeric|digits_between:1,5|min:0|max:9999', 
                'Art_StMn' => 'integer|min:0|max:9999',  
                'Art_StMx' => 'integer|min:0|max:9999', 
                'Art_Est' => 'required|string|min:6|max:8',
                'Art_Obs' => 'max:140'            
            ]); 
        
        $producto->update($request->all());

            $producto->update(['Art_MdfPor'=>Auth::user()->Id_Usu,
                            'Art_MdfUser'=>Auth::user()->Usu_User]);
            
            Session::flash('producto_modificado','Registro actualizado');
        return redirect("/Productos/$id_prod");
    }

    public function modificacion_masiva(Request $request) //varios reg
    {
        $ids=$request->ids;
        $operacion=$request->operacion;
        $operar=$request->operar;

        if($operacion=='aumentar'){
            foreach($ids as $id){
                $prod=Articulo::findOrFail($id); // $prod=Articulo::where('Id_Art','=',$id);
                $precio=$prod->Art_PreVen;
                $precio+=$operar;
                $prod->update(['Art_PreVen'=>$precio]);
            }
        }

        if($operacion=='disminuir'){
            foreach($ids as $id){
                $prod=Articulo::findOrFail($id);
                $precio=$prod->Art_PreVen;
                $precio-=$operar;
                $prod->update(['Art_PreVen'=>$precio]);
            }
        }

        if($operacion=='establecer'){
            foreach($ids as $id){
                Articulo::where('Id_Art','=',$id)->update(['Art_PreVen'=>$operar]);
            }
        }
    }

    //ELIMINAR
    public function destroy(Request $request, $id)
    {
        Articulo::findOrFail($id)->delete();
        //detalle foreach
        
        if(!$request->ajax()){
                Session::flash('producto_borrado','Registro eliminado');
            return redirect("Productos");
        }                                                    
    }

    public function remove(Request $request) // Varios
    {
        if($request->ajax()){
                $ids=$request->ids;
            Articulo::whereIn("Id_Art",explode(",",$ids))->delete();            
        }
    }
}