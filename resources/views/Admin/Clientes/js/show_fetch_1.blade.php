<div id="este">
    @if($previous)
    <a href="{{URL::to('Clientes/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
    @endif                

    <button class="boton eliminar" id="borrar" onclick="
        <?php      
        // $ventas=0;  
        // ->count() 
        if($ventas>0 || $pedidos>0){ ?>;
            $('#rechazo').show().delay(1500).fadeOut(0);
        <?php }else{ ?>;
            $('#confirm').css('display','block');
        <?php } ?>;
    ">Eliminar</button>     
    
    @if($next)
    <a href="{{URL::to('Clientes/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
    @endif

    <a href="{{url('Clientes')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
</div>