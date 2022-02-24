<div id="este">
    @if($previous)
    <a href="{{URL::to('OrdenCompra/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo" disabled>Anterior</button>
    @endif
    
    <a href="{{url('/OrdenCompra/pdf/'.$orden->Id_OC)}}"><button class="boton informe">Imprimir</button></a>                   
    
    @if($orden->OC_Est=='Pendiente')    
        <button class="boton eliminar" id="borrar" onclick="$('#cancela').show();">Cancelar</button>    
    @else
        <a href="{{url('/OrdenCompra/'.$orden->Id_OC.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>
           
        <!-- <button class="boton informe">Imprimir</button> -->

        <button class="boton eliminar" id="eliminar" onclick="$('#confirm').show();">Eliminar</button>          
    @endif  
    
    @if($next)
    <a href="{{URL::to('OrdenCompra/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo" disabled>Siguiente</button>
    @endif

    <a href="{{url('OrdenCompra')}}" class="volver"><button class="boton lista" id="lista">Volver</button></a>
</div>