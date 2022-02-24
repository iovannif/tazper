<div id="este">
    @if($previous)
    <a href="{{URL::to('Productos_Categoria/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
    @endif

    <a href="{{url('Productos_Categoria/'.$cat->Id_Cat.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>

    <a href="#" class="eliminar"><button class="boton" id="borrar" onclick="        
        if($('#prod_cant').val()>0){
            $('#rechazo').show().delay(1500).fadeOut(0);
        }else{
            $('#confirm').css('display','block');
        }
    ">Eliminar</button></a>

    @if($next)
    <a href="{{URL::to('Productos_Categoria/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
    @endif

    <a href="{{url('Productos_Categoria')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
</div>