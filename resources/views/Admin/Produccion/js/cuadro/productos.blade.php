@if($productos->count()>0)
<ul class="lista_js" id="productos">
    @foreach($productos as $producto)
    <li class="item_js" id="descripcion" onclick="
        $('#id_prod').val($(this).find('#id').text());    
        $(this).find('#id').remove();   
        $('#busca_prod').val($.trim($(this).text()));
        $('#busca_prod').prop('disabled','true');
        // $('.prod .cambiar').css('display','inline-block');
        $('.cam_prod').css('display','inline-block');">
        {{$producto->Art_DesLar}}
        <span id="id">{{$producto->Id_Art}}</span>
    </li>        
    @endforeach
</ul>
@endif

<style>
    #descripcion:hover{
        background:lightblue;
    }
</style>