<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//tabla
use Tazper\Produccion;
 //detalle
 use Tazper\ProduccionDetalle;
//relaciones
use Tazper\Articulo;
use Tazper\User; use Auth;
use Tazper\ProduccionDetalleArticulos;

class ProduccionController extends Controller
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
            $produccion=Produccion::orderBy('Id_Pdc')->simplePaginate($paginacion=20);                
                $cant=Produccion::all()->count();
                $mostrados=$produccion->count();
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

                if($request->ajax()){ //ajax
                    $view=view("$nivel.Produccion.js.paginas",compact('produccion','cant','mostrados','productos','lastPage'))->renderSections();
                    return response()->json([
                        'paginacion'=>$view['navegacion_1'],
                        'contenido'=>$view['contenido'],
                    ]);
                }

            return view("$nivel.Produccion.index",compact('produccion','cant','mostrados','productos','lastPage'));
        }else{
            return view('Vend.restrincted');
        }
    }

    //AGREGAR
    public function create()
    {
        if(Auth::user()->Id_Prf==2){
            $productos=Articulo::where('Art_Tip','=','Producto')->get();    
            $materiales=Articulo::where('Art_Tip','=','Material')->get();    
            
                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }
            
            return view("$nivel.Produccion.create",compact('productos','materiales'));
        }else{
            return view('Vend.restrincted');
        }
    }

        public function busca_producto(Request $request)
        {        
            $busqueda=$request->busca_prod;        
            $productos=Articulo::where('Art_Tip','=','Producto')
                                ->where('Art_DesLar','like',$busqueda."%")
                                ->orderBy('Id_Art')->take(10)->get();

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }
                
            return view("$nivel.Produccion.js.cuadro.productos",compact("productos"));
        }
        
        public function busca_material(Request $request)
        {
            $busqueda=$request->busca_material;        
            $materiales=Articulo::where('Art_Tip','=','Material')
                                ->where('Art_DesLar','like',$busqueda."%")->orderBy('Id_Art')->take(10)->get();            

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }
                
            return view("$nivel.Produccion.js.cuadro.materiales",compact("materiales"));
        }

    public function store(Request $request)
    {                     
            $this->validate($request, [                  
                'Id_Prod' => 'required|integer|digits_between:1,4|min:1|max:9999',
                'Pdc_Cant' => 'required|integer|digits_between:1,4|min:1|max:9999',
                'Pdc_Con' => 'required|string|min:5|max:6',
                'Pdc_Est' => 'required|string|min:7|max:7',
                'Pdc_Obs' => 'max:140',             

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
        
        $produccion=new Produccion;
            $produccion->Id_Prod=$request->Id_Prod;
            $produccion->Pdc_Cant=$request->Pdc_Cant;
            $produccion->Pdc_Con=$request->Pdc_Con;
            $produccion->Pdc_Est=$request->Pdc_Est;
            $produccion->Pdc_Obs=$request->Pdc_Obs;

            $produccion->Pdc_RegPor=Auth::user()->Id_Usu;
            $produccion->Pdc_RegUser=Auth::user()->Usu_User;
        $produccion->save();        

        // $entrada=$request->all();
        // Produccion::create($entrada);
            
            //prod st
            // $producto=Articulo::findOrFail($request->Id_Prod);
            //     $stock=$producto->Art_St+$request->Pdc_Cant;            
            // $producto->update(['Art_St'=>$stock]);            

            $ult_pdc=Produccion::latest()->first()->Id_Pdc;            

            $l=1;
            for($l==1; $l<=8; $l++){ //lineas det
                $art='Id_Art_'.$l;
                $cant='Art_Cant_'.$l;                

                if($request->$art!=''){
                    //detalle
                    $detalle=new ProduccionDetalle;            
                        $detalle->Id_Pdc=$ult_pdc;    
                        $detalle->PD_MatCant=$request->$cant;              
                    $detalle->save();     

                    //pda
                    $pivot=new ProduccionDetalleArticulos;
                        $pivot->Id_Pdc=$ult_pdc;
                        $pivot->Id_Art=$request->$art;                            
                    $pivot->save();                
                        
                    //detalle
                    // first, error: id no tiene, orderby id porque no tiene created_at        

                    // cuando no tiene timestamps, no se puede usar latest                        
                    // ordena por id, entonces orderBy('Id_Pdc','desc') para poner alreves
                    // por lo que se necesita establecer un pk en modelo                                            
                    //created_at

                    //mat cant
                    $material=Articulo::findOrFail($request->$art);                        
                        $existencia=$material->Art_St-$request->$cant;            
                    $material->update(['Art_St'=>$existencia]);

                        $material->update(['Art_MdfPor'=>Auth::user()->Id_Usu,
                                        'Art_MdfUser'=>Auth::user()->Usu_User]);  
                }
            }
        
        if(!$request->ajax()){                            
                Session::flash('produccion_agregada','Registro agregado');
            return redirect("/Produccion");
        }
    }

    //MOSTRAR
    public function show($id)
    {
        if(Auth::user()->Id_Prf==2){
            try{
            $produccion=Produccion::findOrFail($id);
                $producto=Articulo::findOrFail($produccion->Id_Prod);
                $materiales=Articulo::where('Art_Tip', '=', 'Material')->get();
                $users=User::all();

                $previous = Produccion::where('Id_Pdc', '<', $produccion->Id_Pdc)->max('Id_Pdc');
                $next = Produccion::where('Id_Pdc', '>', $produccion->Id_Pdc)->min('Id_Pdc');

            $detalles=ProduccionDetalle::where('Id_Pdc','=',$id)->get();       
            $det_art=ProduccionDetalleArticulos::where('Id_Pdc','=',$id)->get();       
            
                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }
            
            return view("$nivel.Produccion.show",compact("produccion",'previous','next','producto','materiales','users','detalles','det_art'));
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
        $produccion=Produccion::findOrFail($id);
            //devuelve mat
            $detalles=ProduccionDetalle::where('Id_Pdc','=', $id)->get();
            $det_art=ProduccionDetalleArticulos::where('Id_Pdc','=',$id)->get();
            
            $i=0;
            foreach($detalles as $detalle){
                $material=Articulo::findOrFail($det_art[$i]->Id_Art);                
                    $existencia=$material->Art_St+$detalle->PD_MatCant;            
                $material->update(['Art_St'=>$existencia]);

                    $material->update(['Art_MdfPor'=>Auth::user()->Id_Usu,
                                'Art_MdfUser'=>Auth::user()->Usu_User]);  

                $i++;
            }

        $produccion->delete();                        

        if(!$request->ajax()){                            
                Session::flash('produccion_eliminada','Registro eliminado');
            return redirect("/Produccion");
        }
    }

    //PRODUCTO
    public function finalizar($id)
    {
        //prod st
            $produccion=Produccion::findOrFail($id);
            $producto=Articulo::findOrFail($produccion->Id_Prod);

            $stock=$producto->Art_St+$produccion->Pdc_Cant;            
        $producto->update(['Art_St'=>$stock]);

            $producto->update(['Art_MdfPor'=>Auth::user()->Id_Usu,
                                'Art_MdfUser'=>Auth::user()->Usu_User]);  
    
            $produccion->delete();                        
        
        Session::flash('produccion_finalizada','Producto finalizado');
            return redirect("/Produccion");        
    }
}