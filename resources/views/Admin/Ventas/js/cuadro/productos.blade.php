@if($articulos->count()>0)
<ul id="resultados" class="productos">    
    @foreach($articulos as $articulo)

        {{--@if($categorias->count()>0)
            @foreach($categorias as $cat)
                @if($cat->Id_Cat==$articulo->Id_Cat)
                    $categoria=$cat->Cat_Des;            
                @endif
            @endforeach
        @else
            @php $categoria=''; @endphp
        @endif--}}

    <li id="descripcion" onclick="
        $('#art_des').val($.trim($(this).text()));
        $('#id_art').val($(this).find('#id').val());
        $('#art_pre').val($(this).find('#precio').val());
        $('#art_cost').val($(this).find('#costo').val());
        $('#art_imp').val($(this).find('#impuesto').val());  
        $('#art_cat').val($(this).find('#categoria').val());                      
        //st //si esta en lista        
        if($.trim($(this).text())==$('#des_art_1').val()){    
            $('#art_st').val($('#stock_1').val());   
                  
        }else if($.trim($(this).text())==$('#des_art_2').val()){
            $('#art_st').val($('#stock_2').val());            

        }else if($.trim($(this).text())==$('#des_art_3').val()){
            $('#art_st').val($('#stock_3').val());            

        }else if($.trim($(this).text())==$('#des_art_4').val()){
            $('#art_st').val($('#stock_4').val());            

        }else if($.trim($(this).text())==$('#des_art_5').val()){
            $('#art_st').val($('#stock_5').val());            

        }else if($.trim($(this).text())==$('#des_art_6').val()){
            $('#art_st').val($('#stock_6').val());            

        }else if($.trim($(this).text())==$('#des_art_7').val()){
            $('#art_st').val($('#stock_7').val());            

        }else if($.trim($(this).text())==$('#des_art_8').val()){
            $('#art_st').val($('#stock_8').val());            
            
        }else{
            // $('#art_st').val($('#stock').val()); //original
            $('#art_st').val($(this).find('#stock').val()); //original
        }
        
            $('#resultados').css('display','none');
            $('#busqueda').val('');
            $('#art_cant').focus();">
        {{$articulo->Art_DesLar}}
    
        <input type="hidden" name="identificador" id="id" value="{{$articulo->Id_Art}}">
        <input type="hidden" id="costo" value="{{$articulo->Art_PreCom}}">
        <input type="hidden" id="precio" value="{{$articulo->Art_PreVen}}">
        <input type="hidden" id="stock" value="{{$articulo->Art_St}}">   
        {{-- <input type="hidden" id="categoria" value="{{$categoria}}"> --}}
        <input type="hidden" id="categoria" value="{{$articulo->Id_Cat}}">   
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