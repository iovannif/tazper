@extends('Admin.lay.Show')

<style>
    /* Contenido */
    #contenido{        
        width:fit-content;
    }    

    .der{
        text-align:right !important;
    }
</style>

@section('titulo')
    Productos
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Productos/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif

        <a href="{{url('Productos/'.$producto->Id_Prod.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>

        <button class="boton eliminar" id="borrar" onclick="
            <?php
            // $productos=0;
            if($produccion>0 || $ped_prov>0 || $compras>0 || $ped_cli>0 || $ventas>0 || $descuentos>0){ ?>;                
				$('#rechazo').show().delay(1500).fadeOut(0);
			<?php }else{ ?>;
				$('#confirm').css('display','block');
			<?php } ?>;
		">Eliminar</button> 

        @if($next)
        <a href="{{URL::to('Productos/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Productos')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    @include('Admin.Producto.session_div.show')
    <table id="principal">
        {{--$produccion}}{{$ped_prov}}{{$compras}}{{$ped_cli}}{{$ventas}}{{$descuentos--}}
        <tr>          
            <td><label for="id_art">Id de artículo:</label></td>
            <td><input type="text" size="4" value="{{$producto->Id_Art}}" disabled></td>
        </tr>

        <tr>
            <td><label for="id_art">Id de producto:</label></td>
            <td><input type="text" size="4" value="{{$producto->Id_Prod}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_lar">Descripción larga:</label></td>
            <td><input type="text" size="35" value="{{$producto->Art_DesLar}}" disabled></td>
        </tr>

        <tr>
            <td><label for="des_cor">Descripción corta:</label></td>
            <td><input type="text" size="25" value="{{$producto->Art_DesCor}}" disabled></td>
        </tr>

        <tr>
            <td><label for="tip_prod">Tipo de producto:</label></td>
            <td><input type="text" size="8" value="{{$producto->Art_ProdTip}}" disabled></td>
        </tr>

        <tr>
            <td><label for="categoria">Categoría:</label></td>
            <td>
                @if(!$producto->Id_Cat)
                    <input type="text" size="20" disabled>
                @else
                    @foreach($categorias as $categoria)
                        @if($categoria->Id_Cat==$producto->Id_Cat)                        
                            <input type="text" size="20" value="{{$categoria->Cat_Des}}" disabled>
                            @php $no='false'; @endphp
                            @break
                        @else
                            @php $no='true'; @endphp
                        @endif
                    @endforeach

                    @if($no=='true')
                        <input type="text" size="20" disabled>
                    @endif
                @endif
            </td>
        </tr>

        <tr>
            <td><label for="impuesto">Impuesto:</label></td>
            <td>
                @foreach($impuestos as $impuesto)
                    @if($impuesto->Id_Imp==$producto->Id_Imp)
                        <input type="text" size="10" value="{{$impuesto->Imp_Des}}" disabled>
                    @endif
                @endforeach
            </td>
        </tr>
        
        <tr>
            <td><label for="gan_min">Ganancia mínima:</label></td>
            <td><input type="text" size="7" value="{{$producto->Art_GanMin}}" disabled></td>
        </tr>                                        
        
        <tr>
            <td><label for="p_comp">Precio de compra:</label></td>
            <td><input type="text" size="7" value="{{number_format($producto->Art_PreCom,0,',','.')}}" disabled></td>
        </tr>
        
        <tr>
            <td><label for="p_vent">Precio de venta:</label></td>
            <td><input type="text" size="7" value="{{number_format($producto->Art_PreVen,0,',','.')}}" disabled></td>
        </tr>

        <tr>
            <td><label for="stock">Stock:</label></td>
            <td><input type="text" size="4" value="{{$producto->Art_St}}" disabled></td>
        </tr>

        <tr>
            <td><label for="stock_min">Stock mínimo:</label></td>
            <td><input type="text" size="4" value="{{$producto->Art_StMn}}" disabled></td>
        </tr>
        
        <tr>
            <td><label for="stock_max">Stock máximo:</label></td>
            <td><input type="text" size="4" value="{{$producto->Art_StMx}}" disabled></td>
        </tr>

        <tr>
            <td><label for="proveedor">Proveedor:</label></td>
            <td>                
                @if(!$producto->Id_Prov)
                    <input type="text" size="30" disabled>
                @else
                    <input type="text" class="id" size="4" value="Id: {{$producto->Id_Prov}}" disabled>
                    @foreach($proveedores as $proveedor)
                        @if($proveedor->Id_Prov==$producto->Id_Prov)                        
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
                @endif
            </td>
        </tr>

        <tr>
            <td><label for="estado">Estado:</label></td>
            <td><input type="text" size="10" value="{{$producto->Art_Est}}" disabled></td>
        </tr>
        
        <tr>
            <td class="obs"><label for="observacion">Observación:</label></td>
            <td><textarea rows="4" cols="50" id="obs" disabled>{{$producto->Art_Obs}}</textarea></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
    @include('Admin.Producto.user')

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el producto, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right">                								
                {!! Form::open(['method'=>'DELETE', 'action'=>['ProductosController@destroy', $producto->Id_Art]]) !!}
                    {{csrf_field()}}
                    <input class="botones eliminar" type="submit" id="eliminar" value="Confirmar">
                {!! Form::close() !!}
                </td>
                <td class="left"><button class="botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>
@endsection

@section('detalle')
    <h3 id="detalle">Lista de Precios</h3>
    
    <table class="detalle">
        <tr class="head">
            <td>Categoría de Cliente</td>
            <td>Descuento</td>
            <td>Precio Original</td>
            <td>Descuento gs.</td>
            <td>Precio por Categoría</td>
            <td>Compra</td>
            <td>Ganancia</td>
        </tr>
        
	    @foreach($detalles as $detalle)
		    @if($detalle->Id_Art==$producto->Id_Art)
                @foreach($listas as $lista)
                    @if($lista->Id_Lp==$detalle->Id_Lp)
                        @php
                            switch($lista->Lp_Desc){
                                case '0%':
                                    $desc="0";
                                    break;
                                case '10%':
                                    $desc="10";
                                    break;
                                case '20%':
                                    $desc="20";
                                    break;
                            }

                            $desc_prod = $producto->Art_PreVen * $desc / 100;
                            $pre_cat = $producto->Art_PreVen - $desc_prod;
                            $gan = $pre_cat - $producto->Art_PreCom;
                        @endphp

                        <tr class="body">
                            <td><input type="text" size="10" value="{{$lista->Lp_Cat}}" disabled></td>
                            <td><input type="text" size="3" value="{{$lista->Lp_Desc}}%" disabled></td>
                            <td><input type="text" class="der" size="7" value="{{number_format($producto->Art_PreVen,0,',','.')}}" disabled></td>
                            <td><input type="text" class="der" size="7" value="{{number_format($desc_prod,0,',','.')}}" disabled></td>
                            <td><input type="text" class="der" size="7" value="{{number_format($pre_cat,0,',','.')}}" disabled></td>
                            <td><input type="text" class="der" size="7" value="{{number_format($producto->Art_PreCom,0,',','.')}}" disabled></td>
                            <td><input type="text" class="der" size="7" value="{{number_format($gan,0,',','.')}}" disabled></td>
                        </tr>
                    @endif
                @endforeach
            @endif
        @endforeach
    </table>
    <br>Descuentos de tipos mayorista y de días especiales no incluidos.
@endsection

@section('navegacion_2')
    <div class="arriba_no">        
    </div>
@endsection

<script src="{{asset('js/vistas/paginacion_show/producto.js')}}"></script>