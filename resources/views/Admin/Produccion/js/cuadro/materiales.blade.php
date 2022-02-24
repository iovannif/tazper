@if($materiales->count()>0)
<ul class="lista_js" id="material">
    @foreach($materiales as $material)
    <li class="item_js" id="descripcion" onclick="
        //articulo
        $('#busca_material,#art_des').val($.trim($(this).text()));
        // $('#id_art').val($('#art_id').val());        
        // $('#id_mat').val($('#mat_id').val());        
        // $('#art_pre').val($('#precio').val());
        // $('#art_st').val($('#stock').val());
        // $('#art_imp').val($('#impuesto').val());

        $('#id_art').val($(this).find('#art_id').val());        
        $('#id_mat').val($(this).find('#mat_id').val());        
        $('#art_pre').val($(this).find('#precio').val());
        $('#art_st').val($(this).find('#stock').val());
        $('#art_imp').val($(this).find('#impuesto').val());

        $('#art_med').val($(this).find('#med').val()); 
        $('#art_cant').focus();
                
        $('.mat .cambiar').css('display','inline-block');
        $('#busca_material').prop('disabled',true);

        var stock='<?php echo $material->Art_St; ?>';        
        
        if($.trim($(this).text())==$('#des_art_1').val()){    
            stock=stock-$('#cant_art_1').val();     
                  
        }else if($.trim($(this).text())==$('#des_art_2').val()){
            stock=stock-$('#cant_art_2').val();            

        }else if($.trim($(this).text())==$('#des_art_3').val()){
            stock=stock-$('#cant_art_3').val();            

        }else if($.trim($(this).text())==$('#des_art_4').val()){
            stock=stock-$('#cant_art_4').val();            

        }else if($.trim($(this).text())==$('#des_art_5').val()){
            stock=stock-$('#cant_art_5').val();            

        }else if($.trim($(this).text())==$('#des_art_6').val()){
            stock=stock-$('#cant_art_6').val();            

        }else if($.trim($(this).text())==$('#des_art_7').val()){
            stock=stock-$('#cant_art_7').val();            

        }else if($.trim($(this).text())==$('#des_art_8').val()){
            stock=stock-$('#cant_art_8').val();            
            
        }        
        
        $('#art_st').val(stock);">
        {{$material->Art_DesLar}}

        <input type="hidden" id="art_id" value="{{$material->Id_Art}}">
        <input type="hidden" id="mat_id" value="{{$material->Id_Mat}}">
        <input type="hidden" id="precio" value="{{$material->Art_PreCom}}">
        <input type="hidden" id="med" value="{{$material->Art_UniMed}}">
    </li>        
    @endforeach
</ul>
@endif

<style>
    #descripcion:hover{
        background:lightblue;
    }
</style>