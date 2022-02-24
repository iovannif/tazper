@php
    $articulos = $articulos->filter(function($articulo) {
    return $articulo->Art_ProdTip != 'Tazper';
    });
@endphp

@if($articulos->count()>0)
<ul id="resultados">    
    @foreach($articulos as $articulo)
    <li id="descripcion" onclick="
        $('#art_des').val($.trim($(this).text()));
        $('#id_art').val($(this).find('#id').val());
        $('#art_pre').val($(this).find('#precio').val());
        $('#art_st').val($(this).find('#stock').val());
        $('#art_imp').val($(this).find('#impuesto').val());
        $('#art_med').val($(this).find('#uni_med').val());        
            $('#tipo').val($(this).find('#tip').val());      
            // window.med=$(this).find('#uni_med').val();  
        
            $('#resultados').css('display','none');
            $('#busqueda').val('');
            $('#art_cant').focus();            
            // $('#art_des').attr('disabled', true);
            // $('#id_art').attr('disabled', true);
            // $('#art_pre').attr('disabled', true);
            // $('#art_st').attr('disabled', true);
            // $('#art_imp').attr('disabled', true);
            ">
        {{$articulo->Art_DesLar}}
    
        <input type="hidden" name="identificador" id="id" value="{{$articulo->Id_Art}}">
        <input type="hidden" id="precio" value="{{$articulo->Art_PreCom}}">
        <input type="hidden" id="stock" value="{{$articulo->Art_St}}">
        <input type="hidden" id="uni_med" value="{{$articulo->Art_UniMed}}">        
            <input type="hidden" id="tip" value="{{$articulo->Art_Tip}}">
        @foreach($impuestos as $impuesto)
            @if($impuesto->Id_Imp==$articulo->Id_Imp)
            <input type="hidden" id="impuesto" value="{{$impuesto->Imp_Des}}">
            @endif
        @endforeach
    </li>
    @endforeach
</ul>

<style>
    #descripcion:hover{
        background:lightblue;
    }
</style>
@endif