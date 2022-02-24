@extends('Admin.lay.Index')
<!-- css -->
<link href="{{asset('css/vistas/paginado.css')}}" rel="stylesheet">
<style>    
    .operacion .botones{
        width:97%;
    }
</style>
@if($todos->count()==0)
<link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">
@elseif($cant>0 && $cant<=20)
<style>    
    #paginacion{
        left: 516px !important;
    }
</style>
@elseif($cant>20)
<style>    
    #paginacion{
        left: 420px;
    }
    #pag{
        margin-right: 16px;
    }
</style>
@endif

<!-- html -->
@section('titulo')
    Listado de Materiales
@endsection

@section('navegacion_1')
    <div id="nav">
        <a href="{{url('Materiales/create')}}" class="agregar"><button class="boton" id="agregar">Agregar</button></a>
        
        <div id="paginacion">
            <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button>
            
            @if($cant>0)
            <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
            <button class="boton trans" id="pag">Página {{$materiales->currentPage()}} de {{$lastPage}}</button>
            @endif

            @if($lastPage>1)
            <div id="pag_bot"><div class="records">
                <a href="{{url('Materiales?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
                {{$materiales->links('vendor\pagination\simple-default')}}
                <a href="{{url('Materiales?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
            </div></div>
            @endif
        </div>
    </div>

    <div id="nav2">
        <!-- buscar -->
        <button class="boton" id="buscar" disabled>Buscar</button>
        <input type="text" id="busqueda" placeholder="Descripción del material" size="35" maxlength="35" spellcheck="false" autocomplete="off" autofocus>
            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">                      
    </div>
@endsection

@section('contenido')
    @include('Admin.Material.session_div.index')
    <div id="materiales">
        <table id="principal">
            <tr class="head">
                <td>Id Art</td>
                <td>Id Mat</td>
                <td>Descripción</td>
                <td>Estado</td>
                <td>Existencia</td>
                <td>Medición</td>
                <td>Proveedor</td>
                <td id="opciones" colspan="3" style="width:174px !important;">Opciones</td>
            </tr>
            
            @if($materiales)
            @foreach($materiales as $material)
            <tr class="registro">
                <td><input type="text" id="id" size="4" value="{{$material->Id_Art}}" disabled></td>
                <td><input type="text" size="4" value="{{$material->Id_Mat}}" disabled></td>
                <td><input type="text" size="35" value="{{$material->Art_DesLar}}" disabled></td>
                <td><input type="text" size="8" value="{{$material->Art_Est}}" disabled></td>
                <td><input type="text" size="5" value="{{$material->Art_St}}" disabled></td>            
                <td><input type="text" size="20" value="{{$material->Art_UniMed}}" disabled></td>            
                <td>
                    @if($proveedores->count()>0)                        
                        @foreach($proveedores as $proveedor)
                            @if($proveedor->Id_Prov==$material->Id_Prov)
                                <input type="text" size="30" value="{{$proveedor->Prov_Des}}" disabled>
                                @php $no='false'; @endphp
                                @break
                            @else
                                @php $no='true'; @endphp
                            @endif
                        @endforeach

                        @if($no=='true')
                            <input type="text" size="30" disabled>
                        @endif
                    @else
                        <input type="text" size="30" disabled>
                    @endif                        
                </td>

                    @php
                        $foreign='';

                            //pivot art
                                            
                        foreach($produccion as $prod_det){
                            if($prod_det->Id_Art==$material->Id_Art){
                                $foreign='true';
                                break;
                            }
                        }

                        foreach($pedidos as $ped_det){
                            if($ped_det->Id_Art==$material->Id_Art){
                                $foreign='true';
                                break;
                            }
                        }

                        foreach($compras as $com_det){
                            if($com_det->Id_Art==$material->Id_Art){
                                $foreign='true';
                                break;
                            }
                        }
                    @endphp
                    <input type="hidden" id="{{$material->Id_Art}}" class="foreign" value="{{$foreign}}" disabled></td>    
                
                {{--<td class="check"><input class="check" type="checkbox" value="{{$material->Id_Art}}" id="{{$material->Id_Art}}"></td>--}}
                <td class="operacion"><a href="{{url('Materiales/'.$material->Id_Mat)}}"><button class="botones" id="ver">Ver</button></a></td>
                <td class="operacion"><a href="{{url('Materiales/'.$material->Id_Mat.'/edit')}}"><button class="botones" id="editar">Editar</button></a></td>
                <td class="operacion"><input type="submit" class="botones borrar" id="eliminar" value="Eliminar"></td>
            </tr>
            @endforeach
            @endif

                @php
                    $linea=1;
                    $relleno=20-$mostrados;
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                    <tr class="blank">
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="35" disabled></td>
                        <td><input type="text" size="8" disabled></td>
                        <td><input type="text" size="5" disabled></td>
                        <td><input type="text" size="20" disabled></td>
                        <td><input type="text" size="30" disabled></td>
                        @if($cant==0)
                        {{--<td class="operacion check"></td>--}}
                            
                            <td class="operacion"></td>
                            <td class="operacion"></td>
                            <td class="operacion"></td>
                                <style>
                                    #nav2,#pag,#most,#marcar_todos,.marcar_todos{
                                        display:none;
                                    }
                                    #paginacion{
                                        left:627px;
                                    }
                                </style>
                        @else
                        {{--<td class="check"></td>--}}
                        @endif
                    </tr>
                @endfor
        </table>

        <!-- marcados -->
        {{--<div id="marcar_todos">
            <button class="boton trans">Marcar todos:</button>

            <button class="boton trans">Página</button>
            <input id="todos" type="checkbox">
        </div>--}}
    </div>

    <!-- Fuera -->
    {{--@if($lastPage>1)
    <div class="marcar_todos">
        <button class="boton trans">Todo</button>
        <input id="todo" type="checkbox">
    </div>
    @endif
    <!-- marcador-->
    <div id="grupal">                
        <button class="boton trans">Marcados:</button>
        <button type="submit" class="boton" id="eliminar_grupo">Eliminar</button>        
        <button class="boton" id="cancelar_grupo">Cancelar</button>
    </div>--}}
    <!-- confirmar reg -->
    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el material, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right"><button class="c_botones confirmar" type="submit">Confirmar</button></td>
                <td class="left"><button class="c_botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>
    <!-- confirmar marcados -->
    <div id="confirm_grupal">
        <table>
            <tr><td class="center" id="cant" colspan="2">Está a punto de eliminar los materiales, no los podrá recuperar</td></tr>
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

<script>
    window.todos=[];    
    
    window.cantidad=<?php echo $cant; ?>;
    window.pagina_actual=<?php echo $materiales->currentPage() ?>;
    window.ultima_pagina=<?php echo $lastPage ?>;    
</script>

@foreach($todos as $item)
<script>        
    window.todos.push(<?php echo $item->Id_Art ?>);                
</script>
@endforeach

<!-- js -->
<script src="{{asset('js/vistas/paginacion_busqueda/material.js')}}"></script>
{{--<script src="{{asset('js/vistas/sesion/material.js')}}"></script>
<script src="{{asset('js/vistas/checkbox/material.js')}}"></script>--}}
<script src="{{asset('js/vistas/eliminar/material.js')}}"></script>