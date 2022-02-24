<div id="este">
    @if($previous)
    <a href="{{URL::to('Produccion/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
    @endif

    <button class="boton eliminar" id="eliminar" onclick="$('#confirm').show();">Cancelar</button>     
            
    <button type="submit" class="boton modificar" id="actualizar" onclick="$('.finalizar').show();">Finalizar</button>                     
    
    @if($next)
    <a href="{{URL::to('Produccion/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
    @endif

    <a href="{{url('Produccion')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
</div>