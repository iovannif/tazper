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
        $descuentos=Descuento::orderBy('Id_Desc')->simplePaginate($paginacion=20);
            $cant=Descuento::all()->count();
            $mostrados=$descuentos->count();

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

        return view("$nivel.Descuento.index",compact('descuentos','cant','mostrados','lastPage'));
    }        

    //AGREGAR
    public function create()
    {
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
    }

        //Cabecera
        public function store(Request $request)
        {
            //     $this->validate($request, [
            //         'Desc_Tip' => 'required|string|max:15',
            //     // //     'Cli_Ape' =>'required|string|max:20',
            //     // //     'Cli_Ruc'=>'required|string|max:15|unique:Clientes',
            //     // //     'Id_Lp' =>'required|integer|digits_between:1,1|min:1',
            //     // //     'Cli_Est' =>'required|string|min:6|max:8',
            //     // //     'Cli_Obs'=>'max:140',
            //     ]);

            // // Descuento::create([
            // //     'Desc_Tip'=>$request->Desc_Tip,
            // //     'Desc_Des'=>$request->Desc_Des,                            
            // //     'Desc_Est'=>'Desactivado',            
            // //     'Desc_Obs'=>$request->Desc_Obs,

            // //     'Desc_RegPor'=>Auth::user()->Id_Usu,
            // //     'Desc_RegUser'=>Auth::user()->Usu_User,
            // // ]);

            // // $descuento=new Descuento;
            // //     $descuento->Desc_Tip=$request->Desc_Tip;
            // //     $descuento->Desc_Des=$request->Desc_Des;
            // //     $descuento->Desc_Porc=$request->Desc_Porc;
            // //     // $descuento->Desc_Est='Desactivado';
            // //     $descuento->Desc_Est='Inactivo';
            // //     $descuento->Desc_Obs=$request->Desc_Obs;

            // //     $descuento->Desc_RegPor=Auth::user()->Id_Usu;
            // //     $descuento->Desc_RegUser=Auth::user()->Usu_User;
            // // $descuento->save();

            //     //det
            //     // $descuento=Descuento::latest()->first();

            //     // if(!$request->ajax()){
            //             Session::flash('descuento_agregado','Registro agregado');
            //         // return redirect("/Descuento");
            //     // }            
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
            
            // Session::flash('lp',"$request->lp");    
            // Session::flash('lp',$listas[0]);                                  
            
            //  $->count() de laravel es collection
            // count($) de php es array
            // unidimensional     
            
            //un porcentaje
            if(count($porcentaje)==1 && count($categorias)==1 && count($productos)==1){
                if($categorias[0]==0 && $productos[0]==0){
                    DescuentoDetalle::create([
                        'Id_Desc'=>$descuento->Id_Desc,        
                        'DD_Porc'=>$porcentaje[0]
                    ]); 
                }
            }else{  //varios porcentajes
                foreach($porcentaje as $porc){
                    DescuentoDetalle::create([
                        'Id_Desc'=>$descuento->Id_Desc,                                    
                        'DD_Porc'=>$porc
                        // 'DD_Porc'=>intval(s($porc)->beforeFirst(' '))
                    ]); 
                } 
            }
            
            //todos las listas
            if($listas){
                if(count($listas)==1 && $listas[0]==0){
                    $listas=ListaPrecio::all();

                    foreach($listas as $lp){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Lp'=>$lp->Id_Lp, //multi dimensional
                            'DD_Porc'=>$lp->Id_Lp
                        ]); 
                    }
                }else{ //listas
                    foreach($listas as $lp){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Lp'=>$lp, //uni
                            'DD_Porc'=>$lp
                        ]); 
                    }   
                }    
            }            
            
            //todos los clientes
            if($clientes){
                if(count($clientes)==1 && $clientes[0]==0){
                    $clientes=Cliente::all();

                    foreach($clientes as $cliente){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Cli'=>$cliente->Id_Cli, //multi dimensional
                            'DD_Porc'=>$cliente->Id_Cli
                        ]); 
                    }
                }else{ //clientes
                    foreach($clientes as $cliente){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Cli'=>$cliente->Id_Cli, //uni
                            'DD_Porc'=>$cliente->Id_Cli
                        ]); 
                    }   
                } 
            }                

            //todos las categorias
            if($categorias){
                if(count($categorias)==1 && $categorias[0]==0){
                    $categorias=Categoria::all();

                    foreach($categorias as $cat){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Cat'=>$cat->Id_Cat, //multi dimensional
                            'DD_Porc'=>$cat->Id_Cat
                        ]); 
                    }
                }else{ //categorias
                    foreach($categorias as $cat){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Cat'=>$cat, //uni
                            'DD_Porc'=>$cat
                        ]); 
                    }   
                }          
            }      

            if($productos){
                //todos los productos
                if(count($productos)==1 && $productos[0]==0){
                    $productos=Articulo::where('Art_Tip','=','Producto')->get();

                    foreach($productos as $producto){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Art'=>$producto->Id_Art, //multi dimensional
                            'DD_Porc'=>$producto->Id_Art
                        ]); 
                    }
                }else{ //productos
                    foreach($productos as $producto){
                        DescuentoDetalle::create([
                            'Id_Desc'=>$descuento->Id_Desc,        
                            'Id_Art'=>$producto, //uni
                            'DD_Porc'=>$producto
                        ]); 
                    }   
                }     
            }                           
                        
            // foreach($listas as $lp){
            //     DescuentoDetalle::create([
            //         'Id_Desc'=>$descuento->Id_Desc,        
            //         // 'Id_Lp'=>$lp,                             
            //         // 'Id_Cli'=>$lp,                             
            //         // 'Id_Art'=>$lp, 
            //         // 'Id_Cat'=>$lp,                    
            //         // 'DD_Porc'=>$request->DD_Por
            //         // 'DD_Porc'=>$lp[0]
            //         'DD_Porc'=>$lp
            //     ]);                  
            // }      

                Session::flash('descuento_agregado','Registro agregado');            
                // Session::flash('lp',substr($porcentaje[0], 0, strpos($porcentaje[0], ' ')));  
        }

    //MOSTRAR
    public function show($id)
    {
        try{
            $descuento=Descuento::find($id);
            $users=User::all();

            $previous = Descuento::where('Id_Desc', '>', $id)->max('Id_Desc');
            $next = Descuento::where('Id_Desc', '<', $id)->min('Id_Desc');

            //det

            // lp
            // cli
            // cat
            // prod

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

            return view("$nivel.Descuento.show",compact('descuento','previous','next','users'));
        }catch(ModelNotFoundException $e){
            return back();
        }
    }

        // public function activar()
        // {

        // }
        // public function desactivar()
        // {

        // }

    // //MODIFICAR
    // public function edit($id)
    // {
    //     try{
    //         $descuento=Descuento::find($id);

    //         if(Auth::user()->Id_Prf==2){
    //             $nivel='Admin';
    //         }else if(Auth::user()->Id_Prf==1){
    //             $nivel='Vend';
    //         }

    //         return view("$nivel.Descuento.edit",compact('descuento'));
    //     }catch(ModelNotFoundException $e){
    //         return back();
    //     }
    // }

    // public function update(Request $request, $id)
    // {
    //         // $this->validate($request, [
    //         //     'Cli_Nom' => 'required|string|max:20',
    //         //     'Cli_Ape' =>'required|string|max:20',
    //         //     'Cli_Ruc'=>'required|string|max:15|unique:Clientes',
    //         //     'Id_Lp' =>'required|integer|digits_between:1,1|min:1',
    //         //     'Cli_Est' =>'required|string|min:6|max:8',
    //         //     'Cli_Obs'=>'max:140',
    //         // ]);

    //         $descuento=find($id);

    //     $proveedor->update([


    //         'Prov_RegPor'=>Auth::user()->Id_Usu,
    //         'Prov_RegUser'=>Auth::user()->Usu_User
    //     ]);

    //         //det

    //         Session::flash('proveedor_modificado','Registro modificado');
    //         return redirect("Descuento/$id");
    // }

    //ELIMINAR
    public function destroy($id)
    {
            Descuento::find($id)->delete();
        return redirect('Descuento');
    }
}