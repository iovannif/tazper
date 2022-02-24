<?php
namespace Tazper\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//tablas
use Tazper\Personal;
//relaciones
use Tazper\User; use Auth;

class PersonalController extends Controller
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
            $personal=Personal::all();
                $cant=Personal::all()->count();
                $users=User::all();

            if($request->ajax()){
                $view=view("Admin.Personal.js.ajax",compact('personal','cant','users'))->renderSections();
                return response()->json([
                    'nav'=>$view['navegacion_1'],
                    'contenido'=>$view['contenido'],
                ]);
            }

            return view("Admin.Personal.index",compact('personal','cant','users'));
        }else{
            return view('Vend.restrincted');
        }
    }

    //AGREGAR
    public function create()
    {                   
        if(Auth::user()->Id_Prf==2){
            $personal=Personal::all()->count();            

            if($personal<20){
                return view("Admin.Personal.create");
            }else{
                // return view('Vend.restrincted');
                return back();
            }        
        }else{
            return view('Vend.restrincted');            
        }        
    }
    
    public function store(Request $request)
    {
        if(Auth::user()->Id_Prf==2){        
            $current=\Carbon\Carbon::now()->year;			
                $max_year=$current-18;
                $min_year=$current-70;
                $fecha=\Carbon\Carbon::now()->format('m-d');
            $max=$max_year.'-'.$fecha;
            $min=$min_year.'-'.$fecha;
            
            $this->validate($request, [            
                'Per_Nom' => 'required|string|max:20',
                'Per_Ape' => 'required|string|max:20',
                'Per_CI' => 'required|string|max:15',
                'Per_Car' => 'required|string|max:20',            
                'Per_FeNac' => "required|date|min:10|max:10|after_or_equal:$min|before_or_equal:$max",
                'Per_LugNac' => 'required|string|max:30',
                'Per_Nac' => 'required|string|max:20',
                'Per_Gen' => 'required|string|min:8|max:9',
                'Per_EstCiv' => 'required|string|min:5|max:15',
                'Per_Hij' => 'required|string|max:2',
                'Per_Tel' => 'max:15',
                'Per_Cel' => 'required|string|min:10|max:15',
                'Per_Email' => 'max:30',
                'Per_Dir' => 'required|string|max:50',
                'Per_Ciu' => 'required|string|max:30',
                'Per_Bar' => 'required|string|max:30',
                'Per_Ini' => 'required|date|min:10|max:10|after_or_equal:2016-01-01',
                'Per_Tur' => 'required|string|min:5|max:60',
                'Per_Est' => 'required|string|min:6|max:8',
                'Per_Obs' => 'max:140'                        
            ]);
            
                $entrada=$request->all();
            Personal::create($entrada);

                $personal=Personal::latest()->first();        
                $personal->update(['Per_RegPor'=>Auth::user()->Id_Usu,
                                'Per_RegUser'=>Auth::user()->Usu_User]);                                                        
            
                Session::flash('personal_agregado','Registro agregado');
            return redirect("/Personal");
        }else{
            return view('Vend.restrincted');
        }
    }

    //MOSTRAR
    public function show($id)
    {
        if(Auth::user()->Id_Prf==2){
            try{
                $personal=Personal::findOrFail($id);
                $users=User::all();
                    $previous = Personal::where('Id_Per', '<', $personal->Id_Per)->max('Id_Per');
                    $next = Personal::where('Id_Per', '>', $personal->Id_Per)->min('Id_Per');

                return view("Admin.Personal.show",compact("personal",'previous','next','users'));
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
                $personal=Personal::findOrFail($id);
                    $previous = Personal::where('Id_Per', '<', $personal->Id_Per)->max('Id_Per');
                    $next = Personal::where('Id_Per', '>', $personal->Id_Per)->min('Id_Per');

                return view("Admin.Personal.edit",compact("personal",'previous','next'));
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
            $current=\Carbon\Carbon::now()->year;			
                $max_year=$current-18;
                $min_year=$current-70;
                $fecha=\Carbon\Carbon::now()->format('m-d');
            $max=$max_year.'-'.$fecha;
            $min=$min_year.'-'.$fecha;
            
            $this->validate($request, [            
                'Per_Nom' => 'required|string|max:20',
                'Per_Ape' => 'required|string|max:20',
                'Per_CI' => 'required|string|max:15',
                'Per_Car' => 'required|string|max:20',            
                'Per_FeNac' => "required|date|min:10|max:10|after_or_equal:$min|before_or_equal:$max",
                'Per_LugNac' => 'required|string|max:30',
                'Per_Nac' => 'required|string|max:20',
                'Per_Gen' => 'required|string|min:8|max:9',
                'Per_EstCiv' => 'required|string|min:5|max:15',
                'Per_Hij' => 'required|string|max:2',
                'Per_Tel' => 'max:15',
                'Per_Cel' => 'required|string|min:10|max:15',
                'Per_Email' => 'max:30',
                'Per_Dir' => 'required|string|max:50',
                'Per_Ciu' => 'required|string|max:30',
                'Per_Bar' => 'required|string|max:30',
                'Per_Ini' => 'required|date|min:10|max:10|after_or_equal:2016-01-01',
                'Per_Tur' => 'required|string|min:5|max:60',
                'Per_Est' => 'required|string|min:6|max:8',
                'Per_Obs' => 'max:140'                    
            ]);

                $personal=Personal::findOrFail($id);
            $personal->update($request->all());
                
                $personal->update(['Per_MdfPor'=>Auth::user()->Id_Usu,
                                'Per_MdfUser'=>Auth::user()->Usu_User]);
                
                Session::flash('personal_modificado','Registro modificado');
            return redirect("/Personal/$id");
        }else{
            return view('Vend.restrincted');
        }
    }

    //ELIMINAR
    public function destroy(Request $request, $id)
    {        
        if(Auth::user()->Id_Prf==2){
            if($request->ajax()){
                    $personal=Personal::findOrFail($id);
                $personal->delete();
            }else{
                    $personal=Personal::findOrFail($id);
                $personal->delete();

                    Session::flash('personal_eliminado','Registro borrado');
                return redirect("/Personal");        
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
                Personal::whereIn("Id_Per",explode(",",$ids))->delete();
            }
        }else{
            return view('Vend.restrincted');
        }
    }

    //datos personales
    public function dp_show()
    {
            $per=Personal::where('Id_Usu',Auth::user()->Id_Usu)->get();
            $id=$per->get(0)->Id_Per;

        $personal=Personal::findOrFail($id);        
            $users=User::all();

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Personal.datos_personales.dp_show",compact('personal','users'));
    }
    
    public function dp_edit()
    {
            $per=Personal::where('Id_Usu',Auth::user()->Id_Usu)->get();
            $id=$per->get(0)->Id_Per;

        $personal=Personal::findOrFail($id);

            if(Auth::user()->Id_Prf==2){
                $nivel='Admin';
            }else if(Auth::user()->Id_Prf==1){
                $nivel='Vend';
            }

        return view("$nivel.Personal.datos_personales.dp_edit",compact('personal'));
    }
    
    public function dp_update(Request $request, $id)
    {
        $current=\Carbon\Carbon::now()->year;			
            $max_year=$current-18;
            $min_year=$current-70;
            $fecha=\Carbon\Carbon::now()->format('m-d');
        $max=$max_year.'-'.$fecha;
        $min=$min_year.'-'.$fecha;
            
        $this->validate($request, [            
            'Per_Nom' => 'required|string|max:20',
            'Per_Ape' => 'required|string|max:20',
            'Per_CI' => 'required|string|max:15',                            
            'Per_FeNac' => "required|date|min:10|max:10|after_or_equal:$min|before_or_equal:$max",
            'Per_LugNac' => 'required|string|max:30',
            'Per_Nac' => 'required|string|max:20',
            'Per_Gen' => 'required|string|min:8|max:9',
            'Per_EstCiv' => 'required|string|min:5|max:15',
            'Per_Hij' => 'required|string|max:2',
            'Per_Tel' => 'max:15',
            'Per_Cel' => 'required|string|min:10|max:15',
            'Per_Email' => 'max:30',
            'Per_Dir' => 'required|string|max:50',
            'Per_Ciu' => 'required|string|max:30',
            'Per_Bar' => 'required|string|max:30'        
        ]);        

            $personal=Personal::findOrFail($id);
        $personal->update($request->all());
        
            $personal->update(['Per_MdfPor'=>Auth::user()->Id_Usu,
                            'Per_MdfUser'=>Auth::user()->Usu_User]);

            Session::flash('personal_modificado','Registro modificado');
        return redirect("/Datos_personales");
    }
}