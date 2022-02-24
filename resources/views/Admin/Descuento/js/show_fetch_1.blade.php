<div id="este">
    @if($previous)
    <a href="{{URL::to('Descuento/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
    @endif

    @if($descuento->Desc_Est=='Desactivado')
    <a href="{{url('Descuento/'.$descuento->Id_Desc.'/activar')}}" class="modificar"><button class="boton" id="actualizar">Activar</button></a>
    @else
    <a href="{{url('Descuento/'.$descuento->Id_Desc.'/desactivar')}}" class="modificar"><button class="boton" id="actualizar">Desactivar</button></a>
    @endif

    <button class="boton eliminar" id="borrar" onclick="$('#confirm').css('display','block');">Eliminar</button>     

    @if($next)
    <a href="{{URL::to('Descuento/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
    @endif

    <a href="{{url('Descuento')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
</div>