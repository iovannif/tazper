<?php
namespace Tazper\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

//tablas
use Tazper\Articulo;
use Tazper\Categoria;

class BodegaController extends Controller
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
            $articulos=Articulo::orderBy('Id_Art')->simplePaginate($paginacion=40);
                $mostrados=$articulos->count();
                $cant=Articulo::all()->count();
                $categorias=Categoria::all();

                //ultima pagina
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

                if($request->ajax()){
                    $view=view("$nivel.Bodega.paginas",compact('articulos','cant','mostrados','lastPage','categorias'))->renderSections();
                    return response()->json([
                        'paginacion'=>$view['navegacion_1'],
                        'contenido'=>$view['contenido'],
                    ]);
                }

            return view("$nivel.Bodega.index",compact('articulos','cant','mostrados','lastPage','categorias'));
        }else{
            return view('Vend.restrincted');
        }        
    }
}