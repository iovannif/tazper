<?php
namespace Tazper\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use PDF;

//tablas
use Tazper\OrdenCompra;
use Tazper\OrdenCompraDetalle;
use Tazper\OrdenCompraDetalleArticulos;
//relaciones
use Tazper\PedidoProveedor;
use Tazper\Proveedor;
use Tazper\Sucursal;
use Tazper\User; use Auth;
use Tazper\Articulo;

use Tazper\Compra;

class OrdenCompraController extends Controller
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
            $ordenes=OrdenCompra::orderBy('Id_OC','desc')->simplePaginate($paginacion=20);
                $mostrados=$ordenes->count();
                $cant=OrdenCompra::all()->count();
                $proveedores=Proveedor::all();

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

                if($request->ajax()){ //ajax paginas
                    $view=view("$nivel.OrdenCompra.js.paginas",compact('ordenes','cant','mostrados','lastPage','proveedores'))->renderSections();                
                    return response()->json([
                        'paginacion'=>$view['navegacion_1'],
                        'contenido'=>$view['contenido'],
                    ]);
                }

            return view("$nivel.OrdenCompra.index",compact('ordenes','cant','mostrados','lastPage','proveedores'));
        }else{
            return view('Vend.restrincted');
        }
    }

    // //AGREGAR
    // public function create()
    // {
    //     if(Auth::user()->Id_Prf==2){
    //         $nivel='Admin';
    //     }else if(Auth::user()->Id_Prf==1){
    //         $nivel='Vend';
    //     }

    //     return view("$nivel.OrdenCompra.create");
    // }
    
    // public function store(Request $request)
    // {
    //     //validacion de campos
    //     $this->validate($request, [
    //         'OC_EmpProv' => 'required'
    //     ]);

    //     //si pasa validacion
    //     //Registro:
    //     $entrada=$request->all();
    //     OrdenCompra::create($entrada);

    //     //detalle
    //     $i=1;
    //     for($i==1; $i<=12; $i++){
    //         $art_num='OCD_ArtNum_'.$i;
    //         $art_des='OCD_ArtDes_'.$i;
    //         $art_cant='OCD_ArtCant_'.$i;
    //         $art_preUn='OCD_ArtPreUn_'.$i;
    //         $art_tot='OCD_ArtTotal_'.$i;
    //         if($request->$art_des!=""){
    //             $detalle=new OrdenCompraDetalle;
    //             $last_record=OrdenCompra::latest()->first();
    //             $detalle->Id_OC=$last_record->Id_OC;
    //             $detalle->OCD_ArtNum=$request->$art_num;
    //             $detalle->OCD_ArtDes=$request->$art_des;
    //             $detalle->OCD_ArtCant=$request->$art_cant;
    //             $detalle->OCD_ArtPreUn=$request->$art_preUn;
    //             $detalle->OCD_ArtTotal=$request->$art_tot;
    //             $detalle->save();
    //         }
    //     }

    //     $orden=OrdenCompra::latest()->first();
    //     $orden->update(['OC_RegPor'=>Auth::id()]);

    //     //Redireccion:
    //     //ultima pagina
    //     $ordenes=OrdenCompra::simplePaginate(3);
    //     $mostrados=$ordenes->count();
    //     $cant=OrdenCompra::all()->count();        
    //     if($mostrados%2){
    //         $lastPage=ceil($cant/$mostrados);
    //     }else{
    //         $lastPage=floor($cant/$mostrados);
    //     }

    //     return redirect("/OrdenCompra"."?page=$lastPage");
    // }

    //MOSTRAR
    public function show($id)
    {
        if(Auth::user()->Id_Prf==2){
            try{
                $orden=OrdenCompra::findOrFail($id);
                $o_detalle=OrdenCompraDetalle::where('Id_OC', '=', $id)->get(); // all()
                $ocd_a=OrdenCompraDetalleArticulos::where('Id_OC', '=', $id)->get();
                    $proveedores=Proveedor::all();
                    $sucursales=Sucursal::all();
                    $users=User::all();
                    $articulos=Articulo::all();
                    // $compra=OrdenCompraDetalle::where('Id_OC', '=', $id)->get(); //coleccion json en html
                    $compra=Compra::where('Id_OC', '=', $id)->first(); //colecction, array, de arrays

                    if($compra){
                        $compra=$compra->Id_Com;                    
                    }else{
                        $compra='';
                    }
                    
                    $previous = OrdenCompra::where('Id_OC', '>', $orden->Id_OC)->min('Id_OC');
                    $next = OrdenCompra::where('Id_OC', '<', $orden->Id_OC)->max('Id_OC');

                    if(Auth::user()->Id_Prf==2){
                        $nivel='Admin';
                    }else if(Auth::user()->Id_Prf==1){
                        $nivel='Vend';
                    }

                return view("$nivel.OrdenCompra.show",compact("orden",'previous','next','proveedores','sucursales','users','articulos','compra',
                            "o_detalle",'ocd_a'));
            }catch(ModelNotFoundException $e){   
                return back();
            }
        }else{
            return view('Vend.restrincted');
        }
    }

    //pdf
    public function imprimir($id){
        if(Auth::user()->Id_Prf==2){
            if(OrdenCompra::find($id)){
                $orden=OrdenCompra::findOrFail($id);
                $o_detalle=OrdenCompraDetalle::where('Id_OC', '=', $id)->get();
                $ocd_a=OrdenCompraDetalleArticulos::where('Id_OC', '=', $id)->get();
                    $proveedores=Proveedor::all();
                    $sucursales=Sucursal::all();                
                    $articulos=Articulo::all();

                if(Auth::user()->Id_Prf==2){
                    $nivel='Admin';
                }else if(Auth::user()->Id_Prf==1){
                    $nivel='Vend';
                }
        
                $pdf=PDF::loadView("$nivel.OrdenCompra.pdf",compact(
                    "orden",'proveedores','sucursales','articulos',"o_detalle",'ocd_a'
                ));        
                return $pdf->stream();                       
            }else{
                return back();
            }   
        }else{
            return view('Vend.restrincted');
        }
    }

    //EDITAR
    public function edit($id){
        try{
            $orden=OrdenCompra::findOrFail($id);        
            if($orden->OC_Est=='Recibido'){
                $o_detalle=OrdenCompraDetalle::where('Id_OC', '=', $id)->get();
                $ocd_a=OrdenCompraDetalleArticulos::where('Id_OC', '=', $id)->get();
                    $proveedores=Proveedor::all();
                    $sucursales=Sucursal::all();                
                    $articulos=Articulo::all();
                    $compra=Compra::where('Id_OC', '=', $id)->first();                                

                    if(Auth::user()->Id_Prf==2){
                        $nivel='Admin';
                    }else if(Auth::user()->Id_Prf==1){
                        $nivel='Vend';
                    }                

                return view("$nivel.OrdenCompra.edit",
                        compact("orden",'proveedores','sucursales','articulos','compra',"o_detalle",'ocd_a'));
            }else{
                return back(); 
            }
        }catch(ModelNotFoundException $e){   
            return back();
        }
    }

    public function update(Request $request, $id)
    {                
            $this->validate($request, [                
                'OC_CliNum' => 'max:10',   

                'OC_MedEnv' => 'max:70',   
                'OC_FOB' => 'max:70',  
                'OC_CondEnv' => 'max:70',   

                // 'OC_Iva' => 'digits_between:1,7',  
                // 'OC_Env' => 'digits_between:1,7',  
                // 'OC_Otr' => 'digits_between:1,7', 
                // 'OC_Tot' => 'digits_between:1,7'   
            ]);        

        $orden=OrdenCompra::find($id);
        $orden->update($request->all());
        $orden->update(['OC_MdfPor'=>Auth::user()->Id_Usu,
                    'OC_MdfUser'=>Auth::user()->Usu_User]);        
        return redirect("/OrdenCompra/$id");
    }
    
    //ELIMINAR
    public function destroy(Request $request, $id)
    {        
        //por fk
        // $oc=OrdenCompra::findOrFail($id);            
        // Compra::where('Id_PedProv','=',$oc->Id_PedProv)->delete();      
        
        Compra::where('Id_OC','=',$id)->update(['Id_PedProv'=>NULL,'Id_OC'=>NULL]);
            //if [0]                          

        $oc=OrdenCompra::findOrFail($id);            
            $estado=$oc->OC_Est;            
            
        $oc->delete();                           
        PedidoProveedor::where('Id_PedProv','=',$oc->Id_PedProv)->delete();                    

        if(!$request->ajax()){                            
            if($estado=='Pendiente'){
                Session::flash('orden_cancelada','Registro cancelado');
            }else{
                Session::flash('orden_eliminada','Registro eliminado');
            }                                

            return redirect("/OrdenCompra");
        }
    }
}