@if($productos->count()>0)
<ul class="lista_js" id="producto">
    @foreach($productos as $prod)
    <li class="item_js" id="descripcion" onclick="
        //articulo
        $('#busca_producto,#art_des').val($.trim($(this).text()));
        $('#id_art').val($(this).find('#art_id').val());                
        $('#art_pre').val($('.item_js:hover #precio').val());
        $('#art_st').val($('.item_js:hover #stock').val());        
        $('#art_cant').focus();
                
        $('.prod .cambiar').css('display','inline-block');
        $('#busca_producto').prop('disabled',true);

        var stock='<?php echo $prod->Art_St; ?>';                               
                
        $('#art_st').val(stock);">
            {{$prod->Art_DesLar}}
            <input type="hidden" id="art_id" value="{{$prod->Id_Art}}">        
            <input type="hidden" id="precio" value="{{$prod->Art_PreVen}}">        
    </li>        
    @endforeach
</ul>
@endif

<style>
    #descripcion:hover{
        background:lightblue;
    }
</style>