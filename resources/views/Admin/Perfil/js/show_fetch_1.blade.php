<div id="este">
    @if($previous)
    <a href="{{URL::to('Perfil/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
    @endif
    
    @if($next)
    <a href="{{URL::to('Perfil/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo" disabled>Siguiente</button>
    @endif

    <a href="{{url('/Perfil')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
</div>