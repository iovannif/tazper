@extends('Vend.lay.Index')
<!-- css -->
<link href="{{asset('css/vistas/paginado.css')}}" rel="stylesheet">
<link href="{{asset('css/vistas/modif_masiva.css')}}" rel="stylesheet">
@if($todos->count()==0)
<link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">
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
<style>
    #filtros{
        margin-top:4px !important;
    }
    .filtro{
    margin: 7px 0 1px 0 !important;
    font-family:Arial;
    }

    .operacion .botones{
        width:97%;
    }
</style>

<!-- html -->
@section('titulo')
    Listado de Productos
@endsection

@section('navegacion_1')
    <div id="nav">
        <a href="{{url('Productos/create')}}" class="agregar"><button class="boton" id="agregar">Agregar</button></a> <!-- agregar -->
        
        <div id="paginacion">
            <!-- total registros -->
            <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 3, " ", STR_PAD_LEFT))}}</button>
            
            @if($cant>0)
            <!-- mostrados -->
            <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button>
            <!-- pagina -->
            <button class="boton trans" id="pag">Página {{str_replace(" ", "&nbsp;&nbsp;", str_pad($productos->currentPage(), 2, " ", STR_PAD_LEFT))}} de {{str_replace(" ", "&nbsp;&nbsp;", str_pad($lastPage, 2, " ", STR_PAD_LEFT))}}</button>
            @endif

            <!-- paginacion -->
            @if($lastPage>1)
            <div id="pag_bot"><div class="records">
                <!-- inicio -->
                <a href="{{url('Productos?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a>
                <!-- anterior siguiente -->
                {{$productos->links('vendor\pagination\simple-default')}}
                <!-- fin -->
                <a href="{{url('Productos?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a>
            </div></div>
            @endif
        </div>
    </div>
    
    <div id="nav2">
        <!-- buscar -->
        <button class="boton" id="buscar" disabled>Buscar</button>
        <input type="text" id="busqueda" placeholder="Descripción del producto" size="35" maxlength="35" spellcheck="false" autocomplete="off" autofocus>
            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
        
        <!-- activar filtros -->
        <button class="boton" id="filtros">Filtros</button> <!-- botones -->
        <button class="boton" id="cancelar_filtro">cancelar</button>                
    </div>

    <div id="nav3">
        <!-- filtros -->
        <input type="text" class="filtro filtro_uno" id="filtro_idArt" placeholder="Id Art" size="4" maxlength="4" spellcheck="false" autocomplete="off">
        <input type="text" class="filtro" id="filtro_idProd" placeholder="Id Pro" size="4" maxlength="4" spellcheck="false" autocomplete="off">
        <input type="text" class="filtro" id="filtro_Cat" placeholder="Categoría" size="20" maxlength="20" spellcheck="false" autocomplete="off">
        <input type="text" class="filtro" id="filtro_Est" placeholder="Estado" size="8" maxlength="8" spellcheck="false" autocomplete="off">
        <input type="text" class="filtro" id="filtro_Pre" placeholder="Precio" size="7" maxlength="7" spellcheck="false" autocomplete="off">
        <input type="text" class="filtro" id="filtro_Imp" placeholder="Impuesto" size="10" maxlength="10" spellcheck="false" autocomplete="off">
            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
    </div>
@endsection

@section('contenido')
    @include('Vend.Producto.session_div.index')
    <div id="productos">
        <!-- registros -->
        <table id="principal">
            <tr class="head">
                <td>Id Art</td>
                <td>Id Prod</td>
                <td>Descripción</td>
                <td>Categoría</td>
                <td>Estado</td>
                <td>Stock</td>
                <td>Compra</td>
                <td>Venta</td>
                <td>Impuesto</td>
                <td id="opciones" colspan="3" style="width:178px !important;">Opciones</td>
                {{--4--}}
            </tr>
            
            @if($productos)            
            @foreach($productos as $producto)
            <tr class="registro">
                <td><input type="text" id="id" size="4" value="{{$producto->Id_Art}}" disabled></td>
                <td><input type="text" size="4" value="{{$producto->Id_Prod}}" disabled></td>
                <td><input type="text" size="35" value="{{$producto->Art_DesLar}}" disabled></td>
                <td>
                    @if($categorias->count()>0)                        
                        @foreach($categorias as $categoria)
                            @if($categoria->Id_Cat==$producto->Id_Cat)
                                <input type="text" size="20" value="{{$categoria->Cat_Des}}" disabled>
                                @php $no='false'; @endphp
                                @break
                            @else
                                @php $no='true'; @endphp
                            @endif
                        @endforeach
                        <!-- si no tiene categoria -->
                        @if($no=='true')
                            <input type="text" size="20" disabled>
                        @endif
                    @else
                        <input type="text" size="20" disabled>
                    @endif                        
                </td>
                <td><input type="text" size="8" value="{{$producto->Art_Est}}" disabled></td>
                <td><input type="text" size="4" value="{{$producto->Art_St}}" disabled></td>
                <td><input type="text" size="7" value="{{number_format($producto->Art_PreCom,0,',','.')}}" disabled></td>
                <td><input type="text" size="7" value="{{number_format($producto->Art_PreVen,0,',','.')}}" disabled></td>
                <td>
                    @foreach($impuestos as $impuesto)
                        @if($impuesto->Id_Imp==$producto->Id_Imp)
                            <input type="text" size="10" value="{{$impuesto->Imp_Des}}" disabled>
                        @endif
                    @endforeach
                </td>

                    @php
                        $foreign='';                         
                                            
                        foreach($produccion as $pdc){
                            if($pdc->Id_Prod==$producto->Id_Art){
                                $foreign='true';
                                break;
                            }
                        }                        
                        foreach($ped_prov as $pedprov_det){
                            if($pedprov_det->Id_Art==$producto->Id_Art){
                                $foreign='true';
                                break;
                            }
                        }                        
                        foreach($compras as $com_det){
                            if($com_det->Id_Art==$producto->Id_Art){
                                $foreign='true';
                                break;
                            }
                        }                        
                        foreach($ped_cli as $pedcli_det){
                            if($pedcli_det->Id_Art==$producto->Id_Art){
                                $foreign='true';
                                break;
                            }
                        }                        
                        foreach($ventas as $ven_det){
                            if($ven_det->Id_Art==$producto->Id_Art){
                                $foreign='true';
                                break;
                            }
                        }                        
                        {{--foreach($descuentos as $desc_det){
                            if($desc_det->Id_Art==$producto->Id_Art){
                                $foreign='true';
                                break;
                            }
                        }--}}                        
                    @endphp
                    <input type="hidden" id="{{$producto->Id_Art}}" class="foreign" value="{{$foreign}}" disabled></td>       

                <!-- opciones -->
                {{--<td class="check"><input class="check" type="checkbox" value="{{$producto->Id_Art}}" id="{{$producto->Id_Art}}"></td>--}}
                <td class="operacion"><a href="Productos/{{$producto->Id_Prod}}"><button class="botones" id="ver">Ver</button></a></td>
                <td class="operacion"><a href="Productos/{{$producto->Id_Prod}}/edit"><button class="botones" id="editar">Editar</button></a></td>
                <td class="operacion">{{--<input type="submit" class="botones borrar" id="eliminar" value="Eliminar">--}}</td>
            </tr>
            @endforeach
            @endif            

                <!-- relleno -->
                @php
                    $linea=1;
                    $relleno=20-$mostrados;
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                    <tr class="blank">
                        <td><input type="text" size="4" value="" disabled></td>
                        <td><input type="text" size="4" value="" disabled></td>
                        <td><input type="text" size="35" value="" disabled></td>
                        <td><input type="text" size="20" value="" disabled></td>
                        <td><input type="text" size="8" value="" disabled></td>
                        <td><input type="text" size="4" value="" disabled></td>
                        <td><input type="text" size="7" value="" disabled></td>
                        <td><input type="text" size="7" value="" disabled></td>
                        <td><input type="text" size="10" value="" disabled></td>
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
    {{--<div class="marcar_todos">
        <button class="boton trans">Todo</button>
        <input id="todo" type="checkbox">
    </div>--}}
    <!-- marcador-->
    <div id="grupal">                
        <button class="boton trans">Marcados:</button>
        <button type="submit" class="boton" id="eliminar_grupo">Eliminar</button>
        <button class="boton" id="mdf_grupo">Modificar</button>
        <button class="boton" id="cancelar_grupo">Cancelar</button>
    </div>
    <!-- confirmar reg -->
    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el producto, no lo podrá recuperar</td></tr>
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
            <tr><td class="center" id="cant" colspan="2">Está a punto de eliminar los productos, no los podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right"><button class="c_botones g_confirmar" type="submit">Confirmar</button></td>
                <td class="left"><button class="c_botones g_cancelar" id="g_cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>

    <div id="mdf">
        <table>            
            <tr><td class="center titulo" colspan="3">Cambiar precio</td></tr>
            <tr>
                <td class="center"><label for="aumentar">Aumentar</label></td>
                <td class="center"><label for="disminuir">Disminuir</label></td>
                <td class="center"><label for="establecer_pre">Establecer</label></td>
            </tr>
            <tr>
                <td class="center"><input type="number" step="500" min="500" max="1000000" id="aumentar" size="7" maxlength="7"></td>
                <td class="center"><input type="number" step="500" min="500" max="1000000" id="disminuir" size="7" maxlength="7"></td>
                <td class="center"><input type="number" step="500" min="500" max="1000000" id="establecer_pre" size="7" maxlength="7"></td>
            </tr>
            <tr>
                <td class="right"><button class="c_botones" type="submit" id="mdf_submit">Actualizar</button></td>
                <td class="error"></td>
                <td class="left"><button class="c_botones" id="cancelar_mdf">Cancelar</button></td>
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
    window.todos=[]; //check

    window.cantidad=<?php echo $cant; ?>;
    window.pagina_actual=<?php echo $productos->currentPage() ?>;
    window.ultima_pagina=<?php echo $lastPage ?>;
</script>

@foreach($todos as $item)
    <script>        
        window.todos.push(<?php echo $item->Id_Art ?>);        
    </script>
@endforeach

<script src="{{asset('js/vistas/paginacion_busqueda/producto.js')}}"></script>
<script src="{{asset('js/vistas/sesion/producto.js')}}"></script>
<script src="{{asset('js/vistas/checkbox/producto.js')}}"></script>
<script src="{{asset('js/vistas/eliminar/producto.js')}}"></script>
<script src="{{asset('js/vistas/filtro/producto.js')}}"></script>
<script src="{{asset('js/vistas/modif_masiva.js')}}"></script>