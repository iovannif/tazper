<div id="este">
    @if($previous)
    <a href="{{URL::to('Materiales/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
    @endif
    
    <a href="{{url('Materiales/'.$material->Id_Mat.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>

    <button class="boton eliminar" id="borrar" onclick="
        <?php 
        // $materiales=0; 
        if($produccion>0 || $pedidos>0 || $compras>0){ ?>;
            $('#rechazo').show().delay(1500).fadeOut(0);
        <?php }else{ ?>;
            $('#confirm').css('display','block');
        <?php } ?>;
    ">Eliminar</button> 

    @if($next)
    <a href="{{URL::to('Materiales/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
    @endif
    
    <a href="{{url('Materiales')}}" class="listado"><button class="boton lista" id="volver">Volver</button></a> 
</div>