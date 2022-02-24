<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//tablas
use Tazper\ListaPrecio;
//realciones
 //detalle
use Tazper\ListaPrecioDetalle;
use Tazper\Articulo;

use Tazper\Cliente;

class ListaPrecioController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }

    //LISTADO
    public function index()
    {
        $listas=ListaPrecio::all();
            $cant=ListaPrecio::all()->count();
            $clientes=Cliente::all();

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.ListaPrecio.index",compact('listas','cant','clientes'));
    }

    //MOSTRAR
    public function show($id)
    {
        try{
            $lista=ListaPrecio::findOrFail($id);
                $detalles=ListaPrecioDetalle::where('Id_Lp','=',$id)->get();

                $productos=Articulo::where('Art_Tip','=','Producto')->orderBy('Id_Art')->simplePaginate(20);
                $cant=Articulo::where('Art_Tip','=','Producto')->count();

                $clientes=Cliente::where('Id_Lp','=',$id)->count(); //cat

                $previous = ListaPrecio::where('Id_Lp', '<', $lista->Id_Lp)->max('Id_Lp');
                $next = ListaPrecio::where('Id_Lp', '>', $lista->Id_Lp)->min('Id_Lp');                

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }        
        }catch(ModelNotFoundException $e){    
            return back();
            // return redirect('Inicio');
        }

        return view("$nivel.ListaPrecio.show",compact("lista",'detalles','previous','next','productos','cant','clientes'));
    }
    //ajax detalle show
    public function show_det(Request $request)
    {        
            $url=$_SERVER['REQUEST_URI'];
            $id=trim($url,"/Tazper/public/ListaPrecio/");      

        $lista=ListaPrecio::findOrFail($id);
        $detalles=ListaPrecioDetalle::where('Id_Lp','=',$id)->get();
        $productos=Articulo::where('Art_Tip','=','Producto')->orderBy('Id_Art')->simplePaginate(20);                       

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }           

        return view("$nivel.ListaPrecio.js.paginas",compact('detalles','productos','lista'));
    }
}