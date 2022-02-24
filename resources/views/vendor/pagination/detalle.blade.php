<div class="paginacion_det">
@if($paginator->hasPages())
    @if($paginator->onFirstPage())
    <a href="#" class="anterior inactivo"><button class="boton" name="anterior" id="anterior_inactivo">Anterior</button></a>
    @else    
    <a href="{{$paginator->previousPageUrl()}}" rel="prev" class="anterior" onclick="
        event.preventDefault();
        $(document).ready(function(){
            var lp=window.lp;
            var page=$('.paginacion_det .anterior').attr('href').split('page=')[1];        

            fetch('/Tazper/public/ListaPrecio/'+lp+'/detalle?page='+page, {method:'get'})
            .then(response=>response.text())
            .then(html=>{document.getElementById('lp_det').innerHTML=html});
        });
    "><button class="boton" id="anterior">Anterior</button></a>    
    @endif

    @if($paginator->hasMorePages())
    <a href="{{$paginator->nextPageUrl()}}" rel="next" class="siguiente" onclick="
        event.preventDefault();
        $(document).ready(function(){
            var lp=window.lp;
            var page=$('.paginacion_det .siguiente').attr('href').split('page=')[1];        

            fetch('/Tazper/public/ListaPrecio/'+lp+'/detalle?page='+page, {method:'get'})
            .then(response=>response.text())
            .then(html=>{document.getElementById('lp_det').innerHTML=html});
        });
    "><button class="boton" id="siguiente">Siguiente</button></a>
    @else
    <a href="#" class="siguiente inactivo"><button class="boton" name="anterior" id="siguiente_inactivo">Siguiente</button></a>
    @endif
@endif
</div>