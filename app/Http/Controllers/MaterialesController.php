<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Session;

//tabla
use Tazper\Articulo;
//relaciones
use Tazper\Proveedor;
use Tazper\Impuesto;
use Tazper\User; use Auth;

use Tazper\ProduccionDetalleArticulos;
use Tazper\PedidosProveedoresDetalleArticulos;
use Tazper\CompraDetalleArticulos;

class MaterialesController extends Controller
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
            $materiales=Articulo::where('Art_Tip','=','Material')->orderBy('Id_Art')->simplePaginate($paginacion=20); //reemplaza get
                $mostrados=$materiales->count();
                $todos=Articulo::where('Art_Tip','=','Material')->orderBy('Id_Art')->get(); //trae varios
                $cant=$todos->count();
                $proveedores=Proveedor::all();

                    $produccion=ProduccionDetalleArticulos::all();
                    $pedidos=PedidosProveedoresDetalleArticulos::all(); //oc det
                    $compras=CompraDetalleArticulos::all();

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

                if($request->ajax()){ //ajax
                    $view=view("$nivel.Material.js.paginas",
                    compact('materiales','cant','todos','mostrados','proveedores','lastPage',
                            'produccion','pedidos','compras'))->renderSections();
                    return response()->json([
                        'paginacion'=>$view['navegacion_1'],
                        'contenido'=>$view['contenido'],
                    ]);
                }

            return view("$nivel.Material.index",
            compact('materiales','cant','todos','mostrados','proveedores','lastPage',
                'produccion','pedidos','compras'));
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
        
        $resultados=Articulo::where('Art_Tip','=','Material')
                            ->where('Art_DesLar','like',"%".$busqueda."%")
                            ->orderBy('Id_Art')->simplePaginate($paginacion=20);                        
            $count=$resultados->count();                
            $todos=Articulo::where('Art_Tip','=','Material')
                            ->where('Art_DesLar','like',"%".$busqueda."%")->count();            
            $proveedores=Proveedor::all();            

                $produccion=ProduccionDetalleArticulos::all();
                $pedidos=PedidosProveedoresDetalleArticulos::all(); //oc det
                $compras=CompraDetalleArticulos::all();

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

            $view=view("$nivel.Material.js.resultados",
            compact("resultados",'count','todos','lastPage','proveedores',
                'produccion','pedidos','compras'))->renderSections();
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

                $proveedores=Proveedor::all();
                $impuestos=Impuesto::all();
            
            return view("$nivel.Material.create",compact('proveedores','impuestos'));
        }else{
            return view('Vend.restrincted');
        }
    }

    public function busca_proveedor_1(Request $request)
    {    
        $proveedores=Proveedor::where('Prov_Des','like',"%".$request->busca_prov."%")    
                        ->orderBy('Id_Prov')->take(5)->get();

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }
        
                // return response()->json([
                //     'proveedores'=>view("$nivel.Material.js.cuadro.proveedor",compact("proveedores"))->render()
                // ]);        

        return view("$nivel.Material.js.cuadro.proveedor",compact("proveedores"));        
    }
    public function busca_proveedor_2()
    {    
        $proveedores=Proveedor::orderBy('Id_Prov')->take(5)->get();

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Material.js.cuadro.proveedor",compact("proveedores"));    
    }

    public function store(Request $request)
    {                
            $this->validate($request, [
                // 'Art_Tip' => 'required|string|min:8|max:8',
                // 'Id_Art' => 'unique:articulos',                

                'Art_DesLar' => 'required|string|max:35|unique:articulos',
                'Art_PreCom' => 'required|integer|digits_between:3,7|min:500|max:1000000',
                'Art_UniMed' => 'required|string|max:20',
                'Art_St' => 'required|numeric|min:0|max:9999',
                // 'Id_Prov' => '',
                'Id_Imp' => 'required|integer|digits_between:1,2|min:1|max:99',               
                'Art_Est' => 'required|string|min:6|max:8',
                'Art_Obs' => 'max:140'            
            ]);                        

            //id_mat
            $ult_mat=Articulo::where('Art_Tip','=','Material')->latest()->first();
            if($ult_mat){
                $id_mat=$ult_mat->Id_Mat+1;
            }else{
                $id_mat=1;
            }  
        
        $material=new Articulo;
            $material->Art_Tip='Material';
            $material->Id_Mat=$id_mat;

            $material->Art_DesLar=$request->Art_DesLar;                                                
            $material->Art_PreCom=$request->Art_PreCom;            
            $material->Art_UniMed=$request->Art_UniMed;            
            $material->Art_St=$request->Art_St;            
            $material->Id_Prov=$request->Id_Prov;
            $material->Id_Imp=$request->Id_Imp;
            $material->Art_Est=$request->Art_Est;
            $material->Art_Obs=$request->Art_Obs;                        

            $material->Art_RegPor=Auth::user()->Id_Usu;
            $material->Art_RegUser=Auth::user()->Usu_User;
        $material->save();  
        
        if(!$request->ajax()){                            
                Session::flash('material_agregado','Registro agregado');
            return redirect("Materiales");
        }
    }

    //MOSTRAR
    public function show($id_mat)
    {
        if(Auth::user()->Id_Prf==2){
            $material=Articulo::where('Id_Mat','=',$id_mat)->get(); //es un array aunque sea un solo elemento                
                //$material=Articulo::where('Id_Mat','=',$id_mat)->get()[0];
                //ó $material=Articulo::where('Id_Mat','=',$id_mat)->get()->get(0);
                //ó ->get() $material=$material->get(0);
                
                //ó ->get() $material[0] en show, view, para cada campo     
            if($material->count()>0){
                $material=$material[0];                                  
                    $proveedores=Proveedor::all();
                    $impuestos=Impuesto::all();
                    $users=User::all();

                    $previous = Articulo::where('Id_Mat', '<', $id_mat)->max('Id_Mat');
                    $next = Articulo::where('Id_Mat', '>', $id_mat)->min('Id_Mat');

                        // $materiales=Articulo::where('Art_Tip','=','Material')->get()->count(); // mientras
                        $produccion=ProduccionDetalleArticulos::where('Id_Art','=',$material->Id_Art)->count();
                        $pedidos=PedidosProveedoresDetalleArticulos::where('Id_Art','=',$material->Id_Art)->count(); //oc det
                        $compras=CompraDetalleArticulos::where('Id_Art','=',$material->Id_Art)->count();
            
                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

                return view("$nivel.Material.show",
                compact("material",'previous','next',"proveedores","users",'impuestos',
                        'produccion','pedidos','compras'));
            }else{
                return back();
            }   
        }else{
            return view('Vend.restrincted');
        }
    }

    //MODIFICAR
    public function edit($id_mat)
    {   
        if(Auth::user()->Id_Prf==2){
            $material=Articulo::where('Id_Mat','=',$id_mat)->get();        

            if($material->count()>0){
                $material=$material->get(0);                   
                    $proveedores=Proveedor::all();    
                    $impuestos=Impuesto::all();            

                    // $materiales=Articulo::where('Art_Tip','=','Material')->get()->count(); // mientras
                    $produccion=ProduccionDetalleArticulos::where('Id_Art','=',$material->Id_Art)->count();
                    $pedidos=PedidosProveedoresDetalleArticulos::where('Id_Art','=',$material->Id_Art)->count(); //oc det
                    $compras=CompraDetalleArticulos::where('Id_Art','=',$material->Id_Art)->count();

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

                return view("$nivel.Material.edit",compact("material",'proveedores','impuestos',
                'produccion','pedidos','compras'));
            }else{
                return back();        
            }
        }else{
            return view('Vend.restrincted');
        }
    }
    
    public function update(Request $request, $id_mat)
    {            
            $material=Articulo::where('Id_Mat','=',$id_mat)->get()[0];    

            $this->validate($request, [
                'Art_DesLar' => 'required|string|max:35|unique:articulos,Art_DesLar,'.$material->Id_Art.',Id_Art',
                'Art_PreCom' => 'required|integer|digits_between:3,7|min:500|max:1000000',
                'Art_UniMed' => 'required|string|max:20',
                'Art_St' => 'required|numeric|min:0|max:9999',
                'Id_Imp' => 'required|integer|digits_between:1,2|min:1|max:99',               
                'Art_Est' => 'required|string|min:6|max:8',
                'Art_Obs' => 'max:140'            
            ]); 
            
        $material->update($request->all());

            $material->update(['Art_MdfPor'=>Auth::user()->Id_Usu,
                            'Art_MdfUser'=>Auth::user()->Usu_User]);

            Session::flash('material_modificado','Registro actualizado');
        return redirect("/Materiales/$id_mat");
    }

    //ELIMINAR
    public function destroy(Request $request,$id)
    {
        Articulo::findOrFail($id)->delete();           

        if(!$request->ajax()){                            
                Session::flash('material_eliminado','Registro eliminado');
            return redirect("Materiales");
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