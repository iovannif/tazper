@extends('Admin.lay.Edit')

<style>
    #content{
        margin-bottom:14px !important;
    }        

    .cambiar2{
        display:inline !important;
    }
</style>

@section('titulo')
    Editar Usuarios
@endsection

@section('navegacion_1')
	<div id="este">		
		<button class="boton eliminar primer" id="eliminar">Eliminar</button>		
        <a href="{{url('/Usuarios/'.$user->Id_Usu)}}" class="volver"><button class="boton lista" id="volver">Volver</button></a>
		<a href="{{url('/Usuarios')}}" class="listado"><button class="boton lista" id="lista">Lista</button></a>
	</div>
@endsection

@section('contenido')
    @include('Admin.Usuarios.session_div.edit')

	{!! Form::model($user, ['method'=>'PATCH', 'action'=>['UsuariosController@update', $user->Id_Usu], 'spellcheck'=>'false',  'autocomplete'=>'off']) !!}
        <table id="principal" spellcheck="false">
            <tr>
                <td><label for="id_usu">Id de usuario:</label></td>
                <td><input type="text" size="4" value="{{$user->Id_Usu}}" disabled></td>
            </tr>

            <tr>                
                <td><label for="username">Username:</label></td>
                <td>
                    @if($errors->any())                                    
                        <input type="text" name="Usu_User" class="primero" id="usermane" placeholder="obligatorio" size="20" maxlength="20" value="{{old('Usu_User')}}" required autofocus>
                        @if($errors->has('Usu_User'))
                        <span class="help-block">{{$errors->first('Usu_User')}}</span>
                        @endif
                    @else
                        <input type="text" name="Usu_User" class="primero" id="usermane" placeholder="obligatorio" size="20" maxlength="20" value="{{$user->Usu_User}}" required autofocus>
                    @endif
                </td>
            </tr>

            <tr>
                <td><label for="tipo">Perfil:</label></td>
                <td>
                    @php
						$prf_1 = '1';
						$prf_2 = '2';
					@endphp

					<select class="seleccion" name="Id_Prf" min="1" max="2" minlength="1" maxlength="1" value="{{old('Id_Prf')}}" required>
						@if($user->Id_Prf == $prf_1)
							<option value="{{$prf_1}}">{{'Vendedor'}}</option>
							<option value="{{$prf_2}}">{{'Administrador'}}</option>
						@elseif($user->Id_Prf == $prf_2)
							<option value="{{$prf_2}}">{{'Administrador'}}</option>
							<option value="{{$prf_1}}">{{'Vendedor'}}</option>
						@endif
					</select>

                    @if($errors->has('Id_Prf'))<span class="help-block">{{$errors->first('Id_Prf')}}</span>@endif
                </td>                
            </tr>

            <tr>
                <td><label for="password">Contraseña:</label></td>
                <td>
                    <input type="password" name="Usu_Pass" id="password" placeholder="obligatorio" size="20" minlength="8" maxlength="20" value="{{old('Usu_Pass')}}" required>
                    @if($errors->has('Usu_Pass'))
                        <span class="help-block">{{$errors->first('Usu_Pass')}}</span>
                    @endif
                </td>                
            </tr>

            <tr>
                <td><label for="password-confirm">Confirmación:</label></td>
                <td><input type="password" name="Usu_Pass_confirmation" id="Usu_Pass-confirm" placeholder="obligatorio" size="20" minlength="8" maxlength="20" value="{{old('Usu_Pass_confirmation')}}" required></td>                
            </tr>                                    

            <tr>
                <td><label for="personal">Personal:</label></td>

                @if($errors->any())
                    @if(old('Id_Per')!='')
                        @foreach($personal as $empleado)
                            @if($empleado->Id_Per==old('Id_Per'))
                            <td>
                                <input type="text" class="busca" id="busca_per" placeholder="obligatorio" size="35" maxlength="40" value="{{$empleado->Per_Nom.', '.$empleado->Per_Ape}}" disabled required>
                                <button id="cambiar" class="cambiar2">cambiar</button>
                                @if($errors->has('Id_Per'))<span class="help-block">{{$errors->first('Id_Per')}}</span>@endif
                            </td>
                            @endif
                        @endforeach
                    @else
                    <td>
                        <input type="text" class="busca" id="busca_per" size="35" maxlength="40" required>                        
                        <button id="cambiar">cambiar</button>
                        @if($errors->has('Id_Per'))<span class="help-block">{{$errors->first('Id_Per')}}</span>@endif
                    </td>
                    @endif
                @else
                    @foreach($personal as $empleado)
                        @if($empleado->Id_Per==$user->Id_Per)
                        <td>
                            <input type="text" class="busca" placeholder="obligatorio" id="busca_per" size="35" maxlength="40" value="{{$empleado->Per_Nom.', '.$empleado->Per_Ape}}" disabled required>
                            <button id="cambiar" class="cambiar2">cambiar</button>                            
                        </td>
                        @endif
                    @endforeach
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
                @if($errors->any())
                <input type="hidden" name="Id_Per" id="id_per" size="4" maxlength="4" value="{{old('Id_Per')}}" required>
                @else
                <input type="hidden" name="Id_Per" id="id_per" size="4" maxlength="4" value="{{$user->Id_Per}}" required>
                @endif
            </td></tr>                             

            <tr>
                <td><label for="estado">Estado:</label></td>
                <td>
                    @php
						$est_1='Activo';
						$est_2='Inactivo';
					@endphp
                    <select class="seleccion" name="Usu_Est" id="usu_est" minlength="6" maxlength="8" value="{{old('Usu_Est')}}" required>
                        @if($user->Usu_Est == $est_1)
							<option value="{{$est_1}}">{{$est_1}}</option>
							<option value="{{$est_2}}">{{$est_2}}</option>
						@elseif($user->Usu_Est == $est_2)
							<option value="{{$est_2}}">{{$est_2}}</option>
							<option value="{{$est_1}}">{{$est_1}}</option>
						@endif
                    </select>
                    @if($errors->has('Usu_Est'))<span class="help-block">{{$errors->first('Usu_Est')}}</span>@endif
                </td>
            </tr>

            <tr>
                <td class="obs"><label for="observacion">Observación:</label></td>
                <td>
                    @if($errors->any())                                    
                        <textarea name="Usu_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{old('Usu_Obs')}}</textarea>
                        @if($errors->has('Usu_Obs'))
                        <br><span class="help-block">{{$errors->first('Usu_Obs')}}</span>
                        @endif
                    @else
                        <textarea name="Usu_Obs" id="obs" cols="50" rows="4" placeholder="opcional" maxlength="140">{{$user->Usu_Obs}}</textarea>
                    @endif                
                </td>                
            </tr>
        </table>
@endsection

@section('navegacion_2')
        <div class="arriba">
            <input class="boton" type="submit" id="actualizar" value="Actualizar">
            <input class="boton" type="reset" id="limpiar" value="Limpiar">
    {!! Form::close() !!}
            <a href="{{url('/Inicio')}}"><button class="boton lista" id="cancelar">Cancelar</button></a>
        </div>

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el usuario, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right">
                {!! Form::open(['method'=>'DELETE', 'action'=>['UsuariosController@destroy', $user->Id_Usu]]) !!}
                    {{csrf_field()}}
                    <button class="botones confirmar" id="confirmar" type="submit" onclick="$('#busca_per').attr('disabled',false)">Confirmar</button>
                {!! Form::close() !!}
                </td>
                <td class="left"><button class="botones cancelar" id="c_cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>    
@endsection

<script src="{{asset('js/vistas/create_edit/user.js')}}"></script>