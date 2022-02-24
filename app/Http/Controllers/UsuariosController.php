<?php
namespace Tazper\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
// use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//tablas
use Tazper\User; use Auth;
//relaciones
use Tazper\Perfil;
use Tazper\Personal;

class UsuariosController extends Controller
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
            $users=User::all();
                $cant=$users->count();
                $perfiles=Perfil::all();
                $personal=Personal::all();

            return view("Admin.Usuarios.index",compact('users','cant','perfiles','personal'));
        }else{
            return view('Vend.restrincted');
        }
    }

    //MOSTRAR
    public function show($id)
    {
        if(Auth::user()->Id_Prf==2){
            try{
                $user=User::findOrFail($id);
                    $users=User::all();
                    $perfiles=Perfil::all();
                    $personal=Personal::all();

                    $previous = User::where('Id_Usu', '<', $user->Id_Usu)->max('Id_Usu');
                    $next = User::where('Id_Usu', '>', $user->Id_Usu)->min('Id_Usu');

                return view("Admin.Usuarios.show",compact('user','users','previous','next','perfiles','personal'));
            }catch(ModelNotFoundException $e){    
                return back(); // return redirect("Usuarios");
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
                $user=User::findOrFail($id);
                    $personal=Personal::all();

                    $previous = User::where('Id_Usu', '<', $user->Id_Usu)->max('Id_Usu');
                    $next = User::where('Id_Usu', '>', $user->Id_Usu)->min('Id_Usu');

                return view("Admin.Usuarios.edit",compact("user",'previous','next','personal'));
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
            $user=User::findOrFail($id);

                $this->validate($request, [                                                                                        
                    'Usu_User' => 'required|string|max:20|unique:users,Usu_User,'.$id.',Id_Usu',
                    // 'Usu_User' => 'required|string|max:20',Rule::unique('users','Usu_User')->ignore($id, 'Id_Usu'),                                                                                                    
                    'Id_Prf' => 'required|integer|min:1|max:2',
                    'Usu_Pass' => 'required|string|min:8|max:20|confirmed',                
                    'Usu_Est' => 'required|string|min:6|max:8',
                    'Id_Per' => 'required|integer|digits_between:1,4|unique:users,Id_Per,'.$id.',Id_Usu',
                    'Usu_Obs' => 'max:140',
                ]);

            $user->update([
                'Usu_User'=>$request->Usu_User,
                'Id_Prf'=>$request->Id_Prf,
                'Usu_Pass'=>bcrypt($request->Usu_Pass),
                'Id_Per'=>Input::get('Id_Per'),
                'Usu_Est'=>$request->Usu_Est,
                'Usu_Obs'=>$request->Usu_Obs,
                
                'Usu_MdfPor'=>Auth::user()->Id_Usu,
                'Usu_MdfUser'=>Auth::user()->Usu_User
            ]);

                Session::flash('user_modificado','Registro modificado');
            return redirect("/Usuarios/$id");
        }else{
            return view('Vend.restrincted');
        }
    }

    //ELIMINAR
    public function destroy(Request $request, $id) // Un registro
    {
        if(Auth::user()->Id_Prf==2){
            // AJAX
            if($request->ajax()){ // js no deja pasar Admin 1
                $user=User::findOrFail($id);
                    $id_per=$user->Id_Per;
                    $personal=Personal::findOrFail($id_per);

                $user->delete();
                $personal->delete();

            // NORMAL
            }else{
                $users=User::all()->count();

                if($id!=1){ // No es admin 1
                    $user=User::findOrFail($id);
                        $id_per=$user->Id_Per;
                        $personal=Personal::findOrFail($id_per);
                        
                    $user->delete();
                    $personal->delete();

                        Session::flash('user_borrado','Registro borrado'); // no es el que se imprime
                    return redirect(url("/Usuarios"));                    
                }else{ // Es admin 1
                    if($users>1){ // hay otros users
                            Session::flash('user_rechazo','Registro no borrado'); // no es el que se imprime
                        return back();
                    }else{ // no quedan users
                        $user=User::findOrFail($id);
                            $id_per=$user->Id_Per;
                            $personal=Personal::findOrFail($id_per);   

                        $user->delete();
                        $personal->delete();
                                                
                        return redirect(url('/Usuarios'));
                    }
                }

            }
        }else{
            return view('Vend.restrincted');
        }
    }
    
    public function remove(Request $request) // Varios
    {
        if(Auth::user()->Id_Prf==2){
            if($request->ajax()){
                    $ids=$request->ids;
                    $empleados=$request->personal;
                User::whereIn("Id_Usu",explode(",",$ids))->delete();
                Personal::whereIn("Id_Per",explode(",",$empleados))->delete();
            }
        }else{
            return view('Vend.restrincted');
        }
    }
}