<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Session;

//Usuarios
use Tazper\User;
use Tazper\Perfil;
use Tazper\PerfilDetalle;
use Tazper\Personal;

//Caja
use Tazper\Arqueo;
use Tazper\Caja;
use Tazper\Pago;
use Tazper\Cobro;

//Compras
use Tazper\Proveedor;
use Tazper\Articulo;
use Tazper\Produccion;
use Tazper\ProduccionDetalleArticulos;
use Tazper\ProduccionDetalle;
use Tazper\PedidoProveedor;
use Tazper\Sucursal;
use Tazper\PtoExpedicion;
use Tazper\PedidoProveedorDetalle;
use Tazper\PedidosProveedoresDetalleArticulos;
use Tazper\OrdenCompra;
use Tazper\OrdenCompraDetalle;
use Tazper\OrdenCompraDetalleArticulos;
use Tazper\Compra;
use Tazper\CompraDetalle;
use Tazper\CompraDetalleArticulos;
use Tazper\Medio_Pago;

//Ventas
use Tazper\Categoria;
use Tazper\CategoriaDetalle;
use Tazper\Impuesto;
use Tazper\ListaPrecio;
use Tazper\ListaPrecioDetalle;
use Tazper\ArticuloDetalle;
use Tazper\Cliente;
use Tazper\Venta;
use Tazper\PedidoCliente;
use Tazper\PedidoClienteDetalle;
use Tazper\PedidoClienteDetalleArticulos;
use Tazper\Descuento;
use Tazper\DescuentoDetalle;
use Tazper\Timbrado;
use Tazper\VentaDetalle;
use Tazper\VentaDetalleArticulos;

class FetchController extends Controller
{
    // ESTAR LOGEADO
    public function __construct()
    {
        $this->middleware('auth');
    }

    // INDEX
    //user
    public function usuarios()
    {       
        if(Auth::user()->Id_Prf==2){
            $users=User::all();
                $cant=$users->count();
                $perfiles=Perfil::all();
                $personal=Personal::all();

            return view("Admin.Usuarios.js.fetch",compact('users','cant','perfiles','personal'));
        }else{
            return view('Vend.restrincted');
        }
    }            

    // CREATE EDIT
    // user: resultados personal
    public function buscador1(Request $request)
    {
        if(Auth::user()->Id_Prf==2){
            $personal=Personal::where('Per_Nom','like',"%".$request->busca_per."%")
                            ->orWhere('Per_Ape','like',"%".$request->busca_per."%")
                            ->orderBy('Id_Per')->take(5)->get();

                return view("Admin.Usuarios.js.personal",compact("personal"));
        }else{
            return view('Vend.restrincted');
        }
    }
    public function buscador2()
    {
        if(Auth::user()->Id_Prf==2){
            $personal=Personal::orderBy('Id_Per')->take(5)->get();

                return view("Admin.Usuarios.js.personal",compact("personal"));
        }else{
            return view('Vend.restrincted');
        }
    }

    // SHOW
    //user
    public function show_user_1(Request $request)
    {        
        if(Auth::user()->Id_Prf==2){
            $id=$request->id;
            
            $user=User::findOrFail($id);
                $previous = User::where('Id_Usu', '<', $user->Id_Usu)->max('Id_Usu');
                $next = User::where('Id_Usu', '>', $user->Id_Usu)->min('Id_Usu');

            return view("Admin.Usuarios.js.show_fetch_1",compact('previous','next','user'));
        }else{
            return view('Vend.restrincted');
        }
    }
    public function show_user_2(Request $request)
    {
        if(Auth::user()->Id_Prf==2){
            $id=$request->id;

            $user=User::findOrFail($id);
                $users=User::all();
                $perfiles=Perfil::all();
                $personal=Personal::all();

            return view("Admin.Usuarios.js.show_fetch_2",compact('perfiles','personal','user','users'));
        }else{
            return view('Vend.restrincted');
        }
    }    
    //perfil
    public function show_perfil_1(Request $request)
    {        
        if(Auth::user()->Id_Prf==2){
            $id=$request->id;

            $perfil=Perfil::findOrFail($id);
                $previous = Perfil::where('Id_Prf', '<', $perfil->Id_Prf)->max('Id_Prf');
                $next = Perfil::where('Id_Prf', '>', $perfil->Id_Prf)->min('Id_Prf');

            return view("Admin.Perfil.js.show_fetch_1",compact('previous','next','perfil'));
        }else{
            return view('Vend.restrincted');
        }
    }
    public function show_perfil_2(Request $request)
    {
        if(Auth::user()->Id_Prf==2){
            $id=$request->id;

            $perfil=Perfil::findOrFail($id);
            $perfil_detalle=PerfilDetalle::all();

            return view("Admin.Perfil.js.show_fetch_2",compact("perfil","perfil_detalle"));
        }else{
            return view('Vend.restrincted');
        }
    }   
    //personal    
    public function show_personal_1(Request $request)
    {        
        if(Auth::user()->Id_Prf==2){
            $id=$request->id;

            $personal=Personal::findOrFail($id);
                $previous = Personal::where('Id_Per', '<', $personal->Id_Per)->max('Id_Per');
                $next = Personal::where('Id_Per', '>', $personal->Id_Per)->min('Id_Per');

            return view("Admin.Personal.js.show_fetch_1",compact('previous','next','personal'));
        }else{
            return view('Vend.restrincted');
        }
    }
    public function show_personal_2(Request $request)
    {
        if(Auth::user()->Id_Prf==2){
            $id=$request->id;

            $personal=Personal::findOrFail($id);
                $users=User::all();

            return view("Admin.Personal.js.show_fetch_2",compact("personal","users"));
        }else{
            return view('Vend.restrincted');
        }
    }   

    //arqueo    
    public function show_arqueo_1(Request $request)
    {                
        $id=$request->id;

        $arqueo=Arqueo::findOrFail($id);                    
            $previous = Arqueo::where('Id_Arq', '<', $arqueo->Id_Arq)->max('Id_Arq');
            $next = Arqueo::where('Id_Arq', '>', $arqueo->Id_Arq)->min('Id_Arq');

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Arqueo.js.show_fetch_1",compact("arqueo",'previous','next'));
        
    }
    public function show_arqueo_2(Request $request)
    {
        $id=$request->id;

        $arqueo=Arqueo::findOrFail($id);
                // $caja=Caja::first();
                // $users=User::all();
                // $arqueos=Arqueo::all();   
                // $pagos=Pago::all();
                // $cobros=Cobro::all();

            $caja=Caja::first();
            $users=User::all();
            $pagos=Pago::where('Id_Arq','=',$id)->get();
            $ventas=Venta::where('Id_Arq','=',$id)->where('Ven_Est','=','Válida')->get();               
                $cli=Cliente::all();
                $suc=Sucursal::all();
                $punto=PtoExpedicion::all();
                $med=Medio_Pago::all();                     
            $compras=Compra::all();

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Arqueo.js.show_fetch_2",
        compact("arqueo",'previous','next',"caja",'users','pagos','ventas','cli','suc','punto','med','compras'));                  
    }   

    //proveedor    
    public function show_proveedor_1(Request $request)
    {                
        $id=$request->id;

        $proveedor=Proveedor::findOrFail($id); 
            $previous = Proveedor::where('Id_Prov', '<', $id)->max('Id_Prov');
            $next = Proveedor::where('Id_Prov', '>', $id)->min('Id_Prov');

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Proveedores.js.show_fetch_1",compact("proveedor",'previous','next'));
        
    }
    public function show_proveedor_2(Request $request)
    {
        $id=$request->id;

        $proveedor=Proveedor::findOrFail($id); 
            $users=User::all();
                // $articulos=Articulo::all();
                $articulos=Articulo::where('Id_Prov','=',$id)->count();
                $pedidos=PedidoProveedor::where('Id_Prov','=',$id)->count(); //oc
                $compras=Compra::where('Id_Prov','=',$id)->count();                                             

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Proveedores.js.show_fetch_2",compact('proveedor','users','articulos','pedidos','compras'));                            
    }   
    //material    
    public function show_material_1(Request $request)
    {                
        $id_mat=$request->id;
        $material=Articulo::where('Id_Mat','=',$id_mat)->get()->get(0);

            // $materiales=Articulo::where('Art_Tip','=','Material')->get()->count(); //mientras
        
            $previous = Articulo::where('Id_Mat', '<', $id_mat)->max('Id_Mat');
            $next = Articulo::where('Id_Mat', '>', $id_mat)->min('Id_Mat');

            $produccion=ProduccionDetalleArticulos::where('Id_Art','=',$material->Id_Art)->count();
            $pedidos=PedidosProveedoresDetalleArticulos::where('Id_Art','=',$material->Id_Art)->count(); //oc det
            $compras=CompraDetalleArticulos::where('Id_Art','=',$material->Id_Art)->count();

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Material.js.show_fetch_1",
        compact("material",'previous','next','materiales','produccion','pedidos','compras'));
    }
    public function show_material_2(Request $request)
    {
        $id_mat=$request->id;
            $material=Articulo::where('Id_Mat','=',$id_mat)->get()->get(0);
            $proveedores=Proveedor::all();
            $impuestos=Impuesto::all();
            $users=User::all();                             

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Material.js.show_fetch_2",compact("material","proveedores","users",'impuestos'));                            
    } 
    //produccion    
    public function show_produccion_1(Request $request)
    {                
        $id=$request->id;
        $produccion=Produccion::findOrFail($id);            
        
            $previous = Produccion::where('Id_Pdc', '<', $produccion->Id_Pdc)->max('Id_Pdc');
            $next = Produccion::where('Id_Pdc', '>', $produccion->Id_Pdc)->min('Id_Pdc');

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Produccion.js.show_fetch_1",compact("produccion",'previous','next'));        
    }
    public function show_produccion_2(Request $request)
    {
        $id=$request->id;
        $produccion=Produccion::findOrFail($id);          
            $producto=Articulo::findOrFail($produccion->Id_Prod);
            $materiales=Articulo::where('Art_Tip', '=', 'Material')->get();
            $users=User::all();
        
        $detalles=ProduccionDetalle::where('Id_Pdc','=',$id)->get();       
        $det_art=ProduccionDetalleArticulos::where('Id_Pdc','=',$id)->get();     

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Produccion.js.show_fetch_2",compact("produccion",'producto','materiales','users','detalles','det_art'));                            
    } 
    //pedido proveedor    
    public function show_pedidoproveedor_1(Request $request)
    {                
        $id=$request->id;
        $pedido=PedidoProveedor::findOrFail($id);            
        
            if(Session::get('filtro')){            
                $filtro=Session::get('filtro');
                
                if($filtro=='Pendiente'){                    
                    $previous = PedidoProveedor::where('PedProv_Est','=',$filtro)
                        ->where('Id_PedProv', '>', $pedido->Id_PedProv)->min('Id_PedProv');
                    $next = PedidoProveedor::where('PedProv_Est','=',$filtro)
                        ->where('Id_PedProv', '<', $pedido->Id_PedProv)->max('Id_PedProv');     

                    // $previous = PedidoProveedor::where('PedProv_Est','=',$filtro)
                    //     ->where('PedProv_FeHo', '>', $pedido->PedProv_FeHo)->min('Id_PedProv'); // >id
                    // $next = PedidoProveedor::where('PedProv_Est','=',$filtro)
                    //     ->where('PedProv_FeHo', '<=', $pedido->PedProv_FeHo)->max('Id_PedProv'); // <id
                }else{
                    $previous = PedidoProveedor::where('Id_PedProv', '>', $pedido->Id_PedProv)->min('Id_PedProv');
                    $next = PedidoProveedor::where('Id_PedProv', '<', $pedido->Id_PedProv)->max('Id_PedProv');

                    // $previous = PedidoProveedor::where('PedProv_FeHo', '>', $pedido->PedProv_FeHo)->max('Id_PedProv');
                    // $next = PedidoProveedor::where('PedProv_FeHo', '<=', $pedido->PedProv_FeHo)->min('Id_PedProv');
                }
            }else{
                $previous = PedidoProveedor::where('Id_PedProv', '>', $pedido->Id_PedProv)->min('Id_PedProv');
                $next = PedidoProveedor::where('Id_PedProv', '<', $pedido->Id_PedProv)->max('Id_PedProv');

                // $previous = PedidoProveedor::where('PedProv_FeHo', '>', $pedido->PedProv_FeHo)->min('Id_PedProv');
                // $next = PedidoProveedor::where('PedProv_FeHo', '<=', $pedido->PedProv_FeHo)->max('Id_PedProv');
            } 

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.PedidoProveedor.js.show_fetch_1",compact("pedido",'previous','next'));        
    }
    public function show_pedidoproveedor_2(Request $request)
    {
        $id=$request->id;
        $pedido=PedidoProveedor::findOrFail($id);            
            $proveedor=Proveedor::findOrFail($pedido->Id_Prov);
            $sucursal=Sucursal::findOrFail($pedido->Id_Suc);
            $punto=PtoExpedicion::findOrFail($pedido->Id_PtoExp);
            $medios_pag=Medio_Pago::all();  
            $users=User::all();        
            $oc=OrdenCompra::where('Id_PedProv','=',$id)->first()->Id_OC;                 
            $compra=Compra::where('Id_OC', '=', $id)->first(); //colecction, array, de arrays

            if($compra){
                $compra=$compra->Id_Com;                    
            }else{
                $compra='';
            }
        
        $detalles=PedidoProveedorDetalle::where('Id_PedProv','=',$id)->get();       
        $det_art=PedidosProveedoresDetalleArticulos::where('Id_PedProv','=',$id)->get();       
            $articulos=Articulo::all();

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.PedidoProveedor.js.show_fetch_2",
        compact("pedido",'proveedor','sucursal','punto','users','detalles','det_art','articulos','oc','compra','medios_pag'));                            
    } 
    //oc
    public function show_oc_1(Request $request)
    {                
        $id=$request->id;

        $orden=OrdenCompra::findOrFail($id);
            $previous = OrdenCompra::where('Id_OC', '>', $orden->Id_OC)->min('Id_OC');
            $next = OrdenCompra::where('Id_OC', '<', $orden->Id_OC)->max('Id_OC');

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }
        
        return view("$nivel.OrdenCompra.js.show_fetch_1",compact("orden",'previous','next'));
    }
    public function show_oc_2(Request $request)
    {
        $id=$request->id;     
        
        $orden=OrdenCompra::findOrFail($id);
        $o_detalle=OrdenCompraDetalle::where('Id_OC', '=', $id)->get(); // all()
        $ocd_a=OrdenCompraDetalleArticulos::where('Id_OC', '=', $id)->get();
            $proveedores=Proveedor::all();
            $sucursales=Sucursal::all();
            $medios_pag=Medio_Pago::all();
            $users=User::all();
            $articulos=Articulo::all();
        
            $compra=Compra::where('Id_OC', '=', $id)->first(); //colecction, array, de arrays

            if($compra){
                $compra=$compra->Id_Com;                    
            }else{
                $compra='';
            }
        
        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }    
        
        return view("$nivel.OrdenCompra.js.show_fetch_2",
                compact("orden",'proveedores','sucursales','medios_pag','users','articulos','compra',"o_detalle",'ocd_a'));
    } 
    //compra
    public function show_compra_1(Request $request)
    {                
        $id=$request->id;

        $compra=Compra::find($id);
            $previous = Compra::where('Id_Com', '>', $id)->min('Id_Com');
            $next = Compra::where('Id_Com', '<', $id)->max('Id_Com');

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }
    
        return view("$nivel.Compras.js.show_fetch_1",compact("compra",'previous','next'));
    }
    public function show_compra_cab(Request $request)
    {
        $id=$request->id;

        $compra=Compra::find($id);
        $proveedores=Proveedor::all();
        $medios_pag=Medio_Pago::all();

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Compras.js.show_fetch_c",compact("compra",'proveedores','medios_pag'));
    } 
    public function show_compra_det(Request $request)
    {
        $id=$request->id;        

        $compra_det=CompraDetalle::where('Id_Com','=',$id)->get();   
        $det_art=CompraDetalleArticulos::where('Id_Com','=',$id)->get();   
        $articulos=Articulo::all();  

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Compras.js.show_fetch_d",compact('compra_det','det_art','articulos'));
    } 
    public function show_compra_tot(Request $request)
    {
        $id=$request->id;

        $compra=Compra::find($id);  

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Compras.js.show_fetch_t",compact("compra"));
    } 

    //categoria    
    public function show_categoria_1(Request $request)
    {                
        $id=$request->id;

        $cat=Categoria::findOrFail($id);
            $previous = Categoria::where('Id_Cat', '<', $id)->max('Id_Cat');
            $next = Categoria::where('Id_Cat', '>', $id)->min('Id_Cat');

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.ProductoCategoria.js.show_fetch_1",compact("cat",'previous','next'));
        
    }
    public function show_categoria_2(Request $request)
    {
        $id=$request->id;

        $cat=Categoria::findOrFail($id);
        $detalles=CategoriaDetalle::where('Id_Cat','=',$id)->get();     
            $productos=Articulo::where('Art_Tip','=','Producto')->get();    
            $pro_cat=Articulo::where('Id_Cat','=',$id)->get();      
            $impuestos=Impuesto::all();
            $users=User::all();

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.ProductoCategoria.js.show_fetch_2",compact('cat','productos','users','detalles','impuestos','pro_cat'));                            
    }  
    //listaprecio     
    public function show_lp_1(Request $request)
    {                
        $id=$request->id;

        $lista=ListaPrecio::findOrFail($id);

            $previous = ListaPrecio::where('Id_Lp', '<', $lista->Id_Lp)->max('Id_Lp');
            $next = ListaPrecio::where('Id_Lp', '>', $lista->Id_Lp)->min('Id_Lp');

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.ListaPrecio.js.show_fetch_1",compact("lista",'previous','next'));
        
    }
    public function show_lp_2(Request $request)
    {
        $id=$request->id;

        $lista=ListaPrecio::findOrFail($id);
            $detalles=ListaPrecioDetalle::where('Id_Lp','=',$id)->get();

            $productos=Articulo::where('Art_Tip','=','Producto')->orderBy('Id_Art')->simplePaginate(20);
            $cant=Articulo::where('Art_Tip','=','Producto')->count();
            $clientes=Cliente::where('Id_Lp','=',$id)->count(); //cat

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.ListaPrecio.js.show_fetch_2",compact("lista",'detalles','productos','cant','clientes'));                            
    } 
    //producto
    public function show_producto_1(Request $request)
    {                
        $id_prod=$request->id;
        $producto=Articulo::where('Id_Prod','=',$id_prod)->get()[0];                

            $previous = Articulo::where('Id_Prod', '<', $id_prod)->max('Id_Prod');
            $next = Articulo::where('Id_Prod', '>', $id_prod)->min('Id_Prod');

                // mientras
                // $productos=Articulo::where('Art_Tip','=','Producto')->get()->count();
                $produccion=Produccion::where('Id_Prod','=',$producto->Id_Art)->count();                    
                $ped_prov=PedidosProveedoresDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                $compras=CompraDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                $ped_cli=PedidoClienteDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                $ventas=VentaDetalleArticulos::where('Id_Art','=',$producto->Id_Art)->count();                    
                $descuentos=DescuentoDetalle::where('Id_Art','=',$producto->Id_Art)->count(); 

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Producto.js.show_fetch_1",compact("producto",'previous','next',
        'produccion','ped_prov','compras','ped_cli','ventas','descuentos'));        
    }
    public function show_producto_2(Request $request)
    {
        $id_prod=$request->id;
        $producto=Articulo::where('Id_Prod','=',$id_prod)->get()[0];
            $detalles=ArticuloDetalle::all();
            $categorias=Categoria::all();
            $impuestos=Impuesto::all();
            $proveedores=Proveedor::all();
            $users=User::all();
            $listas=ListaPrecio::all();

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Producto.js.show_fetch_2",compact("producto",'detalles',
                "impuestos","proveedores","users","listas",'categorias'));                            
    }
    // cliente
    public function show_cliente_1(Request $request)
    {                
        $id=$request->id;
        $cliente=Cliente::find($id); 
            // $ventas=2;
            $ventas=Venta::where('Id_Cli','=',$request->id)
                        ->where('Ven_Est','=','Válida')
                        ->count();
            $pedidos=PedidoCliente::where('Id_Cli','=',$id)->count();

            $previous = Cliente::where('Id_Cli', '<', $cliente->Id_Cli)->max('Id_Cli');
            $next = Cliente::where('Id_Cli', '>', $cliente->Id_Cli)->min('Id_Cli');

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Clientes.js.show_fetch_1",compact("cliente",'previous','next','ventas','pedidos'));
        
    }
    public function show_cliente_2(Request $request)
    {
        $id=$request->id;
        $cliente=Cliente::find($id);
            
            // $ventas=2;
            $ventas=Venta::where('Id_Cli','=',$request->id)
                        ->where('Ven_Est','=','Válida')
                        ->count();                        
            $listas=ListaPrecio::all();
            $users=User::all();             

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Clientes.js.show_fetch_2",compact("cliente",'users','ventas','listas'));                            
    }
    //descuento
    public function show_descuento_1(Request $request)
    {                
        $id=$request->id;
        $descuento=Descuento::find($id);      
        
            $next = Descuento::where('Id_Desc', '<', $id)->max('Id_Desc');
            $previous = Descuento::where('Id_Desc', '>', $id)->min('Id_Desc');

            $ventas=VentaDetalle::where('Id_Desc', '=', $id)->count();
                        
        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Descuento.js.show_fetch_1",compact("descuento",'previous','next','ventas'));        
    }
    public function show_descuento_2(Request $request)
    {
        $id=$request->id;
        $descuento=Descuento::find($id);      
        $users=User::all();

            $detalle=DescuentoDetalle::where('Id_Desc','=',$id)->get();
            $listas=ListaPrecio::all();
            $clientes=Cliente::all();
            $categorias=Categoria::all();
            $productos=Articulo::all();    

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.Descuento.js.show_fetch_2",
                compact('descuento','users','detalle','listas','clientes','categorias','productos'));                           
    } 
    //pedido cliente 
    public function show_pedidocliente_1(Request $request)
    {                
        $id=$request->id;
        $pedido=PedidoCliente::findOrFail($id);            
        
            if(Session::get('filtro')){             
                $filtro=Session::get('filtro');
                
                if($filtro=='Pendiente'){                    
                    // ult time = id desc
                    $previous = PedidoCliente::where('PedCli_Est','=',$filtro)
                        ->where('Id_PedCli', '>', $pedido->Id_PedCli)->min('Id_PedCli');
                    $next = PedidoCliente::where('PedCli_Est','=',$filtro)
                        ->where('Id_PedCli', '<', $pedido->Id_PedCli)->max('Id_PedCli');                                    
                }else{
                    $previous = PedidoCliente::where('Id_PedCli', '>', $pedido->Id_PedCli)->min('Id_PedCli');
                    $next = PedidoCliente::where('Id_PedCli', '<', $pedido->Id_PedCli)->max('Id_PedCli');                    
                }
            }else{
                $previous = PedidoCliente::where('Id_PedCli', '>', $pedido->Id_PedCli)->min('Id_PedCli');
                $next = PedidoCliente::where('Id_PedCli', '<', $pedido->Id_PedCli)->max('Id_PedCli');                
            }  

        if(Auth::user()->Id_Prf==2){
            $nivel='Admin';
        }else if(Auth::user()->Id_Prf==1){
            $nivel='Vend';
        }

        return view("$nivel.PedidoCliente.js.show_fetch_1",compact("pedido",'previous','next'));        
    }
    public function show_pedidocliente_2(Request $request)
    {
        $id=$request->id;

        $pedido=PedidoCliente::find($id);          
        $cliente=Cliente::findOrFail($pedido->Id_Cli);
        $sucursal=Sucursal::findOrFail($pedido->Id_Suc);
        $punto=PtoExpedicion::findOrFail($pedido->Id_PtoExp);  
        $medios_pag=Medio_Pago::all();          
        $users=User::all();     
        $listas=ListaPrecio::all();
            // $desc=Descuento::where('Desc_Des','=','Mayorista')->get()[0]->Id_Desc;  
            // $mayorista=DescuentoDetalle::where('Id_Desc','=',$desc)->get(); //
            // $mayorista=$mayorista->get(0)->DD_Porc;

            $venta=Venta::where('Id_PedCli', '=', $id)->first(); //cli
            //colecction, array, de arrays

            if($venta){
                $venta=$venta->Id_Ven;                    
            }else{
                $venta='';
            }
        
            $detalles=PedidoClienteDetalle::where('Id_PedCli','=',$id)->get();       
            $det_art=PedidoClienteDetalleArticulos::where('Id_PedCli','=',$id)->get();       
                $articulos=Articulo::all();

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.PedidoCliente.js.show_fetch_2",
                    compact("pedido",'cliente','sucursal','punto','users','detalles','det_art','articulos','venta','medios_pag','listas')); //,'mayorista'                     
    } 
    //venta
    public function show_venta_1(Request $request) //ya es seguro porque existe reg
    {                
        $id=$request->id;

        $venta=Venta::find($id);
            $previous = Venta::where('Id_Ven', '>', $id)->min('Id_Ven');
            $next = Venta::where('Id_Ven', '<', $id)->max('Id_Ven');

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }
    
        return view("$nivel.Ventas.js.show_fetch_1",compact("venta",'previous','next'));
    }
    public function show_venta_cab(Request $request)
    {
        $id=$request->id;

            $venta=Venta::find($id);        
        $medio_pag=Medio_Pago::find($venta->Id_MedPag);
        $cliente=Cliente::find($venta->Id_Cli);
        $sucursal=Sucursal::find($venta->Id_Suc);
        $punto=PtoExpedicion::find($venta->Id_PtoExp);
        $timb=Timbrado::find($venta->Id_Timb);

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Ventas.js.show_fetch_c",
        compact('venta',"medio_pag",'cliente','sucursal','punto','timb'));
    } 
    public function show_venta_det(Request $request)
    {
        $id=$request->id;        

            $venta=Venta::find($id);    
        $venta_det=VentaDetalle::where('Id_Ven','=',$id)->get();   
        $det_art=VentaDetalleArticulos::where('Id_Ven','=',$id)->get();   
        $articulos=Articulo::all();  

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Ventas.js.show_fetch_d",compact('venta','venta_det','det_art','articulos'));
    } 
    public function show_venta_tot(Request $request)
    {
        $id=$request->id;

        $venta=Venta::find($id);  

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Ventas.js.show_fetch_t",compact("venta"));
    }
}