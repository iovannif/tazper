@php
    $materiales = $materiales->filter(function($material) {
    return $material->Art_ProdTip != 'Tazper';
    });
@endphp

@if($materiales->count()>0)
<ul class="lista_js" id="material">
    @foreach($materiales as $material)
    {{--@if($material->Art_ProdTip!='Tazper')--}}
    <li class="item_js" id="descripcion" onclick="
        //articulo
        $('#busca_material,#art_des').val($.trim($(this).text()));
        $('#id_art').val($('.item_js:hover .art_id').val());        
        $('#id_mat').val($('.item_js:hover #mat_id').val());        
        $('#art_pre').val($('.item_js:hover #precio').val());
        $('#art_st').val($('.item_js:hover #stock').val());
        $('#art_imp').val($('.item_js:hover #impuesto').val());
        $('#art_med').val($('.item_js:hover #med').val());        
            $('#tipo').val($('.item_js:hover #tip').val());                    
        
        $('#art_cant').focus();
                
        $('.mat .cambiar').css('display','inline-block');
        $('#busca_material').prop('disabled',true);

        var stock='<?php echo $material->Art_St; ?>';                               
                
        $('#art_st').val(stock);">
        {{$material->Art_DesLar}}
    
        <input type="hidden" class="art_id" value="{{$material->Id_Art}}">
        <input type="hidden" id="mat_id" value="{{$material->Id_Mat}}">
        <input type="hidden" id="precio" value="{{$material->Art_PreCom}}">
        <input type="hidden" id="med" value="{{$material->Art_UniMed}}">
            <input type="hidden" id="tip" value="{{$material->Art_Tip}}">
    </li>
    {{--@endif--}}
    @endforeach
</ul>
@endif

<style>
    #descripcion:hover{
        background:lightblue;
    }
</style>