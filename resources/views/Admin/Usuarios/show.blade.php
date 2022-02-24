@extends('Admin.lay.Show')

<style>
    /* sin detalle */
</style>

@section('titulo')
    Usuarios
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Usuarios/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo" disabled>Anterior</button>
        @endif

        <a href="{{url('/Usuarios/'.$user->Id_Usu.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>
        <a href="#" class="eliminar"><button class="boton" id="eliminar">Eliminar</button></a>
        
        @if($next)
        <a href="{{URL::to('Usuarios/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo" disabled>Siguiente</button>
        @endif
        
        <a href="{{url('/Usuarios')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')    
    @include('Admin.Usuarios.session_div.show')
    <table id="principal">
        <tr>
            <td><label for="id_usu">Id de usuario:</label></td>
            <td><input type="text" size="4" value="{{$user->Id_Usu}}" disabled></td>
        </tr>
        
        <tr>
            <td><label for="username">Username:</label></td>
            <td><input type="text" size="20" value="{{$user->Usu_User}}" disabled></td>
        </tr>

        <tr>
            <td><label for="perfil">Perfil:</label></td>
            <td>
                @foreach($perfiles as $perfil)
                    @if($perfil->Id_Prf==$user->Id_Prf)
                        <input type="text" size="20" value="{{$perfil->Prf_Des}}" disabled>
                    @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td><label for="personal">Personal:</label></td>
            <td><input type="text" id="Id_Per" size="4" value="Id: {{$user->Id_Per}}" disabled>
                @foreach($personal as $empleado)
                    @if($empleado->Id_Per==$user->Id_Per)
                        <input type="text" size="35" value="{{$empleado->Per_Ape.', '.$empleado->Per_Nom}}" disabled>
                    @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td><label for="estado">Estado:</label></td>
            <td><input type="text" size="8" value="{{$user->Usu_Est}}" disabled></td>
        </tr>

        <tr>
            <td class="obs"><label for="observacion">Observación:</label></td>
            <td><textarea name="Usu_Obs" id="obs" cols="50" rows="4" disabled>{{$user->Usu_Obs}}</textarea></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>    
    @include('Admin.Usuarios.user')

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el usuario, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right">
                {!! Form::open(['method'=>'DELETE', 'action'=>['UsuariosController@destroy', $user->Id_Usu]]) !!}
                    {{csrf_field()}}
                    <button class="botones confirmar" id="confirmar" type="submit">Confirmar</button>
                {!! Form::close() !!}
                </td>
                <td class="left"><button class="botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection

<script src="{{asset('js/vistas/paginacion_show/user.js')}}"></script>