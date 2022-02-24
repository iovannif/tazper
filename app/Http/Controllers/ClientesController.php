<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//tablas
use Tazper\Cliente;
//relaciones
use Tazper\ListaPrecio;

use Tazper\User;
use Auth;

use Tazper\Venta;
use Tazper\PedidoCliente;

use Tazper\Descuento; 
use Tazper\DescuentoDetalle; 

class ClientesController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }

    //LISTADO
    public function index(Request $request)
    {
        $listas=ListaPrecio::all();
        $clientes=Cliente::orderBy('Id_Cli')->simplePaginate($paginacion=20);
        $mostrados=$clientes->count();
        $cant=Cliente::all()->count();                
        // foreach($clientes as $cliente){
        // $ventas=Venta::where('Id_Cli','=',$cliente->Id_Cli)->count();
        // }
        $ventas=Venta::all();            
            $pedidos=PedidoCliente::all();            

        //ult pag
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

            //paginacion ajax
            if($request->ajax()){ //ajax
                $view=view("$nivel.Clientes.js.paginas",
                compact('clientes','cant','mostrados','lastPage','ventas','listas','pedidos'))->renderSections();                
                return response()->json([
                    'paginacion'=>$view['navegacion_1'],
                    'contenido'=>$view['contenido'],
                ]);
            }

        return view("$nivel.Clientes.index",
        compact('clientes','cant','mostrados','lastPage','ventas','listas','pedidos'));
    }

    //AGREGAR
    public function create()
    {
        $listas=ListaPrecio::all();

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Clientes.create",compact('listas'));
    }
    
    public function store(Request $request)
    {
        $entrada=$request->all();

        $this->validate($request, [                   
            'Cli_Nom' => 'required|string|max:20',
            'Cli_Ape' =>'required|string|max:20',       
            'Cli_Ruc'=>'required|string|max:15|unique:Clientes',            
            'Id_Lp' =>'required|integer|digits_between:1,1|min:1',         
            'Cli_Est' =>'required|string|min:6|max:8',         
            'Cli_Obs'=>'max:140',                                      
        ]); 

            // //desc todos
            // //si hay un descuento para todos, agregar el prod
            // // count cli
            // $cant_cli=Cliente::count();                
            // $descuentos=Descuento::all();
            // $desc_det=DescuentoDetalle::all();
            // $todos=[];

            // foreach($descuentos as $desc){
            //     $cont=0;

            //     foreach($desc_det as $det){
            //         if($det->Id_Desc==$desc->Id_Desc){
            //             if($det->Id_Cli!=''){
            //                 $cont++;
            //             }
            //         }                            
            //     }                                                            

            //     if($cont==$cant_cli){
            //         array_push($todos, $desc->Id_Desc);                                        
            //     }                    
            // }    

        Cliente::create($entrada);

            $cliente=Cliente::latest()->first();
            $cliente->update([ //cambia el updated_at
                // 'Cli_Ed'=>Carbon::now()->diffinYears($request->Cli_FeNac),
                'Cli_RegPor'=>Auth::user()->Id_Usu,
                'Cli_RegUser'=>Auth::user()->Usu_User,
            ]);           
            
            //agrega cli a desc todos
            // $cli=Cliente::latest()->first()->Id_Cli;

            // foreach($todos as $tod){
            //     $desc_det=new DescuentoDetalle;
            //         $desc_det->Id_Desc=$tod;                    
            //         $desc_det->Id_Cli=$cli;                    
            //     $desc_det->save();
            // }

        if(!$request->ajax()){
                Session::flash('cliente_agregado','Registro agregado');
            return redirect("/Clientes");
        }   
    }

    //MOSTRAR
    public function show($id)
    {
        try{
            $listas=ListaPrecio::all();
            $cliente=Cliente::findOrFail($id); 
            $users=User::all();                             
                        
                $previous = Cliente::where('Id_Cli', '<', $cliente->Id_Cli)->max('Id_Cli');
                $next = Cliente::where('Id_Cli', '>', $cliente->Id_Cli)->min('Id_Cli');

                    $ventas=Venta::where('Id_Cli','=',$cliente->Id_Cli)
                                ->where('Ven_Est','=','Válida')
                                ->count();
                    $pedidos=PedidoCliente::where('Id_Cli','=',$id)->count();

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }

            return view("$nivel.Clientes.show",compact("cliente",'previous','next','users','ventas','listas','pedidos'));
        }catch(ModelNotFoundException $e){    
            return back();
        }
    }

    // //MODIFICAR
    // public function edit($id)
    // {
    //     $cliente=Cliente::findOrFail($id);
    //         $previous = Cliente::where('Id_Cli', '<', $cliente->Id_Cli)->max('Id_Cli');
    //         $next = Cliente::where('Id_Cli', '>', $cliente->Id_Cli)->min('Id_Cli');

    //         if(Auth::user()->Id_Prf==2){
    //             $nivel='Admin';
    //         }else if(Auth::user()->Id_Prf==1){
    //             $nivel='Vend';
    //         }

    //     return view("$nivel.Clientes.edit",compact("cliente",'previous','next'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $cliente=Cliente::findOrFail($id);
    //     $cliente->update($request->all());                
    //     $cliente->update([
    //         'Cli_MdfPor'=>Auth::user()->Id_Usu,
    //     ]);
                    
    //     return redirect("/Clientes");
    // }

    //ELIMINAR
    public function destroy(Request $request, $id)
    {
        $cliente=Cliente::findOrFail($id);
        $cliente->delete();        

        if(!$request->ajax()){
                Session::flash('cliente_borrado','Registro borrado');
            return redirect("/Clientes"); //desde show
        }
    }
}