<div id="este">
    @if($previous)
    <a href="{{URL::to('Compras/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
    @endif

    <a href="{{URL::to('Compras/'.$compra->Id_Com.'/informe')}}" class="informe"><button class="boton" name="reporte" id="informe">Informe</button></a>        

    <!-- {!! Form::open(['method'=>'DELETE', 'action'=>['ComprasController@destroy', $compra->Id_Com]]) !!}
        {{csrf_field()}}
        <button type="submit" name="Eliminar" id="eliminar" class="boton eliminar">Eliminar</button>
    {!! Form::close() !!} -->
    <button class="boton eliminar" id="eliminar" onclick="$('#confirm').show();">Eliminar</button>   

    <button class="boton anular" onclick="$('#anular').show();">Anular</button>   

    @if($next)
    <a href="{{URL::to('Compras/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
    @endif

    <a href="{{url('Compras')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>

        <div id="confirm">
            <table>
                <tr><td class="center" colspan="2">Está a punto de eliminar la compra, no la podrá recuperar</td></tr>
                <tr><td class="center" colspan="2">Desea continuar?</td></tr>
                <tr>                    
                    <td class="right">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['ComprasController@destroy', $compra->Id_Com]]) !!}            
                        <button class="botones confirmar" type="submit">Confirmar</button>
                        {!! Form::close() !!}
                    </td>                                                                
                    <td class="left"><button class="botones cancelar" id="cancelar" onclick="$('#confirm').hide();">Cancelar</button></td>
                </tr>
            </table>
        </div>

        <div id="anular">
            <table>
                <tr><td class="center" colspan="2">La compra será anulada y eliminada</td></tr>
                <tr><td class="center" colspan="2">Desea continuar?</td></tr>
                <tr>                    
                    <td class="right">
                        {{-- {!! Form::open(['method'=>'get', 'action'=>['ComprasController@anular', $compra->Id_Com]]) !!} --}}            
                        <!-- <button class="botones confirmar" type="submit">Confirmar</button> -->
                        {{-- {!! Form::close() !!} --}}
                        <a href="{{URL::to('Compras/'.$compra->Id_Com.'/anular')}}"><button class="botones confirmar" type="submit">Confirmar</button></a>
                    </td>                                                                
                    <td class="left"><button class="botones cancelar" id="cancelar" onclick="$('#anular').hide();">Cancelar</button></td>
                </tr>
            </table>
        </div>
</div>