<div id="este">
    @if($previous)
    <a href="{{URL::to('Proveedores/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo" disabled>Anterior</button>
    @endif
    
    <a href="{{url('Proveedores/'.$proveedor->Id_Prov.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>
    
    <input class="boton eliminar" type="submit" id="borrar" value="Eliminar" onclick="
        if($('.foreign').val()!=''){
            $('#rechazo').show().delay(1500).fadeOut(0);
        }else{
            $('#confirm').css('display','block');
        }
    ">        
    
    @if($next)
    <a href="{{URL::to('Proveedores/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
    @endif

    <a href="{{url('Proveedores')}}" class="volver"><button class="boton lista" id="lista">Volver</button></a>
</div>