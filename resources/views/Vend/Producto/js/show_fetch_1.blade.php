<div id="este">
    @if($previous)
    <a href="{{URL::to('Productos/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
    @endif
    
    <a href="{{url('Productos/'.$producto->Id_Prod.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>
    
    @if($next)
    <a href="{{URL::to('Productos/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
    @endif
    
    <a href="{{url('Productos')}}" class="listado"><button class="boton lista" id="volver">Volver</button></a> 
</div>