@extends('Admin.lay.Show')

@section('titulo')
    Producción
@endsection

@section('navegacion_1')
    <div id="este">
        @if($previous)
        <a href="{{URL::to('Produccion/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
        @else
        <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
        @endif

        <button class="boton eliminar" id="eliminar">Cancelar</button>     
                        
        <button type="submit" class="boton modificar" id="actualizar" onclick="$('.finalizar').show();">Finalizar</button>                                 
        
        @if($next)
        <a href="{{URL::to('Produccion/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
        @else
        <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
        @endif

        <a href="{{url('Produccion')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
    </div>
@endsection

@section('contenido')    
    <table id="principal">
        <tr>
            <td><label for="id_pdc">Id de producción:</label></td>
            <td><input type="text" size="4" value="{{$produccion->Id_Pdc}}" disabled></td>
        </tr>

        <tr>
            <td><label for="prod">Producto:</label></td>
            <td><input type="text" size="35" value="{{$producto->Art_DesLar}}" disabled></td>
        </tr>

        <tr>
            <td><label for="conc">Concepto:</label></td>
            <td><input type="text" size="6" value="{{$produccion->Pdc_Con}}" disabled></td>
        </tr>

        @if($produccion->Pdc_Con=='Stock')
            <tr>
                <td><label for="st">Stock actual:</label></td>
                <td><input type="text" size="4" value="{{$producto->Art_St}}" disabled></td>
            </tr>        
        @endif

        <tr>
            <td><label for="cant">Cantidad:</label></td>
            <td><input type="text" size="4" value="{{$produccion->Pdc_Cant}}" disabled></td>
        </tr>        

        <tr>
            <td><label for="est">Estado:</label></td>
            <td><input type="text" size="10" value="{{$produccion->Pdc_Est}}" disabled></td>
        </tr>

        <tr>
            <td class="obs"><label for="observacion">Observación:</label></td>
            <td><textarea id="obs" cols="50" rows="4" disabled>{{$produccion->Pdc_Obs}}</textarea></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>   
    </table>
    @include('Admin.Produccion.user')

    <div id="confirm">
        <table>
            <tr><td class="center" colspan="2">Está a punto de cancelar esta producción, desea continuar?</td></tr>        
            <tr>
                <td class="right">                								
                {!! Form::open(['method'=>'DELETE', 'action'=>['ProduccionController@destroy', $produccion->Id_Pdc]]) !!}
                    {{csrf_field()}}
                    <input class="botones eliminar" type="submit" id="eliminar" value="Confirmar">
                {!! Form::close() !!}
                </td>
                <td class="left"><button class="botones cancelar" id="cancelar">Cancelar</button></td>
            </tr>
        </table>
    </div>

    <div class="finalizar">
        <table>
            <tr><td class="center" colspan="2">Usar opción solo cuando esté listo el producto</td></tr>        
            <tr><td class="center" colspan="2">Continuar?</td></tr>        
            <tr>
                <td class="right">                								
                    {!! Form::open(['method'=>'GET', 'action'=>['ProduccionController@finalizar', $produccion->Id_Pdc]]) !!}
                    <input class="botones actualizar" type="submit" value="Confirmar">
                    {!! Form::close() !!}  
                </td>
                <td class="left"><button class="botones cancelar" onclick="$('.finalizar').hide();">Cancelar</button></td>
            </tr>
        </table>
    </div>
@endsection

@section('detalle')
    <h3 id="detalle">Materiales</h3>

    <table class="detalle">                                        
        <tr class="head">
            <td>Id Art</td>
            <td>Id Mat</td>
            <td>Descripción</td>					
            <td>Cantidad</td>										
        </tr>

        @php
            $i=0;
        @endphp

        @foreach($detalles as $detalle)                        
            <tr class="body">
                @foreach($materiales as $material)                        
                @if($material->Id_Art==$det_art[$i]->Id_Art)
                <td><input type="text" size="4" value="{{$det_art[$i]->Id_Art}}" disabled></td>                                                
                <td><input type="text" size="4" value="{{$material->Id_Mat}}" disabled></td>
                <td><input type="text" size="35" value="{{$material->Art_DesLar}}" disabled></td>
                <td>
                    <input type="text" size="3" value="{{$detalle->PD_MatCant}}" disabled>
                    <input type="text" size="17" value="{{$material->Art_UniMed}}" disabled>
                </td>        
                @endif            
                @endforeach
            </tr>                     
            
            @php $i++; @endphp
        @endforeach                                                                                                    

            @php
                $linea=1;
                $relleno=8-$detalles->count();
            @endphp      

            @for($linea==1;$linea<=$relleno;$linea++)
            <tr class="body">
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="4" disabled></td>
                <td><input type="text" size="35" disabled></td>
                <td>
                    <input type="text" size="3" disabled>
                    <input type="text" size="17" disabled>
                </td>
            </tr>       
            @endfor
    </table>                
@endsection

@section('navegacion_2')
    <div class="arriba_no">        
    </div>
@endsection

<script src="{{asset('js/vistas/paginacion_show/produccion.js')}}"></script>