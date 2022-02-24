@extends('Admin.lay.Index')
<!-- css -->
<link href="{{asset('css/vistas/sin_paginado.css')}}" rel="stylesheet">

<!-- html -->
@section('titulo')
    Listado del Personal
@endsection

@section('navegacion_1')
    <div id="nav">
        <a href="{{url('Personal/create')}}" class="agregar"><button class="boton" id="agregar">Agregar</button></a>        
        <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button>
    </div>
@endsection    

@section('contenido')
    @include('Admin.Personal.session_div.index')
    <div id="personal">
        <table id="principal">
            <tr class="head">
                <td>Id</td>
                <td>Apellidos, Nombres</td>            
                <td>Estado</td>
                <td>Cargo</td>
                <td>Username</td>
                <td>Registro</td>
                <td id="opciones" colspan="4">Opciones</td>
            </tr>            
            
            @if($personal)
            @foreach($personal as $empleado)
            <tr class="registro">
                <td><input type="text" class="id" size="4" value="{{$empleado->Id_Per}}" disabled></td>
                <td><input type="text" size="35" value="{{$empleado->Per_Ape.', '.$empleado->Per_Nom}}" disabled></td>
                <td><input type="text" size="8" value="{{$empleado->Per_Est}}" disabled></td>
                <td><input type="text" size="20" value="{{$empleado->Per_Car}}" disabled></td>
                <td>                
                    @foreach($users as $user)
                        @if($user->Id_Usu==$empleado->Id_Usu)
                            <input type="text" class="user" size="20" value="{{$user->Usu_User}}" disabled>
                            <input type="hidden" class="usu" id="{{$empleado->Id_Per}}" size="20" value="{{$user->Id_Usu}}" disabled>
                            @php $no='false'; @endphp
                            @break
                        @else
                            @php $no='true'; @endphp
                        @endif
                    @endforeach

                    @if($no=='true')
                        <input type="text" class="user" size="20" disabled>
                        <input type="hidden" class="usu" id="{{$empleado->Id_Per}}" size="20" disabled>
                    @endif            
                </td>
                <td><input type="text" size="10" value="{{$empleado->created_at->format('d/m/Y')}}" disabled></td>

                {{--<td class="check"><input class="check" type="checkbox" value="{{$empleado->Id_Per}}" id="{{$empleado->Id_Per}}"></td>--}}
                <td class="operacion td_ver"><a href="{{url('/Personal/'.$empleado->Id_Per)}}"><button class="botones" id="ver">Ver</button></a></td>
                <td class="operacion td_editar"><a href="{{url('/Personal/'.$empleado->Id_Per).'/edit'}}"><button class="botones" id="editar">Editar</button></a></td>
                <td class="operacion td_eliminar"><input type="submit" class="botones borrar" id="eliminar" value="Eliminar"></td>
            </tr>
            @endforeach
            @endif            

            <div id="grupal">
                <button class="boton trans">Marcar todos</button> <!-- Marcar Todos -->
                <input id="todos" type="checkbox">
                
                <button class="boton trans">Marcados:</button> <!-- Marcados -->
                <button type="submit" class="boton" id="eliminar_grupo">Eliminar</button>
                <button type="submit" class="boton" id="cancelar_grupo">Cancelar</button>
            </div>

                @php
                    $linea=1;
                    $relleno=20-$personal->count();
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                    <tr class="blank">
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="35" disabled></td>
                        <td><input type="text" size="8" disabled></td>
                        <td><input type="text" size="20" disabled></td>
                        <td><input type="text" size="20" disabled></td>
                        <td><input type="text" size="10" disabled></td>
                        @if($cant==0)
                            {{--<td class="operacion check"></td>--}}
                            <td class="operacion td_ver"></td>
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
    </div>

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el personal, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>                
                <td class="right"><button class="c_botones confirmar" type="submit">Confirmar</button></td>                
                <td class="left"><button class="c_botones" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>

    <div id="confirm_grupal">
        <table>
            <tr><td class="center" id="cant" colspan="2">Está a punto de eliminar los empleados, no los podrá recuperar</td></tr>
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
    window.users=[]; //fk
</script>

@foreach($users as $user)
    @if($user->Id_Per!='')
    <script>
        window.users.push(<?php echo $user->Id_Per ?>);        
    </script>
    @endif
@endforeach

<!-- <script src="{{asset('js/vistas/sesion/personal.js')}}"></script>
<script src="{{asset('js/vistas/checkbox/personal.js')}}"></script> -->
<script src="{{asset('js/vistas/eliminar/personal.js')}}"></script>