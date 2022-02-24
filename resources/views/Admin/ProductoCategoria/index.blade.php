@extends('Admin.lay.Index')
<!-- css -->
<link href="{{asset('css/vistas/paginado.css')}}" rel="stylesheet">
<link href="{{asset('css/vistas/agregar_categoria.css')}}" rel="stylesheet">
@if($cant==0)
<link href="{{asset('css/vistas/todos_index.css')}}" rel="stylesheet">
<style> /* por tener create ajax en index */
    #paginacion{
        left: 627px !important;
    }
</style>
@elseif($cant>0 && $cant<=20)
<style>    
    #paginacion{
        left: 516px !important;
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
    Listado de Categorías
@endsection

@section('navegacion_1')
    <div id="nav">
        <button class="boton agregar" id="agregar">Agregar</button> <!-- agregar -->        
        
        <div id="paginacion">
            <button class="boton trans" id="total_reg">Total: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($cant, 2, " ", STR_PAD_LEFT))}}</button> <!-- total -->            
            
            @if($cant>0)
            <button class="boton trans" id="most">Mostrados: {{str_replace(" ", "&nbsp;&nbsp;", str_pad($mostrados, 2, " ", STR_PAD_LEFT))}}</button> <!-- mostrados -->
            <button class="boton trans" id="pag">Página {{$categorias->currentPage()}} de {{$lastPage}}</button> <!-- pagina -->
            @endif

            @if($lastPage>1)
            <div id="pag_bot"><div class="records">
                <a href="{{url('Productos_Categoria?page=1')}}" class="inicio"><button class="boton" id="inicio">Inicio</button></a> <!-- primera -->
                {{$categorias->links('vendor\pagination\simple-default')}} <!-- anterior siguiente -->
                <a href="{{url('Productos_Categoria?page='.$lastPage)}}" class="fin"><button class="boton" id="fin">Fin</button></a> <!-- utima -->
            </div></div>       
            @endif
        </div>
    </div>

    <div id="nav2">
        <a href="#"><button class="boton" id="buscar" disabled>Buscar</button></a>
        <input type="text" id="busqueda" placeholder="Descripción de la categoría" size="25" maxlength="20" spellcheck="false" autocomplete="off" autofocus>
            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
    </div>
@endsection

@section('contenido')
    @include('Admin.ProductoCategoria.session_div.index')
    <div id="categorias">        
        <table id="principal">
            <tr class="head">
                <td>Id</td>
                <td>Descripción</td>
                <td>Estado</td>
                <td>Registro</td>
                <td>Productos</td>
                <td id="opciones" colspan="4">Opciones</td>
            </tr>
            
            @foreach($categorias as $categoria)
            <tr class="registro">
                <td><input type="text" id="id" size="4" value="{{$categoria->Id_Cat}}" disabled></td>
                <td><input type="text" size="20" value="{{$categoria->Cat_Des}}" disabled></td>
                <td><input type="text" size="8" value="{{$categoria->Cat_Est}}" disabled></td>
                <td><input type="text" size="8" value="{{$categoria->created_at->format('d/m/y')}}" disabled></td>
                <td>                    
                    @php
                        $contador=0;
                        
                        foreach($productos as $producto){
                            if($producto->Id_Cat==$categoria->Id_Cat){
                                $contador++;
                            }
                        }
                    @endphp
                    <input type="text" class="prod" size="3" value="{{$contador}}" disabled>
                </td>
                
                {{--<td class="check"><input class="check" type="checkbox" value="{{$categoria->Id_Cat}}" id="{{$categoria->Id_Cat}}">--}}
                <td class="operacion td_ver"><a href="{{url('Productos_Categoria/'.$categoria->Id_Cat)}}"><button class="botones" id="ver">Ver</button></a></td>
                <td class="operacion td_editar"><a href="{{url('Productos_Categoria/'.$categoria->Id_Cat.'/edit')}}"><button class="botones" id="editar">Editar</button></a></td>
                <td class="operacion td_eliminar"><input type="submit" class="botones borrar" id="eliminar" value="Eliminar"></td>
            </tr>
            @endforeach

                @php
                    $linea=1;
                    $relleno=20-$mostrados;
                @endphp

                @for($linea==1;$linea<=$relleno;$linea++)
                    <tr class="blank">
                        <td><input type="text" size="4" disabled></td>
                        <td><input type="text" size="20" disabled></td>
                        <td><input type="text" size="8" disabled></td>
                        <td><input type="text" size="8" disabled></td>
                        <td><input type="text" size="3" disabled></td>
                        @if($cant==0)
                        {{--<td class="operacion check"></td>--}}
                        <td class="operacion td_ver"></td>
                        <td class="operacion td_editar"></td>
                        <td class="operacion td_eliminar"></td>
                            <style>
                                #nav2,#pag,#most,#marcar_todos,.marcar_todos{
                                    display:none;
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
    {{--@if($lastPage>1)
    <div class="marcar_todos">
        <button class="boton trans">Todo</button>
        <input id="todo" type="checkbox">
    </div>
    @endif--}}
    <!-- marcador-->
    <div id="grupal">                
        <button class="boton trans">Marcados:</button>
        <button type="submit" class="boton" id="eliminar_grupo">Eliminar</button>        
        <button class="boton" id="cancelar_grupo">Cancelar</button>
    </div>
    <!-- confirmar reg -->
    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar la categoría, no la podrá recuperar</td></tr>
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
            <tr><td class="center" id="cant" colspan="2">Está a punto de eliminar las categorías, no las podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right"><button class="c_botones g_confirmar" type="submit">Confirmar</button></td>
                <td class="left"><button class="c_botones g_cancelar" id="g_cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>

    <!-- create -->
    <div id="create"> 
        <table>            
            <tr><td class="center titulo" colspan="2">Agregar Categoría</td></tr>
            <tr>
				<td class="center" colspan="2">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" name="ProdCat_Des" id="descripcion" placeholder="obligatorio" size="20" maxlength="20" required spellcheck="false" autocomplete="off">
                    @if($errors->has('Cat_Des'))<span class="help-block">{{$errors->first('Cat_Des')}}</span>@endif
                </td>
            </tr>
            <tr>
                <td class="center" colspan="2" id="error">
                    <label for="masiva">Inserción masiva</label>
                    <input type="checkbox" id="masiva">
                </td>
            </tr>
            <tr>
                <td class="center" colspan="2" id="error">
                    <span class="help-block">&nbsp;</span>
                </td>
            </tr>
            <tr>
                <td class="right"><button class="c_botones" type="submit" id="create_submit">Registrar</button></td>
                <td class="left"><button class="c_botones" id="cancelar_c">Cancelar</button></td>
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
    window.addEventListener("load", function(){
        window.token=$("input[name=_token]").val();
        window.cant=<?php echo $cant; ?>;        
        
        if(window.cant%20==0 && window.cant!=0){
            window.ult_pag=<?php echo $lastPage+1; ?>;
        }else{
            window.ult_pag=<?php echo $lastPage; ?>;
        }
    });
</script>

<script>
    window.todos=[];    
    
    window.cantidad=<?php echo $cant; ?>;
    window.pagina_actual=<?php echo $categorias->currentPage() ?>;
    window.ultima_pagina=<?php echo $lastPage ?>;    
</script>
        
@foreach($todos as $item)
<script>        
    window.todos.push(<?php echo $item->Id_Cat ?>);                
</script>
@endforeach

<script src="{{asset('js/vistas/paginacion_busqueda/categoria.js')}}"></script>
<script src="{{asset('js/vistas/agregar_categoria.js')}}"></script>
<script src="{{asset('js/vistas/sesion/categoria.js')}}"></script>
<script src="{{asset('js/vistas/checkbox/categoria.js')}}"></script>
<script src="{{asset('js/vistas/eliminar/categoria.js')}}"></script>