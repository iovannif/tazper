<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;

//tabla
use Tazper\Categoria;
//relaciones
use Tazper\User; use Auth;
    //detalle
use Tazper\CategoriaDetalle; 
    use Tazper\Articulo;
    use Tazper\Impuesto;

use Tazper\Descuento; 
use Tazper\DescuentoDetalle; 

class CategoriaController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }

    //LISTADO
    public function index(Request $request)
    {
        $categorias=Categoria::simplePaginate($paginacion=20);
            $todos=Categoria::all();
            $cant=$todos->count();
            $mostrados=$categorias->count();
            $productos=Articulo::where('Art_Tip','=','Producto')->get();

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
                $view=view("$nivel.ProductoCategoria.js.paginas",compact('categorias','todos','cant','mostrados','lastPage','productos'))->renderSections();
                return response()->json([
                    'paginacion'=>$view['navegacion_1'],
                    'contenido'=>$view['contenido'],
                ]);
            }

        return view("$nivel.ProductoCategoria.index",compact('categorias','todos','cant','mostrados','lastPage','productos'));
    }

    public function buscador(Request $request)
    {
        if($request->busqueda!=''){
            Session::put('busqueda',$request->busqueda);
        }            
        $busqueda=Session::get('busqueda');
        
        $resultados=Categoria::where('Cat_Des','like',"%".$busqueda."%")->simplePaginate($paginacion=20);                        
            $count=$resultados->count();                
            $todos=Categoria::where('Cat_Des','like',"%".$busqueda."%")->count();            
            $productos=Articulo::where('Art_Tip','=','Producto')->get();

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

            $view=view("$nivel.ProductoCategoria.js.resultados",compact("resultados",'count','todos','lastPage','productos'))->renderSections();
            return response()->json([
                'paginacion'=>$view['navegacion_1'],
                'contenido'=>$view['contenido'],
            ]);
    }

    //AGREGAR
    public function store(Request $request)
    {
        // if($request->ajax()){
            $this->validate($request, [                
                'Cat_Des' => 'required|string|min:3|max:20|unique:categoria',
                // 'Cat_Est' => 'required|string|min:6|max:8',
                // 'Cat_Obs' => 'max:140'                
            ]);

            //desc todos
            //si hay un descuento para todos, agregar el prod
            // count cat    
            $cant_cat=Categoria::count();
            $descuentos=Descuento::all();
            $desc_det=DescuentoDetalle::all();
            $todos=[];

            foreach($descuentos as $desc){
                $cont=0;

                foreach($desc_det as $det){
                    if($det->Id_Desc==$desc->Id_Desc){
                        if($det->Id_Cat!=''){
                            $cont++;
                        }
                    }                            
                }                                                            

                if($cont==$cant_cat){
                    array_push($todos, $desc->Id_Desc);                                        
                }                    
            }    

            $categoria=new Categoria;
                $categoria->Cat_Des=$request->Cat_Des;
                $categoria->Cat_Est='Activa';
                    $categoria->Cat_RegPor=Auth::user()->Id_Usu;
                    $categoria->Cat_RegUser=Auth::user()->Usu_User;
            $categoria->save();

                $cat=Categoria::latest()->first(); //order by created desc limit 1

                $cat_detalle=new CategoriaDetalle;
                    $cat_detalle->Id_Cat = $cat->Id_Cat;
                $cat_detalle->save();            

            // //agrega cat a desc todos
            // $cat=Categoria::latest()->first()->Id_Cat;

            // foreach($todos as $tod){
            //     $desc_det=new DescuentoDetalle;
            //         $desc_det->Id_Desc=$tod;                    
            //         $desc_det->Id_Cat=$cat;                    
            //     $desc_det->save();
            // }
        // }
    }

    //MOSTRAR
    public function show($id_cat)
    {
        try{        
            $cat=Categoria::findOrFail($id_cat); //funciona con pk                                
            $detalles=CategoriaDetalle::where('Id_Cat','=',$id_cat)->get();     
                $productos=Articulo::where('Art_Tip','=','Producto')->get();     
                $pro_cat=Articulo::where('Id_Cat','=',$id_cat)->get();     
                $impuestos=Impuesto::all();
                $users=User::all();           
            
                $previous = Categoria::where('Id_Cat', '<', $id_cat)->max('Id_Cat');
                $next = Categoria::where('Id_Cat', '>', $id_cat)->min('Id_Cat');

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.ProductoCategoria.show",compact('cat','previous','next','productos','users','detalles','impuestos','pro_cat'));
        }catch(ModelNotFoundException $e){    
            return back();
            // return redirect('Inicio');
        }
    }

    //MODIFICAR
    public function edit($id_cat)
    {
        $cat=Categoria::findOrFail($id_cat);
            $pro_cat=Articulo::where('Id_Cat','=',$id_cat)->get();     

            $previous = Categoria::where('Id_Cat', '<', $id_cat)->max('Id_Cat');
            $next = Categoria::where('Id_Cat', '>', $id_cat)->min('Id_Cat');

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.ProductoCategoria.edit",compact("cat",'previous','next','pro_cat'));
    }

    public function update(Request $request, $id_cat)
    {
            $this->validate($request, [
                'Cat_Des' => 'required|string|max:20|unique:categoria,Cat_Des,'.$id_cat.',Id_Cat',
                'Cat_Est' => 'required|string|max:6|max:8',
                'Cat_Obs' => 'max:140'
            ]);

        $cat=Categoria::findOrFail($id);      
        $cat->update($request->all());            

            $cat->update(['Cat_MdfPor'=>Auth::user()->Id_Usu,
                        'Cat_MdfUser'=>Auth::user()->Usu_User]);            
                        
            Session::flash('categoria_modificada','Registro modificado');
        return redirect("/Productos_Categoria/$id_cat");
    }

    //ELIMINAR
    public function destroy(Request $request, $id)
    {
        Categoria::findOrFail($id)->delete();            
        
        if(!$request->ajax()){
                Session::flash('categoria_eliminada','Registro borrado');
            return redirect("Productos_Categoria");
        }
    }

    public function remove(Request $request) // Varios
    {        
        if($request->ajax()){
                $ids=$request->ids;                
            Categoria::whereIn("Id_Cat",explode(",",$ids))->delete();            
        }        
    }
}