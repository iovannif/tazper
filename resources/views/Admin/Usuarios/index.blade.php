@extends('Admin.lay.Index')
<!-- css -->
<link href="{{asset('css/vistas/sin_paginado.css')}}" rel="stylesheet">

<!-- html -->
@section('titulo')
    Listado de Usuarios
@endsection

@section('navegacion_1')
    <div id="nav">
        <a href="{{url('/register')}}" class="agregar"><button class="boton" id="agregar">Agregar</button></a>
        <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button>
    </div>
@endsection

@section('contenido')
    @include('Admin.Usuarios.session_div.index')
    <table id="principal">
        <tr class="head">
            <td>Id</td>
            <td>Username</td>
            <td>Estado</td>
            <td>Perfil</td>
            <td>Personal</td>
            <td>Registro</td>
            <td id="opciones" colspan="4">Opciones</td>
        </tr>
        
        @foreach($users as $user)
        <tr class="registro"  class="registro">
            <td><input type="text" id="id" size="4" value="{{$user->Id_Usu}}" disabled></td>
            <td><input type="text" size="20" value="{{$user->Usu_User}}" disabled></td>
            <td><input type="text" size="8" value="{{$user->Usu_Est}}" disabled></td>
            <td>
                @foreach($perfiles as $perfil)
                    @if($perfil->Id_Prf==$user->Id_Prf)
                        <input type="text" size="20" name="perfil" value="{{$perfil->Prf_Des}}" disabled>
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($personal as $empleado)
                    @if($empleado->Id_Per==$user->Id_Per)
                        <input type="text" size="35" value="{{$empleado->Per_Ape.', '.$empleado->Per_Nom}}" disabled>
                    @endif
                @endforeach
                <input type="hidden" size="4" id="{{$user->Id_Usu}}" class="per" value="{{$user->Id_Per}}" disabled>
            </td>
            <td><input type="text" size="10" value="{{$user->created_at->format('d/m/Y')}}" disabled></td>

            {{--<td class="check"><input class="check" type="checkbox" value="{{$user->Id_Usu}}" id="{{$user->Id_Usu}}"></td>--}}
            <td class="operacion td_ver"><a href="{{url('Usuarios/'.$user->Id_Usu)}}"><button class="botones" id="ver">Ver</button></a></td>
            <td class="operacion td_editar"><a href="{{url('Usuarios/'.$user->Id_Usu.'/edit')}}"><button class="botones" id="editar">Editar</button></a></td>
            <td class="operacion td_eliminar"><button class="botones eliminar" id="eliminar">Eliminar</button></td>
        </tr>
        @endforeach
        
        <div id="grupal">
            <button class="boton trans">Marcar todos</button> <!-- Marcar Todos -->
            <input id="todos" type="checkbox">
            
            <button class="boton trans">Marcados:</button> <!-- Marcados -->
            <button type="submit" class="boton" id="eliminar_grupo">Eliminar</button>
            <button type="submit" class="boton" id="cancelar_grupo">Cancelar</button>
        </div>
    
        @php
            $linea=1;
            $relleno=20-$cant;
        @endphp

        @for($linea==1;$linea<=$relleno;$linea++)
            <tr class="blank">
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="20" disabled></td>
                <td><input type="text" size="8" disabled></td>
                <td><input type="text" size="20" disabled></td>
                <td><input type="text" size="35" disabled></td>
                <td><input type="text" size="10" disabled></td>
                @if($cant==0)
                    {{--<td class="operacion check"></td>
                    <td class="operacion td_ver"></td>--}}
                    <td class="operacion td_editar"></td>
                    <td class="operacion td_eliminar"></td>
                @else
                    {{--<td class="check"></td>--}}
                @endif
            </tr>
        @endfor
    </table>

        @php
                $id='';
            $total=$cant-1;
        @endphp

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el usuario, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right"><button class="c_botones confirmar" type="submit">Confirmar</button></td>
                <td class="left"><button class="c_botones" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>

    <div id="confirm_grupal">
        <table>
            <tr><td class="center" id="cant" colspan="2">Está a punto de eliminar los usuarios, no los podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right"><button class="c_botones g_confirmar" type="submit">Confirmar</button></td>
                <td class="left"><button class="c_botones g_cancelar" id="g_cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>
@endsection

@section('navegacion_2')
    <div class="arriba_no">
    </div>
@endsection

<!-- scripts -->
<script>
    window.registros=<?php echo $cant; ?>;
    window.total=<?php echo $total; ?>;
    window.records=<?php echo $cant; ?>;
    window.current_user=<?php echo Auth::id(); ?>;
</script>

<script src="{{asset('js/vistas/sesion/user.js')}}"></script>
<script src="{{asset('js/vistas/checkbox/user.js')}}"></script>
<script src="{{asset('js/vistas/eliminar/user.js')}}"></script>