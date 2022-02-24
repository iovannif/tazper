<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//tablas
use Tazper\Proveedor;
//relaciones
use Tazper\User; use Auth;
    
use Tazper\Articulo;
use Tazper\PedidoProveedor;
use Tazper\Compra;

class ProveedoresController extends Controller
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
            $proveedores=Proveedor::simplePaginate($paginacion=20);            
                $todos=Proveedor::all();
                $cant=$todos->count();
                $mostrados=$proveedores->count();                

                    // mientras
                    // $productos=Articulo::all(); 
                    $articulos=Articulo::all();
                    $pedidos=PedidoProveedor::all(); //oc
                    $compras=Compra::all();

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
                    $view=view("$nivel.Proveedores.js.paginas",
                    compact('proveedores','todos','cant','mostrados','lastPage','articulos','pedidos','compras'))->renderSections();
                    return response()->json([
                        'paginacion'=>$view['navegacion_1'],
                        'contenido'=>$view['contenido'],
                    ]);
                }

            return view("$nivel.Proveedores.index",
            compact('proveedores','todos','cant','mostrados','lastPage','articulos','pedidos','compras'));
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

            $resultados=Proveedor::where('Prov_Des','like',"%".$busqueda."%")
                                    ->orWhere('Id_Prov','like',"%".$busqueda."%")
                                    ->orWhere('Prov_Est','like',"%".$busqueda."%")
                                    ->orWhere('Prov_Tel','like',"%".$busqueda."%")
                                    ->orWhere('Prov_Cel','like',"%".$busqueda."%")
                                    ->orWhere('Prov_Dir','like',"%".$busqueda."%")
                                ->simplePaginate($paginacion=20);

                $count=$resultados->count();        
                
                $todos=Proveedor::where('Prov_Des','like',"%".$busqueda."%")
                                    ->orWhere('Id_Prov','like',"%".$busqueda."%")
                                    ->orWhere('Prov_Est','like',"%".$busqueda."%")
                                    ->orWhere('Prov_Tel','like',"%".$busqueda."%")
                                    ->orWhere('Prov_Cel','like',"%".$busqueda."%")
                                    ->orWhere('Prov_Dir','like',"%".$busqueda."%")
                                ->count();
                
                    // $productos=Articulo::all(); //mientras
                    $articulos=Articulo::all();
                    $pedidos=PedidoProveedor::all(); //oc
                    $compras=Compra::all();

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

                $view=view("$nivel.Proveedores.js.resultados",
                compact("resultados",'count','todos','lastPage','articulos','pedidos','compras'))->renderSections();
                return response()->json([
                    'paginacion'=>$view['navegacion_1'],
                    'contenido'=>$view['contenido'],
                ]);
        }

    //AGREGAR
    public function create()
    {
        if(Auth::user()->Id_Prf==2){
            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }
            
            return view("$nivel.Proveedores.create");
        }else{
            return view('Vend.restrincted');
        }
    }

    public function store(Request $request)
    {        
            $this->validate($request, [                            
                'Prov_Des' => 'required|string|max:24|unique:proveedores',
                'Prov_RazSoc' => 'required|string|max:40',
                'Prov_Ruc' => 'required|string|max:20|unique:proveedores',
                'Prov_Tel' => 'required|string|min:8|max:15|unique:proveedores',
                'Prov_Cel' => 'max:15',                                                    
                'Prov_Email' => 'max:30',                
                'Prov_Web' => 'max:45',                
                'Prov_Dir' => 'required|string|max:50',
                'Prov_Ciu' => 'max:30',
                'Prov_Bar' => 'max:30',            
                'Prov_Est' => 'required|string|min:6|max:8',
                'Prov_Obs' => 'max:140'                        
            ]);

            // if($request->ajax()){
            //     $proveedor=new Proveedor;
            //         $proveedor->Prov_Des=$request->des;
            //         $proveedor->Prov_RazSoc=$request->raz_soc;
            //         $proveedor->Prov_Ruc=$request->ruc;
            //         $proveedor->Prov_Tel=$request->tel;
            //         $proveedor->Prov_Cel=$request->cel;
            //         $proveedor->Prov_Email=$request->email;
            //         $proveedor->Prov_Web=$request->web;
            //         $proveedor->Prov_Dir=$request->dir;
            //         $proveedor->Prov_Ciu=$request->ciu;
            //         $proveedor->Prov_Bar=$request->bar;
            //         $proveedor->Prov_Ho=$request->ho;
            //         $proveedor->Prov_Est=$request->est;
            //         $proveedor->Prov_Obs=$request->obs;                                             
                    
            //         $proveedor->Prov_RegPor=Auth::user()->Id_Usu;
            //         $proveedor->Prov_RegUser=Auth::user()->Usu_User;                                
            //     $proveedor->save();
            // }else{

            $entrada=$request->all();
        Proveedor::create($entrada);        

            $proveedor=Proveedor::latest()->first();
            $proveedor->update(['Prov_RegPor'=>Auth::user()->Id_Usu,
                            'Prov_RegUser'=>Auth::user()->Usu_User]);    

            Session::flash('proveedor_agregado','Registro agregado');
        if($request->masiva=='si'){
            return back();
            // return redirect("/Proveedores/create");
        }else{                
            return redirect("/Proveedores");
        }
        // }
    }

    //MOSTRAR
    public function show($id)
    {
        if(Auth::user()->Id_Prf==2){
            try{
                $proveedor=Proveedor::findOrFail($id); 
                    $users=User::all();
                        // $articulos=Articulo::all();
                        $articulos=Articulo::where('Id_Prov','=',$id)->count();
                        $pedidos=PedidoProveedor::where('Id_Prov','=',$id)->count(); //oc
                        $compras=Compra::where('Id_Prov','=',$id)->count();
                    
                    $previous = Proveedor::where('Id_Prov', '<', $proveedor->Id_Prov)->max('Id_Prov');
                    $next = Proveedor::where('Id_Prov', '>', $proveedor->Id_Prov)->min('Id_Prov');

                    if(Auth::user()->Id_Prf==2){
                        $nivel='Admin';
                    }else if(Auth::user()->Id_Prf==1){
                        $nivel='Vend';
                    }

                return view("$nivel.Proveedores.show",
                compact("proveedor",'previous','next','users','articulos','pedidos','compras'));
            }catch(ModelNotFoundException $e){    
                return back();
            }
        }else{
            return view('Vend.restrincted');
        }
    }

    //MODIFICAR
    public function edit($id)
    {
        if(Auth::user()->Id_Prf==2){
            try{
                $proveedor=Proveedor::findOrFail($id);            

                    // $productos=Articulo::all();
                    $articulos=Articulo::where('Id_Prov','=',$id)->count();
                    $pedidos=PedidoProveedor::where('Id_Prov','=',$id)->count(); //oc
                    $compras=Compra::where('Id_Prov','=',$id)->count();

                    if(Auth::user()->Id_Prf==2){
                        $nivel='Admin';
                    }else if(Auth::user()->Id_Prf==1){
                        $nivel='Vend';
                    }

                return view("$nivel.Proveedores.edit",compact("proveedor",'articulos','pedidos','compras'));
            }catch(ModelNotFoundException $e){    
                return back();
            }
        }else{
            return view('Vend.restrincted');
        }
    }
    
    public function update(Request $request, $id)
    {
            $this->validate($request, [                            
                'Prov_Des' => 'required|string|max:24|unique:proveedores,Prov_Des,'.$id.',Id_Prov',
                'Prov_RazSoc' => 'required|string|max:40',
                'Prov_Ruc' => 'required|string|max:20|unique:proveedores,Prov_Ruc,'.$id.',Id_Prov',
                'Prov_Tel' => 'required|string|min:8|max:15|unique:proveedores,Prov_Tel,'.$id.',Id_Prov',
                'Prov_Cel' => 'max:15',                                                    
                'Prov_Email' => 'max:30',                
                'Prov_Web' => 'max:45',                
                'Prov_Dir' => 'required|string|max:50',
                'Prov_Ciu' => 'max:30',
                'Prov_Bar' => 'max:30',      
                'Prov_Ho' => 'required|string|min:5|max:60',      
                'Prov_Est' => 'required|string|min:6|max:8',
                'Prov_Obs' => 'max:140'                        
            ]);
        
            $proveedor=Proveedor::findOrFail($id);            
        $proveedor->update($request->all());
        
            $proveedor->update(['Prov_MdfPor'=>Auth::user()->Id_Usu,
                        'Prov_MdfUser'=>Auth::user()->Usu_User]);
        
            Session::flash('proveedor_modificado','Registro modificado');
        return redirect("/Proveedores/$id");
    }

    //ELIMINAR
    public function destroy(Request $request, $id)
    {
        if($request->ajax()){
            Proveedor::findOrFail($id)->delete();        
        }else{
            Proveedor::findOrFail($id)->delete();        

                Session::flash('proveedor_eliminado','Registro borrado');
            return redirect("/Proveedores");
        }
    }

    public function remove(Request $request) // Varios
    {        
        if($request->ajax()){
                $ids=$request->ids;                
            Proveedor::whereIn("Id_Prov",explode(",",$ids))->delete();            
        }        
    }
}