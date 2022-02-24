<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//tablas
use Tazper\Timbrado;
use Tazper\TimbradoDetalle;
//relaciones
use Tazper\Sucursal;
use Tazper\PtoExpedicion;

use Tazper\User; 

use Tazper\Venta; 

class TimbradoController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }

    //LISTADO
    public function index()
    {
        if(Auth::user()->Id_Prf==2){
            $timbrados=Timbrado::simplePaginate($paginacion=20);
                $cant=Timbrado::all()->count();
                $mostrados=$timbrados->count();

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

            return view("$nivel.Timbrado.index",compact('timbrados','cant','mostrados','lastPage'));
        }else{
            return view('Vend.restrincted');
        }
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

            return view("$nivel.Timbrado.create");
        }else{
            return view('Vend.restrincted');
        }
    }

    public function store(Request $request)
    {
            $this->validate($request, [
                // 'Timb_Num' => 'required|integer|digits_between:8,8',
                'Timb_Num' => 'required|integer|digits:8',        
                'Timb_IniVig' => 'required|date',
                'Timb_FinVig' => 'required|date',
                'Timb_Rang' => 'required|integer|digits_between:2,3',
                'Timb_IniFact' => 'required|integer|digits_between:4,7',
                'Timb_FinFact' => 'required|integer|digits_between:4,7',
                'Timb_Est' => 'required|string|max:10',
                'Timb_Obs' => 'max:140'
            ]);
        
            $entrada=$request->all();
        Timbrado::create($entrada);
        
            $timb=Timbrado::latest()->first();
            $timb->update([
                'Timb_RegPor'=>Auth::user()->Id_Usu,
                'Timb_RegUser'=>Auth::user()->Usu_User
            ]);
            Session::flash('timbrado_agregado','Regirstro agregado');

        return redirect("/Timbrado");
        
        // //Redireccion:
        // //ultima pagina
        // $articulos=Articulo::simplePaginate(3);
        // $mostrados=$articulos->count();
        // $cant=Articulo::all()->count();        
        // if($mostrados%2){
        //     $lastPage=ceil($cant/$mostrados);
        // }else{
        //     $lastPage=floor($cant/$mostrados);
        // }
        // return redirect("/Articulos"."?page=$lastPage");
    }

    //MOSTRAR
    public function show($id) //registro
    {
        if(Auth::user()->Id_Prf==2){
            try{
                $timbrado=Timbrado::findOrFail($id);        
                    $previous = Timbrado::where('Id_Timb', '<', $id)->max('Id_Timb');
                    $next = Timbrado::where('Id_Timb', '>', $id)->min('Id_Timb');
                    
                    $sucursal=Sucursal::find($timbrado->Id_Suc);
                    $punto=PtoExpedicion::find($timbrado->Id_PtoExp);

                    $users=User::all();
                
                    $detalles=TimbradoDetalle::where('Id_Timb','=',$id)->get();     
                    
                    $ventas=Venta::all();     

                    if(Auth::user()->Id_Prf==2){
                        $nivel='Admin';
                    }else if(Auth::user()->Id_Prf==1){
                        $nivel='Vend';
                    }

                return view("$nivel.Timbrado.show",compact("timbrado",'previous','next','sucursal','punto','users','detalles','ventas'));
            }catch(ModelNotFoundException $e){
                return back();
            }
        }else{
            return view('Vend.restrincted');
        }
    }    
    
        public function anular($id) //registro
        {
            if(Auth::user()->Id_Prf==2){      
                $timbrado=Timbrado::findOrFail($id); 
                $timbrado->update([ //:: statically                
                    'Timb_Est'=>'Anulado',    
                    
                    'Timb_RegPor'=>Auth::user()->Id_Usu,
                    'Timb_RegUser'=>Auth::user()->Usu_User
                ]);   

                return back(); //devolver, metodo
            }else{
                return view('Vend.restrincted');
            }
        }    
        
        public function desanular($id)
        {
            if(Auth::user()->Id_Prf==2){
                $timbrado=Timbrado::findOrFail($id); 

                $timbrado->update([                
                    'Timb_Est'=>'Desanulado',   
                    
                    'Timb_RegPor'=>Auth::user()->Id_Usu,
                    'Timb_RegUser'=>Auth::user()->Usu_User                         
                ]);   

                return back();
            }else{
                return view('Vend.restrincted');
            }
        }    
}