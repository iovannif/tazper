<?php
namespace Tazper\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//tabla
use Tazper\Sucursal;

class SucursalController extends Controller
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
            $sucursales=Sucursal::all();
                $cant=$sucursales->count();

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

            return view("$nivel.Sucursal.index",compact('sucursales','cant'));
        }else{
            return view('Vend.restrincted');                    
        }
    }

    //MOSTRAR
    public function show($id)
    {
        if(Auth::user()->Id_Prf==2){
            try{
                $sucursal=Sucursal::findOrFail($id);            

                    $previous = Sucursal::where('Id_Suc', '<', $sucursal->Id_Suc)->max('Id_Suc');
                    $next = Sucursal::where('Id_Suc', '>', $sucursal->Id_Suc)->min('Id_Suc');

                    if(Auth::user()->Id_Prf==2){
                        $nivel='Admin';
                    }else if(Auth::user()->Id_Prf==1){
                        $nivel='Vend';
                    }

                return view("$nivel.Sucursal.show",compact("sucursal",'previous','next'));
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
                if(Auth::user()->Id_Prf==2){
                    $sucursal=Sucursal::findOrFail($id);                       

                    return view("Admin.Sucursal.edit",compact("sucursal"));
                }else{
                    return view('Vend.restrincted');                    
                }        
            }catch(ModelNotFoundException $e){    
                return back();
            }
        }else{
            return view('Vend.restrincted');                    
        }
    }
    
    public function update(Request $request, $id)
    {
        if(Auth::user()->Id_Prf==2){
                $this->validate($request, [                                
                    'Suc_NomFan' => 'required|string|max:30',
                    'Suc_Des' => 'required|string|max:30|unique:sucursal,Suc_Des,'.$id.',Id_Suc',
                    'Suc_Tel' => 'required|string|min:8|max:15|unique:sucursal,Suc_Tel,'.$id.',Id_Suc',
                    'Suc_Dir' => 'required|string|max:50|unique:sucursal,Suc_Dir,'.$id.',Id_Suc',
                    'Suc_Ciu' => 'required|string|max:30',     
                    'Suc_Bar' => 'required|string|max:30',   
                    'Suc_Red1' => 'max:30',
                    'Suc_Red2' => 'max:30',
                    'Suc_Ruc' => 'required|string|max:20',
                    'Suc_RazSoc' => 'required|string|max:40',
                    'Suc_Est' => 'required|string|min:6|max:8',
                    'Suc_Obs' => 'max:140',                   
                ]);
        
                $sucursal=Sucursal::findOrFail($id);
            $sucursal->update($request->all());

                Session::flash('sucursal_modificada','Registro modificado'); 
            return redirect("Sucursal/$id");
        }else{
            return view('Vend.restrincted');                    
        }
    }
}