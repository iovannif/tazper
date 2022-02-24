<div class="paginacion">
@if($paginator->hasPages())
    @if($paginator->onFirstPage())
    <a href="" class="anterior inactivo"><button class="boton" name="anterior" id="anterior_inactivo">Anterior</button></a>
    @else    
    <a href="{{$paginator->previousPageUrl()}}" rel="prev" class="anterior"><button class="boton" id="anterior">Anterior</button></a>    
    @endif

    @if($paginator->hasMorePages())
    <a href="{{$paginator->nextPageUrl()}}" rel="next" class="siguiente"><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <a href="#" class="siguiente inactivo"><button class="boton" name="anterior" id="siguiente_inactivo">Siguiente</button></a>
    @endif
@endif
</div>