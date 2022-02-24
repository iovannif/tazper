@extends('Admin.lay.Create')
<!-- css -->
<style>
    #content{
        margin-bottom:56px !important; /* scroll */
    }
</style>

@if($users->count()==0)
    <style>
        #barra{
            display:none;
        }
        #content{
            margin-top:6% !important;
        }
        #titulo{
            background:#FAFAFA !important;
            color:red !important;            
            font-weight:bold !important;
            text-shadow:0 0 1px grey !important;
            box-shadow:1px 1px 1px 1px grey !important;
            border-radius:2px !important;
        }
        #contenido{
            padding-top:34px !important;
            padding-bottom:30px !important;
        }        
        #registrar{
            margin-right: 15px !important;
        }
        #limpiar{
            margin-right:0 !important;
        }        
    </style>

    @section('titulo')
        Registrar Administrador
    @endsection
@else
    @section('titulo')
        Registrar Usuario
    @endsection

    <style>
        #contenido{
            padding-top:30px !important;
            padding-bottom:20px !important;
        }
    </style>
@endif

<style>
    /* Contenido */
    td{
        padding:3px 0 3px 10px !important;
    }
    .top{
        vertical-align: top;
    }

    td input,td .seleccion,textarea#obs{
        margin-left:35px !important;
    }

    .cambiar2{
        display:inline !important;
    }

    /* Navegacion 2 */
    .boton{
        padding: 4px 8px !important;
        margin-right:5px !important;
    }
    #cancelar{
        margin-right:0 !important;
    }
</style>

<!-- html -->
@section('contenido')
    <form class="form-horizontal" method="POST" action="{{route('register')}}" spellcheck="false" autocomplete="off">
        {{csrf_field()}}
        <table id="principal">
            <tr>
                <td><label for="username">Username:</label></td>
                <td>
                    <input type="text" name="Usu_User" class="primer" size="20" maxlength="20" placeholder="obligatorio" value="{{old('Usu_User')}}" required autofocus>
                    @if($errors->has('Usu_User'))<span class="help-block">{{$errors->first('Usu_User')}}</span>@endif
                </td>
            </tr>

            @if($users->count()>0)
                <tr>
                    <td><label for="perfil">Perfil:</label></td>
                    <td>
                        <select class="seleccion" name="Id_Prf" maxlength="4" min="1" max="2" minxlength="1" maxlength="1" value="old('Id_Prf')" required>
                            @foreach($perfiles as $perfil)
                                <option value="{{$perfil->Id_Prf}}">{{$perfil->Prf_Des}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('Id_Prf'))<span class="help-block">{{$errors->first('Id_Prf')}}</span>@endif
                    </td>
                </tr>
            @else
                <tr class="hidden"><td>
                <select name="Id_Prf" min="1" max="2" minxlength="1" maxlength="1" required><option value="2">Administrador</option></select>
                </td></tr>
            @endif

            <tr>
                <td><label for="password">Contraseña:</label></td>
                <td>
                    <input type="password" name="Usu_Pass" size="20" minlength="8" maxlength="20" placeholder="obligatorio" value="{{old('Usu_Pass')}}" required>
                    @if($errors->has('Usu_Pass'))<span class="help-block">{{$errors->first('Usu_Pass')}}</span>@endif
                </td>
            </tr>

            <tr>
                <td><label for="password-confirm">Confirmación:</label></td>
                <td><input type="password" name="Usu_Pass_confirmation" size="20" minlength="8" maxlength="20" placeholder="obligatorio" value="{{old('Usu_Pass_confirmation')}}" required></td>
            </tr>        
            
            @if($users->count()>0)
                <tr>
                    <td><label for="personal">Personal:</label></td>

                    @if(old('Id_Per')!='')
                        @foreach($personal as $empleado)
                            @if($empleado->Id_Per==old('Id_Per'))
                            <td>
                                <input type="text" class="busca" id="busca_per" size="35" maxlength="40" value="{{$empleado->Per_Nom.', '.$empleado->Per_Ape}}" disabled required>
                                <button id="cambiar" class="cambiar2">cambiar</button>
                                @if($errors->has('Id_Per'))<span class="help-block">{{$errors->first('Id_Per')}}</span>@endif
                            </td>
                            @endif
                        @endforeach
                    @else
                    <td>
                        <input type="text" class="busca" id="busca_per" size="35" maxlength="40" placeholder="obligatorio" required>                        
                        <button id="cambiar">cambiar</button>
                        @if($errors->has('Id_Per'))<span class="help-block">{{$errors->first('Id_Per')}}</span>@endif
                    </td>
                    @endif
                </tr>

                <!-- js -->
                <tr>
                    <td class="resultado">
                        <div id="personal"></div>
                    </td>
                </tr>
                
                <!-- id -->
                <tr class="hidden"><td>
                    <input type="hidden" name="Id_Per" id="id_per" size="4" maxlength="4" value="{{old('Id_Per')}}" required>
                </td></tr>
            @else
                <tr class="hidden"><td>
                <input type="hidden" name="Id_Per" size="4" maxlength="4" value="1" required>
                </td></tr>
            @endif            
            
            <tr>
                <td><label for="estado">Estado:</label></td>
                <td>
                    <select class="seleccion" name="Usu_Est" minlength="6" maxlength="8" value="old('Usu_Est')" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                    @if($errors->has('Usu_Est'))<span class="help-block">{{$errors->first('Usu_Est')}}</span>@endif
                </td>
            </tr>

            <tr>
                <td class="obs"><label for="observacion">Observación:</label></td>
                <td>
                    <textarea name="Usu_Obs" id="obs" cols="50" rows="4" maxlength="140" placeholder="opcional">{{old('Usu_Obs')}}</textarea>
                    @if($errors->has('Usu_Obs'))<br><span class="help-block top" id="obs">{{$errors->first('Usu_Obs')}}</span>@endif
                </td>
            </tr>
        </table>
@endsection

@section('navegacion_2')
        <div class="arriba">
            <button class="boton" type="submit" id="registrar">Registrar</button>
            <button class="boton" type="reset" id="limpiar">Limpiar</button>
    </form>
        @if($users->count()>0)
            <a href="{{url('/Usuarios')}}"><button class="boton lista" id="volver">Volver</button></a>
            <a href="{{url('/Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>
        @endif
        </div>
@endsection

<!-- js -->
<script src="{{asset('js/vistas/create_edit/user.js')}}"></script>