<div id="este">
    @if($previous)
    <a href="{{URL::to('Arqueo/'.$previous)}}" class="anterior primer"><button class="boton" id="anterior">Anterior</button></a>
    @else
    <button class="boton anterior primer" id="anterior_inactivo">Anterior</button>
    @endif

    <a href="{{URL::to('Arqueo/'.$arqueo->Id_Arq.'/informe')}}" style="margin: 0 12px;">
        <button class="boton informe" id="informe">Reporte</button>
    </a>  

    @if($next)
    <a href="{{URL::to('Arqueo/'.$next)}}" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <button class="boton siguiente" id="siguiente_inactivo">Siguiente</button>
    @endif

    <a href="{{url('/Arqueo')}}" class="volver"><button class="boton lista" id="lista">Volver</button></a>
</div>