@extends('Admin.lay.Show')

<style>
    /* sin detalle */    
</style>

@section('titulo')
    Proveedores
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Proveedores/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo" disabled>Anterior</button>
        @endif
        
        <a href="{{url('Proveedores/'.$proveedor->Id_Prov.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>
        
        <input class="boton eliminar" type="submit" id="borrar" value="Eliminar" onclick="
            if($('.foreign').val()!=''){
				$('#rechazo').show().delay(1500).fadeOut(0);
			}else{
				$('#confirm').css('display','block');
			}
        ">        
        
        @if($next)
        <a href="{{URL::to('Proveedores/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Proveedores')}}" class="volver"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')
    @include('Admin.Proveedores.session_div.show')
    <table id="principal">
        <tr>
            <td><label for="codigo">Id de provedor:</label></td>
            <td><input type="text" size="4" value="{{$proveedor->Id_Prov}}" disabled></td>
        </tr>
    
        <tr>
            <td><label for="descripcion">Descripción:</label></td>
            <td><input type="text" size="30" value="{{$proveedor->Prov_Des}}" disabled></td>
        </tr>

        <tr>
            <td><label for="raz_soc">Razón social:</label></td>
            <td><input type="text" size="40" value="{{$proveedor->Prov_RazSoc}}" disabled></td>
        </tr>

        <tr>
            <td><label for="ruc">RUC:</label></td>
            <td><input type="text" size="20" value="{{$proveedor->Prov_Ruc}}" disabled></td>
        </tr>
        
        <tr>
            <td><label for="telefono">Teléfono:</label></td>
            <td><input type="text" size="15" value="{{$proveedor->Prov_Tel}}" disabled></td>
        </tr>
        
        <tr>
            <td><label for="celular">Celular:</label></td>
            <td><input type="text" size="15" value="{{$proveedor->Prov_Cel}}" disabled></td>
        </tr>

        <tr>
            <td><label for="email">E-mail:</label></td>
            <td><input type="text" size="30" value="{{$proveedor->Prov_Email}}" disabled></td>
        </tr>

        <tr>
            <td><label for="web">Sitio web:</label></td>
            <td><input type="text" size="45" value="{{$proveedor->Prov_Web}}" disabled></td>
        </tr>

        <tr>
            <td><label for="direccion">Dirección:</label></td>
            <td><input type="text" size="50" value="{{$proveedor->Prov_Dir}}" disabled></td>
        </tr>

        <tr>
            <td><label for="ciudad">Ciudad:</label></td>
            <td><input type="text" size="30" value="{{$proveedor->Prov_Ciu}}" disabled></td>
        </tr>

        <tr>
            <td><label for="barrio">Barrio:</label></td>
            <td><input type="text" size="30" value="{{$proveedor->Prov_Bar}}" disabled></td>
        </tr>

        <tr>
            <td><label for="horario">Horario:</label></td>
            <td><input type="text" size="60" value="{{$proveedor->Prov_Ho}}" disabled></td>
        </tr>

        <tr>
            <td><label for="estado">Estado:</label></td>
            <td>
                <input type="text" size="8" value="{{$proveedor->Prov_Est}}" disabled>
            </td>
        </tr>
        
        <tr>
            <td class="obs"><label for="observacion">Observación:</label></td>
            <td><textarea cols="50" rows="4" id="obs" disabled>{{$proveedor->Prov_Obs}}</textarea></td>
        </tr>            

        <tr>
            <td>&nbsp;
            @php
                $foreign='';
            
                {{--
                foreach($articulos as $art){
                    if($art->Id_Prov==$proveedor->Id_Prov){
                        $articulo='true';
                        break;
                    }
                }

                foreach($pedidos as $ped){
                    if($ped->Id_Prov==$proveedor->Id_Prov){
                        $pedido='true';
                        break;
                    }
                }

                foreach($compras as $com){
                    if($com->Id_Prov==$proveedor->Id_Prov){
                        $compra='true';
                        break;
                    }
                }
                --}}

                if($articulos>0 || $compras>0 || $pedidos>0){
                    $foreign='true';
                }
            @endphp
            <input type="hidden" class="foreign" value="{{$foreign}}" disabled></td>
        </tr>        
    </table>
    @include('Admin.Proveedores.user')

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de eliminar el proveedor, no lo podrá recuperar</td></tr>
            <tr><td class="center" colspan="2">Desea continuar?</td></tr>
            <tr>
                <td class="right">                				
                {!! Form::open(['method'=>'DELETE', 'action'=>['ProveedoresController@destroy', $proveedor->Id_Prov]]) !!}
                    {{csrf_field()}}
                    <input class="botones confirmar" type="submit" id="confirmar" value="Confirmar">
                {!! Form::close() !!}
                </td>
                <td class="left"><button class="botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>
@endsection

@section('navegacion_2')
    <div class="arriba">
        <a href="#"><button class="boton lista" id="arriba">Volver arriba</button></a>
    </div>
@endsection

<script src="{{asset('js/vistas/paginacion_show/proveedor.js')}}"></script>