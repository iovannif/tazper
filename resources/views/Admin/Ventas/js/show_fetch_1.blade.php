<div id="este">
    @if($previous)
    <a href="{{URL::to('Ventas/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
    @endif

    <a href="{{URL::to('Ventas/'.$venta->Id_Ven.'/informe')}}" class="informe"><button class="boton" name="reporte" id="informe">Informe</button></a>                        
    
    @if($venta->Ven_Est=='Válida')
    <a href="{{URL::to('Ventas/'.$venta->Id_Ven.'/anular')}}"><button class="boton anular">Anular</button></a>      
    @else
    <a href="{{URL::to('Ventas/'.$venta->Id_Ven.'/desanular')}}"><button class="boton anular">Desanular</button></a>           
    @endif                      

    <a href="{{URL::to('Ventas/comprobante/'.$venta->Id_Ven)}}" class="informe"><button class="boton" id="informe">Factura</button></a>                        
    
    @if($next)
    <a href="{{URL::to('Ventas/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
    @endif

    <a href="{{url('Ventas')}}" class="listado"><button class="boton lista" id="lista">Volver</button></a>
</div>