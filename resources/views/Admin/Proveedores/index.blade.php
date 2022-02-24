@extends('Admin.lay.Index')
<!-- css -->
<link href="{{asset('css/vistas/paginado.css')}}" rel="stylesheet">
<style>    
    #paginacion{
        left: 519px;
    }
</style>
@if($cant==0)
<link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">
<style>
    #paginacion{
        left: 46.5%;
    }
</style>
@endif
@if($cant>20)
<style>
    /* Navegacion */
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
    Listado de Proveedores
@endsection

@section('navegacion_1')
    <div id="nav">
        <a href="{{url('Proveedores/create')}}" class="agregar"><button class="boton" id="agregar">Agregar</button></a>
        
        <div id="paginacion">
            <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button>            

            @if($cant>0)
            <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
            <button class="boton trans" id="pag">Página {{$proveedores->currentPage()}} de {{$lastPage}}</button>
            @endif

            @if($lastPage>1)
            <div id="pag_bot"><div class="records">                
                <a href="{{url('Proveedores?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>                
                {{$proveedores->links('vendor\pagination\simple-default')}}
                <a href="{{url('Proveedores?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
            </div></div>
            @endif
        </div>
    </div>

    <div id="nav2">
        <button class="boton" id="buscar" disabled>Buscar</button>
        <input type="text" id="busqueda" placeholder="Datos del proveedor" size="30" maxlength="30" spellcheck="false" autocomplete="off" autofocus>
    </div>
@endsection

@section('contenido')
    @include('Admin.Proveedores.session_div.index')
    <div id="proveedores">
        <table id="principal">
            <tr class="head">
                <td>Id</td>
                <td>Descripción</td>            
                <td>Estado</td>
                <td>Teléfono</td>
                <td>Dirección</td>
                <td id="opciones" colspan="4">Opciones</td>
            </tr>
            
            @if($proveedores)
            @foreach($proveedores as $proveedor)
            <tr class="registro">
                <td><input type="text" id="id" size="4" value="{{$proveedor->Id_Prov}}" disabled></td>
                <td><input type="text" size="30" value="{{$proveedor->Prov_Des}}" disabled></td>
                <td><input type="text" size="8" value="{{$proveedor->Prov_Est}}" disabled></td>
                <td><input type="text" size="15" value="{{$proveedor->Prov_Tel}}" disabled></td>
                <td><input type="text" size="45" value="{{$proveedor->Prov_Dir}}" disabled>                                
                    
                    @php
                        $foreign='';
                                            
                        foreach($articulos as $articulo){
                            if($articulo->Id_Prov==$proveedor->Id_Prov){
                                $foreign='true';
                                break;
                            }
                        }

                        foreach($pedidos as $pedido){
                            if($pedido->Id_Prov==$proveedor->Id_Prov){
                                $foreign='true';
                                break;
                            }
                        }

                        foreach($compras as $compra){
                            if($compra->Id_Prov==$proveedor->Id_Prov){
                                $foreign='true';
                                break;
                            }
                        }
                    @endphp
                    <input type="hidden" id="{{$proveedor->Id_Prov}}" class="foreign" value="{{$foreign}}" disabled></td>    

                {{--<td class="check"><input class="check" type="checkbox" value="{{$proveedor->Id_Prov}}" id="{{$proveedor->Id_Prov}}"></td>--}}
                <td class="operacion td_ver"><a href="{{url('Proveedores/'.$proveedor->Id_Prov)}}"><button class="botones" id="ver">Ver</button></a></td>
                <td class="operacion td_editar"><a href="{{url('Proveedores/'.$proveedor->Id_Prov.'/edit')}}"><button class="botones" id="editar">Editar</button></a></td>
                <td class="operacion td_eliminar"><input type="submit" class="botones borrar" id="eliminar" value="Eliminar"></td>
            </tr>
            @endforeach
            @endif

                @php
                    $linea=1;
                    $relleno=20-$proveedores->count();
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                    <tr class="blank">
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="30" disabled></td>
                        <td><input type="text" size="8" disabled></td>
                        <td><input type="text" size="15" disabled></td>
                        <td><input type="text" size="45" disabled></td>
                        @if($cant==0)
                        {{--<td class="operacion check"></td>--}}
                        
                        <td class="operacion td_ver"></td>
                        <td class="operacion td_editar"></td>
                        <td class="operacion td_eliminar"></td>
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
        {{--
        <div id="marcar_todos">
            <button class="boton trans">Marcar todos:</button>

            <button class="boton trans">Página</button>
            <input id="todos" type="checkbox">
        </div>            
        --}}
    </div>             
    <!-- Fuera -->
        
    {{--
    @if($lastPage>1)
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
            <tr><td class="center" colspan="2">Está a punto de eliminar el proveedor, no lo podrá recuperar</td></tr>
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
            <tr><td class="center" id="cant" colspan="2">Está a punto de eliminar los proveedores, no los podrá recuperar</td></tr>
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

<!-- js -->
<script>
    window.todos=[];    
    
    window.cantidad=<?php echo $cant; ?>;
    window.pagina_actual=<?php echo $proveedores->currentPage() ?>;
    window.ultima_pagina=<?php echo $lastPage ?>;                         
</script>

@foreach($todos as $item)
    <script>        
        window.todos.push(<?php echo $item->Id_Prov ?>);                
    </script>
@endforeach

<script src="{{asset('js/vistas/paginacion_busqueda/proveedor.js')}}"></script>
<!-- <script src="{{asset('js/vistas/sesion/proveedor.js')}}"></script>
<script src="{{asset('js/vistas/checkbox/proveedor.js')}}"></script> -->
<script src="{{asset('js/vistas/eliminar/proveedor.js')}}"></script>