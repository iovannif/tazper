<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//tablas
use Tazper\Descuento;
use Tazper\DescuentoDetalle;
//relaciones
use Tazper\ListaPrecio;
use Tazper\Cliente;
use Tazper\Articulo;
use Tazper\Categoria;

use Tazper\User;

use Tazper\VentaDetalle;

class DescuentoController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }

    //LISTADO
    public function index(Request $request)
    {
        $descuentos=Descuento::orderBy('Id_Desc','DESC')->simplePaginate($paginacion=20);
            $cant=Descuento::all()->count();
            $mostrados=$descuentos->count();

                // $ventas=VentaDetalle::all();

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

            // if($request->ajax()){
            //     $view=view("$nivel.Descuento.js.paginas",compact('descuentos','cant','mostrados','lastPage'))->renderSections();
            //     return response()->json([
            //         'paginacion'=>$view['navegacion_1'],
            //         'contenido'=>$view['contenido'],
            //     ]);
            // }

        return view("$nivel.Descuento.index",compact('descuentos','cant','mostrados','lastPage')); //,'ventas'
    }        

    //AGREGAR
    public function create() //form
    {
        if(Auth::user()->Id_Prf==2){
            $clientes=Cliente::orderBy('Cli_Nom')->get();
            $productos=Articulo::where('Art_Tip','=','Producto')->orderBy('Art_DesLar')->get();

            if($clientes->count()!=0 && $productos->count()!=0){
                $listas=ListaPrecio::all();
                $categorias=Categoria::orderBy('Cat_Des')->get();

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }            

                return view("$nivel.Descuento.create",compact('listas','clientes','categorias','productos'));
            }else{
                    Session::flash('descuento_inhabilitado','Descuento inhabilitado');
                return back();
            }
        }else{
            return view('Vend.restrincted');
        }
    }

        //Cabecera
        public function store(Request $request)
        {
                $this->validate($request, [                                        
                    'Desc_Tip' => 'required|string|max:15',
                    'Desc_Des' => 'required|string|max:20', // |unique:Descuento
                    'Desc_Obs'=>'max:140'
                ]);

            Descuento::create([
                'Desc_Tip'=>$request->Desc_Tip,
                'Desc_Des'=>$request->Desc_Des,                            
                'Desc_Est'=>'Desactivado',            
                'Desc_Obs'=>$request->Desc_Obs,

                'Desc_RegPor'=>Auth::user()->Id_Usu,
                'Desc_RegUser'=>Auth::user()->Usu_User,
            ]);                         
        }
        //Detalle
        public function store_detalle(Request $request)
        {
            //det
            $descuento=Descuento::latest()->first();  
            
            $listas=$request->lp;
            $clientes=$request->cli;            
            $productos=$request->prod;
            $categorias=$request->cat;
            $porcentaje=$request->porc;  
            
            //un porcentaje
            if($porcentaje && $categorias && $productos){ //si es uno no es el otro
                if(count($porcentaje)==1 && count($categorias)==1 && count($productos)==1){
                    if($categorias[0]==0 && $productos[0]==0){                            
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'DD_Porc'=>$porcentaje[0] //vacio da error
                        ]); 
                    }

                    else{ //varios porcentajes
                        foreach($porcentaje as $porc){
                            DescuentoDetalle::create([
                                'Id_Desc'=>$descuento->Id_Desc,                                    
                                'DD_Porc'=>$porc
                            ]);             
                        }                 
                    }
                }

                else{ //varios porcentajes
                    foreach($porcentaje as $porc){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,                                    
                            'DD_Porc'=>$porc
                        ]);             
                    }                 
                }
            }
            else{ //varios porcentajes
                foreach($porcentaje as $porc){
                    DescuentoDetalle::create([
                        'Id_Desc'=>$descuento->Id_Desc,                                    
                        'DD_Porc'=>$porc
                    ]);             
                }                 
            }
            
            //todos las listas
            if($listas){
                if(count($listas)==1){
                    if($listas[0]==0){
                        $listas=ListaPrecio::all();

                        foreach($listas as $lp){
                            DescuentoDetalle::create([
                                'Id_Desc'=>$descuento->Id_Desc,        
                                'Id_Lp'=>$lp->Id_Lp, //multi dimensional
                            ]); 
                        }
                    }else{
                        foreach($listas as $lp){ //lista
                            DescuentoDetalle::create([
                                'Id_Desc'=>$descuento->Id_Desc,        
                                'Id_Lp'=>$lp, //uni
                            ]); 
                        }       
                    }                                        
                }else{ //listas
                    foreach($listas as $lp){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Lp'=>$lp
                        ]); 
                    } 
                }    
            }            
            
            //todos los clientes
            if($clientes){
                if(count($clientes)==1){
                    if($clientes[0]==0){
                        $clientes=Cliente::all();

                        foreach($clientes as $cliente){
                            DescuentoDetalle::create([
                                'Id_Desc'=>$descuento->Id_Desc,        
                                'Id_Cli'=>$cliente->Id_Cli,
                            ]); 
                        }
                    }else{
                        foreach($clientes as $cliente){ //cliente
                            DescuentoDetalle::create([
                                'Id_Desc'=>$descuento->Id_Desc,        
                                'Id_Cli'=>$cliente
                            ]); 
                        }       
                    } 
                }else{ //clientes
                    foreach($clientes as $cliente){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Cli'=>$cliente
                        ]); 
                    }   
                } 
            }                

            //todos las categorias
            if($categorias){
                if(count($categorias)==1){
                    if($categorias[0]==0){
                        $categorias=Categoria::all();

                        foreach($categorias as $cat){
                            DescuentoDetalle::create([
                                'Id_Desc'=>$descuento->Id_Desc,        
                                'Id_Cat'=>$cat->Id_Cat,
                            ]); 
                        }
                    }else{
                        foreach($categorias as $cat){ //categoria
                            DescuentoDetalle::create([
                                'Id_Desc'=>$descuento->Id_Desc,        
                                'Id_Cat'=>$cat,
                            ]); 
                        }       
                    } 
                }else{ //categorias
                    foreach($categorias as $cat){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Cat'=>$cat                            
                        ]); 
                    }   
                }          
            }      

            if($productos){
                //todos los productos
                if(count($productos)==1){
                    if($productos[0]==0){
                        $productos=Articulo::where('Art_Tip','=','Producto')->get();

                        foreach($productos as $producto){
                            DescuentoDetalle::create([
                                'Id_Desc'=>$descuento->Id_Desc,        
                                'Id_Art'=>$producto->Id_Art,
                            ]); 
                        }
                    }else{
                        foreach($productos as $producto){ //producto
                            DescuentoDetalle::create([
                                'Id_Desc'=>$descuento->Id_Desc,        
                                'Id_Art'=>$producto
                            ]);  
                        }       
                    } 
                }else{ //productos
                    foreach($productos as $producto){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Art'=>$producto
                        ]); 
                    }   
                }     
            }                                                               

                Session::flash('descuento_agregado','Registro agregado');
                //no se puede redireccionar con back, es ajax, se usa js
        }

    //MOSTRAR
    public function show($id)
    {
        try{
            $descuento=Descuento::find($id);
            $users=User::all();

            $next = Descuento::where('Id_Desc', '<', $id)->max('Id_Desc');
            $previous = Descuento::where('Id_Desc', '>', $id)->min('Id_Desc');

                // $ventas=VentaDetalle::where('Id_Desc', '=', $id)->count();
            
            //det
            $detalle=DescuentoDetalle::where('Id_Desc','=',$id)->get();
            $listas=ListaPrecio::all();
            $clientes=Cliente::all();
            $categorias=Categoria::all();
            $productos=Articulo::all();

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

            return view("$nivel.Descuento.show",
            compact('descuento','previous','next','users','detalle','listas','clientes','categorias','productos')); //,'ventas'
        }catch(ModelNotFoundException $e){
            return back();
        }
    }

        public function activar($id)
        {            
            if(Auth::user()->Id_Prf==2){
                
                $descuentos=Descuento::all();
                
                    $activado='false';

                foreach($descuentos as $des){
                    if($des->Desc_Est=='Activado'){
                        $activado='true';
                        break;
                    }
                }

                if($activado=='false'){
                    Descuento::find($id)->update([
                        'Desc_Est'=>'Activado',                
                        //activado por
                        'Desc_MdfPor'=>Auth::user()->Id_Usu,
                        'Desc_MdfUser'=>Auth::user()->Usu_User,
                    ]); 
                }else{
                    Session::flash('descAct_rechazada','Activacion rechazada');
                }                  
                
                return back();
            }else{
                return view('Vend.restrincted');
            }
        }
        public function desactivar($id)
        {            
            if(Auth::user()->Id_Prf==2){
                Descuento::find($id)->update([
                    'Desc_Est'=>'Desactivado',                
                    //desactivado por
                    'Desc_MdfPor'=>Auth::user()->Id_Usu,
                    'Desc_MdfUser'=>Auth::user()->Usu_User,
                ]); 
    
                return back();
            }else{
                return view('Vend.restrincted');
            }
        }    

    //ELIMINAR
    public function destroy(Request $request, $id)
    {
        Descuento::find($id)->delete();
            Session::flash('descuento_borrado','Registro borrado');
        return redirect('Descuento');
    }
}