<div id="este">
    @if($previous)
    <a href="{{URL::to('Usuarios/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo" disabled>Anterior</button>
    @endif

    <a href="{{url('/Usuarios/'.$user->Id_Usu.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>
    <a href="#" class="eliminar"><button class="boton" id="eliminar" onclick="$('#confirm').css('display','block');">Eliminar</button></a>
    
    @if($next)
    <a href="{{URL::to('Usuarios/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo" disabled>Siguiente</button>
    @endif
    
    <a href="{{url('/Usuarios')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
</div>