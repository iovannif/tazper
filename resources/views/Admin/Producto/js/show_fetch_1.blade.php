<div id="este">
    @if($previous)
    <a href="{{URL::to('Productos/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
    @endif
    
    <a href="{{url('Productos/'.$producto->Id_Prod.'/edit')}}" class="modificar"><button class="boton" id="actualizar">Modificar</button></a>

    <button class="boton eliminar" id="borrar" onclick="
        <?php 
        // $productos=0; 
        // if($productos>0){
        if($produccion>0 || $ped_prov>0 || $compras>0 || $ped_cli>0 || $ventas>0 || $descuentos>0){ ?>;            
            $('#rechazo').show().delay(1500).fadeOut(0);
        <?php }else{ ?>;
            $('#confirm').css('display','block');
        <?php } ?>;
    ">Eliminar</button> 

    @if($next)
    <a href="{{URL::to('Productos/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
    @endif
    
    <a href="{{url('Productos')}}" class="listado"><button class="boton lista" id="volver">Volver</button></a> 
</div>