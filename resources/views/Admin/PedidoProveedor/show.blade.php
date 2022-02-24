@extends('Admin.lay.Show')

<style>
    .detalle{
        margin-left: -28px;
    }

    .der{
        text-align:right !important;
    }

    #unimed{
        text-align:left;
        margin-left:5px;  
    }
</style>

@section('titulo')
    Pedidos a Proveedores
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('PedidoProveedor/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif

        {{--$filtro--}}                  

        @if($pedido->PedProv_Est=='Pendiente')    
        <button class="boton eliminar" id="borrar" onclick="$('#cancela').show();">Cancelar</button>    
        @else
        <button class="boton eliminar" id="eliminar">Eliminar</button>          
        @endif                                       
        
        @if($next)
        <a href="{{URL::to('PedidoProveedor/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('PedidoProveedor')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    <table id="principal">
        <tr>
            <td><label for="id_pedprov">Id de pedido:</label></td>
            <td><input type="text" size="4" value="{{$pedido->Id_PedProv}}" disabled></td>
        </tr>

        <tr>
            <td><label for="oc">Orden de compra:</label></td>
            <td><input type="text" size="4" value="{{$oc}}" disabled></td>
        </tr>

        <tr>
            <td><label for="sucursal">Sucursal:</label></td>
            <td><input type="text" size="15" value="Sucursal {{$sucursal->Id_Suc}}" disabled></td>
        </tr>

        <tr>
            <td><label for="pto_exp">Registrado en:</label></td>
            <td><input type="text" size="10" value="{{$punto->PtoExp_Des}}" disabled></td>
        </tr>        

        <tr>
            <td><label for="fe_ho">Fecha Hora:</label></td>
            <td><input type="text" size="15" value="{{date('d/m/y H:i', strtotime($pedido->PedProv_FeHo))}}" disabled></td>
        </tr>   

        <tr>
            <td><label for="proveedor">Proveedor:</label></td>
            <td><input type="text" size="30" value="{{$proveedor->Prov_Des}}" disabled></td>
        </tr>   

        <tr>
            <td><label for="fe_entrega">Fecha de entrega:</label></td>
            <td><input type="text" size="8" value="{{date('d/m/y', strtotime($pedido->PedProv_FeEnt))}}" disabled></td>
        </tr>   

        <tr>
            <td><label for="condicion">Condición de pago:</label></td>
            <td><input type="text" size="7" value="{{$pedido->PedProv_ConPag}}" disabled></td>
        </tr>   

        <tr>
            <td><label for="med_pag">Medio de pago:</label></td>
            <!-- <td><input type="text" size="8" value="{{$pedido->PedProv_MedPag}}" disabled></td> -->
            <td>
            @foreach($medios_pag as $med_pag)          
                @if($med_pag->Id_MedPag==$pedido->Id_MedPag)
                <input type="text" class="bottom" size="7" value="{{$med_pag->MedPag_Des}}" disabled>
                @endif
            @endforeach
            </td> 
        </tr>                                        

        <tr>
            <td><label for="est">Estado:</label></td>
            <td><input type="text" size="10" value="{{$pedido->PedProv_Est}}" disabled></td>
        </tr>

        @if($pedido->PedProv_Est=='Recibido' && $compra!='')
            <tr>
                <td><label for="est">Compra:</label></td>
                <td><input type="text" size="4" value="Id: {{$compra}}" disabled></td>
            </tr>
        @endif

        <tr>
            <td class="obs"><label for="observacion">Observación:</label></td>
            <td><textarea id="obs" cols="50" rows="4" disabled>{{$pedido->PedProv_Obs}}</textarea></td>
        </tr>
        
        <tr>
            <td>&nbsp;</td>
        </tr>  
    </table>
    @include('Admin.PedidoProveedor.user')

    <div id="cancela">
        <table>
            <tr><td class="center" colspan="2">Está a punto de cancelar el pedido, desea continuar?</td></tr>            
            <tr>                    
                <td class="right">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['PedidosProveedoresController@destroy', $pedido->Id_PedProv]]) !!}            
                    <input class="botones borrar" type="submit" value="Confirmar">
                    {!! Form::close() !!}
                </td>                    
                <td class="left"><button class="botones cancelar" onclick="$('#cancela').hide();">Cancelar</button></td>
            </tr>
        </table>
    </div>

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el pedido, desea continuar?</td></tr>            
            <tr>                    
                <td class="right">
                    {!! Form::open(['method'=>'DELETE', 'action'=>['PedidosProveedoresController@destroy', $pedido->Id_PedProv]]) !!}            
                    <input class="botones borrar" type="submit" value="Confirmar">
                    {!! Form::close() !!}
                </td>                                                                
                <td class="left"><button class="botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>
@endsection

@section('detalle')
    <h3 id="detalle">Detalle</h3>

    <table class="detalle">                                        
        <tr class="head">
            <td>Id Art</td>
            <td>Id Mat</td>
            <td>Id Prod</td>
            <td>Artículo</td>					
            <td>Precio</td>		
            <td>Cantidad</td>		
            <td>Importe</td>								
        </tr>

        @php
            $i=0;

            $total=0;
        @endphp

        @foreach($detalles as $detalle)                        
            <tr class="body">
                @foreach($articulos as $articulo)                        
                @if($articulo->Id_Art==$det_art[$i]->Id_Art)
                <td><input type="text" size="4" value="{{$det_art[$i]->Id_Art}}" disabled></td>                                                
                <td><input type="text" size="4" value="{{$articulo->Id_Mat}}" disabled></td>
                <td><input type="text" size="4" value="{{$articulo->Id_Prod}}" disabled></td>
                <td><input type="text" size="35" value="{{$articulo->Art_DesLar}}" disabled></td>
                <td><input type="text" class="der" size="7" value="{{$articulo->Art_PreCom}}" disabled></td>
                <td>
                    <input type="text" class="der" size="3" value="{{$detalle->PPD_ArtCant}}" disabled>
                    <input type="text" id="unimed" size="16" value="{{$articulo->Art_UniMed}}" disabled>
                </td>    
                <td><input type="text" class="der" size="7" value="{{$importe=$detalle->PPD_ArtCant*$articulo->Art_PreCom}}" disabled></td>    
                @endif            
                @endforeach
            </tr>                     
            
            @php                 
                $i++;

                $total+=$importe;
            @endphp
        @endforeach                                                                                                    

            @php
                $linea=1;
                $relleno=8-$detalles->count();
            @endphp      

            @for($linea==1;$linea<=$relleno;$linea++)
            <tr class="body">
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="35" disabled></td>
                <td><input type="text" size="7" disabled></td>   
                <td>
                    <input type="text" size="3" disabled>
                    <input type="text" size="17" disabled>
                </td>
                <td><input type="text" size="7" disabled></td>    
            </tr>       
            @endfor

        <tr class="blank">
            <td colspan="5"></td>
            <td colspan="2">Total: <input type="text" id="total" size="7" value="{{$total}}" style="text-align:right !important" disabled> Gs.</td>				
        </tr>	
    </table>                
@endsection

@section('navegacion_2')
    <div class="arriba_no">        
    </div>
@endsection

<script src="{{asset('js/vistas/paginacion_show/pedido_proveedor.js')}}"></script>