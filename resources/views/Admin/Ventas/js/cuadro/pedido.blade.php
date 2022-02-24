<ul id="pedprov">    
    @if($pedido!='') <!-- si existe --> 
    <!-- datos del ped -->        
        <!-- cabecera, cli -->               
        <input type="hidden" id="id_cli" value="{{$cliente->Id_Cli}}">
        <input type="hidden" id="nom_cli" value="{{$cliente->Cli_Nom.' '.$cliente->Cli_Ape}}">
        <input type="hidden" id="ruc_cli" value="{{$cliente->Cli_Ruc}}">
        <input type="hidden" id="cat_cli" value="{{--$cat--}}{{$pedido->PedCli_CliLp}}">
        <input type="hidden" id="desc_cli" value="{{--$desc--}}{{$pedido->PedCli_CliDesc}}">
        <!-- cond med -->
    
        <!-- det -->
            @php                 
                $i=0;         

                $excede='false';
            @endphp              
    
        <table class="hidden">
        @foreach($detalles as $detalle)   
            @php                 
                $id_art='id_art_'.$i;
                $art_des='art_des_'.$i;
                $art_pre='art_pre_'.$i;
                $art_cost='art_cost_'.$i;
                $art_imp='id_imp_'.$i; 
                $art_cant='art_cant_'.$i;      
                $art_st='art_st_'.$i;      
                $art_tot='art_imp_'.$i;                                       
            @endphp   

            <tr>
                @foreach($articulos as $articulo)                        
                @if($articulo->Id_Art==$det_art[$i]->Id_Art)
                <td><input type="text" size="4" class="{{$id_art}}" value="{{$det_art[$i]->Id_Art}}" disabled></td>                                                            
                <td><input type="text" size="35" class="{{$art_des}}" value="{{$articulo->Art_DesLar}}" disabled></td>    
                <td><input type="text" size="7" class="{{$art_pre}}" value="{{$articulo->Art_PreVen}}" disabled></td>                                
                <td><input type="text" size="7" class="{{$art_cost}}" value="{{$articulo->Art_PreCom}}" disabled></td>                                
                <td><input type="text" size="7" class="{{$art_imp}}" value="{{$articulo->Id_Imp}}" disabled></td>
                <td><input type="text" size="3" class="{{$art_cant}}" value="{{$detalle->PCD_ArtCant}}" disabled></td>                    
                <td><input type="text" size="4" class="{{$art_st}}" value="{{$articulo->Art_St}}" disabled></td>                    

                    @if($detalle->PCD_ArtCant>$articulo->Art_St)
                        @php
                            $excede='true';
                        @endphp

                        break;
                    @endif            
                @endif            
                @endforeach

                <td><input type="text" size="4" class="excede" value="{{$excede}}" disabled></td>                    
            </tr>                
            
            @php            
                $i++;            
            @endphp                                                         
        @endforeach             
        </table>        
                
        <style onload="//rellena venta
            // Cabecera
            $('#busca_prov').val($('#nom_cli').val()).prop('disabled',true);
            $('input[name=cli_ruc]').val($('#ruc_cli').val()); 
            $('input[name=cli_cat]').val($('#cat_cli').val()); 
            $('input[name=cli_desc]').val($('#desc_cli').val()+'%'); 
            $('input[name=Id_Cli]').val($('#id_cli').val());   
            window.cli=($('#desc_cli').val());  
            
            // Detalle            
                //limpia lo que quedo 
                $('#detalle input').val('');
                $('#compra_total input').val('');                                    
                
                //inhabilita        
                $('#busqueda,#art_cant').prop('disabled',true);
                $('#detalle button').css('pointer-events','none');

            if($('.excede').val()=='true'){
                $('#aviso').html('Excede stock');                      
            }else{
                    $('#aviso').html('&nbsp;');

                    liq5=0;
                    liq10=0;

                //Linea 1
                $('#art_id_1').val($('.id_art_0').val()); //array                                  
                $('#des_art_1').val($('.art_des_0').val());                                  
                $('#pre_1').val($('.art_pre_0').val());   
                $('#cost_1').val($('.art_cost_0').val());                                  
                $('#cant_art_1').val($('.art_cant_0').val()); //15     

                    // console.log(window.cli);

                    //descuentos
                    if($('#cant_art_1').val()>=15){ //may
                        var may=10;

                        $('#may_1').val(may+'%');
                    }else{
                        var may=0;
                    }                     
                    
                    if(window.cli>0){ //cli
                        $('#lp_1').val(window.cli+'%');
                    }                                                                 
                    // if(window.dia>0){ //dia
                    //     $('#dia_1').val(window.dia+'%');
                    // }
                    
                    //saldo     
                    var descuento=parseInt(window.dia)+parseInt(window.cli)+parseInt(may); //desc    
                    if(descuento>0){
                        var descontar=$('#pre_1').val()*descuento;
                        var descontar=descontar/100;
                    }else{
                        var descontar=0;
                    }          
                    var pre=$('#pre_1').val()-descontar;                                 
                    if(pre>0){$('#saldo_1').val(pre);}

                    var importe=pre*$('#cant_art_1').val(); 
                    var costo=$('#cost_1').val()*$('#cant_art_1').val();
                                                                                                                                            
                if($('.id_imp_0').val()==1){
                    $('#exen_1').val(importe);                                                  
                    $('#cost_exen_1').val(costo);

                }else if($('.id_imp_0').val()==2){                
                    $('#iva5_1').val(importe);                    
                    $('#cost_iva5_1').val(costo);

                    //liq5
                    liq5+=$('#iva5_1').val()*0.05-$('#cost_iva5_1').val()*0.05;

                }else if($('.id_imp_0').val()==3){                
                    $('#iva10_1').val(importe);                                  
                    $('#cost_iva10_1').val(costo);

                    //liq10
                    liq10+=$('#iva10_1').val()*0.10-$('#cost_iva10_1').val()*0.10;
                }         

                //linea 2
                $('#art_id_2').val($('.id_art_1').val());                                  
                $('#des_art_2').val($('.art_des_1').val());                                  
                $('#pre_2').val($('.art_pre_1').val());  
                $('#cost_2').val($('.art_cost_1').val());                                                                  
                $('#cant_art_2').val($('.art_cant_1').val());                                             

                    //descuentos
                    if($('#cant_art_2').val()>=15){ //may
                        var may=10;

                        $('#may_2').val(may+'%');
                    }else{
                        var may=0;
                    }                     
                    
                    if($('#art_id_2').val()!=''){
                    if(window.cli>0){ //cli
                        $('#lp_2').val(window.cli+'%');
                    }                                                                 
                    // if(window.dia>0){ //dia
                    //     $('#dia_2').val(window.dia+'%');
                    // }
                    }
                    
                    //saldo     
                    var descuento=parseInt(window.dia)+parseInt(window.cli)+parseInt(may); //desc    
                    if(descuento>0){
                        var descontar=$('#pre_2').val()*descuento;
                        var descontar=descontar/100;
                    }else{
                        var descontar=0;
                    }          
                    var pre=$('#pre_2').val()-descontar;                                 
                    if(pre>0){$('#saldo_2').val(pre);}

                    var importe=pre*$('#cant_art_2').val(); 
                    var costo=$('#cost_2').val()*$('#cant_art_2').val();
                                                                                                                                            
                if($('.id_imp_1').val()==1){
                    $('#exen_2').val(importe);                                                  
                    $('#cost_exen_2').val(costo);

                }else if($('.id_imp_1').val()==2){                
                    $('#iva5_2').val(importe);                    
                    $('#cost_iva5_2').val(costo);

                    liq5+=$('#iva5_2').val()*0.05-$('#cost_iva5_2').val()*0.05;

                }else if($('.id_imp_1').val()==3){                
                    $('#iva10_2').val(importe);                                  
                    $('#cost_iva10_2').val(costo);

                    liq10+=$('#iva10_2').val()*0.10-$('#cost_iva10_2').val()*0.10;
                }                                    

                //linea 3
                $('#art_id_3').val($('.id_art_2').val());                                  
                $('#des_art_3').val($('.art_des_2').val());                                  
                $('#pre_3').val($('.art_pre_2').val());   
                $('#cost_3').val($('.art_cost_2').val());                                                                 
                $('#cant_art_3').val($('.art_cant_2').val());                                             

                    //descuentos
                    if($('#cant_art_3').val()>=15){ //may
                        var may=10;

                        $('#may_3').val(may+'%');
                    }else{
                        var may=0;
                    }                     
                    
                    if($('#art_id_3').val()!=''){                    
                    if(window.cli>0){ //cli
                        $('#lp_3').val(window.cli+'%');
                    }

                    // if(window.dia>0){ //dia
                    //     $('#dia_3').val(window.dia+'%');
                    // }
                    }
                    
                    //saldo     
                    var descuento=parseInt(window.dia)+parseInt(window.cli)+parseInt(may); //desc    
                    if(descuento>0){
                        var descontar=$('#pre_3').val()*descuento;
                        var descontar=descontar/100;
                    }else{
                        var descontar=0;
                    }          
                    var pre=$('#pre_3').val()-descontar;                                 
                    if(pre>0){$('#saldo_3').val(pre);}

                    var importe=pre*$('#cant_art_3').val(); 
                    var costo=$('#cost_3').val()*$('#cant_art_3').val();
                                                                                                                                            
                if($('.id_imp_2').val()==1){
                    $('#exen_3').val(importe);                                                  
                    $('#cost_exen_3').val(costo);

                }else if($('.id_imp_2').val()==2){                
                    $('#iva5_3').val(importe);                    
                    $('#cost_iva5_3').val(costo);

                    liq5+=$('#iva5_3').val()*0.05-$('#cost_iva5_3').val()*0.05;

                }else if($('.id_imp_2').val()==3){                
                    $('#iva10_3').val(importe);                                  
                    $('#cost_iva10_3').val(costo);

                    liq10+=$('#iva10_3').val()*0.10-$('#cost_iva10_3').val()*0.10;
                }            

                //linea 4
                $('#art_id_4').val($('.id_art_3').val());                                  
                $('#des_art_4').val($('.art_des_3').val());                                  
                $('#pre_4').val($('.art_pre_3').val());     
                $('#cost_4').val($('.art_cost_3').val());       
                $('#cant_art_4').val($('.art_cant_3').val());                                             

                    //descuentos
                    if($('#cant_art_4').val()>=15){ //may
                        var may=10;

                        $('#may_4').val(may+'%');
                    }else{
                        var may=0;
                    }                     
                    
                    if($('#art_id_4').val()!=''){                    
                    if(window.cli>0){ //cli
                        $('#lp_4').val(window.cli+'%');
                    }                                                               
                    // if(window.dia>0){ //dia
                    //     $('#dia_4').val(window.dia+'%');
                    // }
                    }
                    
                    //saldo     
                    var descuento=parseInt(window.dia)+parseInt(window.cli)+parseInt(may); //desc    
                    if(descuento>0){
                        var descontar=$('#pre_4').val()*descuento;
                        var descontar=descontar/100;
                    }else{
                        var descontar=0;
                    }          
                    var pre=$('#pre_4').val()-descontar;                                 
                    if(pre>0){$('#saldo_4').val(pre);}

                    var importe=pre*$('#cant_art_4').val(); 
                    var costo=$('#cost_4').val()*$('#cant_art_4').val();
                                                                                                                                            
                if($('.id_imp_3').val()==1){
                    $('#exen_4').val(importe);                                                  
                    $('#cost_exen_4').val(costo);

                }else if($('.id_imp_3').val()==2){                
                    $('#iva5_4').val(importe);                    
                    $('#cost_iva5_4').val(costo);

                    liq5+=$('#iva5_4').val()*0.05-$('#cost_iva5_4').val()*0.05;

                }else if($('.id_imp_3').val()==3){                
                    $('#iva10_4').val(importe);                                  
                    $('#cost_iva10_4').val(costo);

                    liq10+=$('#iva10_4').val()*0.10-$('#cost_iva10_4').val()*0.10;
                }                           

                //linea 5
                $('#art_id_5').val($('.id_art_4').val());                                  
                $('#des_art_5').val($('.art_des_4').val());                                  
                $('#pre_5').val($('.art_pre_4').val());    
                $('#cost_5').val($('.art_cost_4').val());       
                $('#cant_art_5').val($('.art_cant_4').val());                                             

                    //descuentos
                    if($('#cant_art_5').val()>=15){ //may
                        var may=10;

                        $('#may_5').val(may+'%');
                    }else{
                        var may=0;
                    }                     
                                    
                    if($('#art_id_5').val()!=''){
                    if(window.cli>0){ //cli
                        $('#lp_5').val(window.cli+'%');
                    }                                                                 
                    // if(window.dia>0){ //dia
                    //     $('#dia_5').val(window.dia+'%');
                    // }
                    }
                    
                    //saldo     
                    var descuento=parseInt(window.dia)+parseInt(window.cli)+parseInt(may); //desc    
                    if(descuento>0){
                        var descontar=$('#pre_5').val()*descuento;
                        var descontar=descontar/100;
                    }else{
                        var descontar=0;
                    }          
                    var pre=$('#pre_5').val()-descontar;                                 
                    if(pre>0){$('#saldo_5').val(pre);}

                    var importe=pre*$('#cant_art_5').val(); 
                    var costo=$('#cost_5').val()*$('#cant_art_5').val();
                                                                                                                                            
                if($('.id_imp_4').val()==1){
                    $('#exen_5').val(importe);                                                  
                    $('#cost_exen_5').val(costo);

                }else if($('.id_imp_4').val()==2){                
                    $('#iva5_5').val(importe);                    
                    $('#cost_iva5_5').val(costo);

                    liq5+=$('#iva5_5').val()*0.05-$('#cost_iva5_5').val()*0.05;

                }else if($('.id_imp_4').val()==3){                
                    $('#iva10_5').val(importe);                                  
                    $('#cost_iva10_5').val(costo);

                    liq10+=$('#iva10_5').val()*0.10-$('#cost_iva10_5').val()*0.10;
                }              

                //linea 6
                $('#art_id_6').val($('.id_art_5').val());                                  
                $('#des_art_6').val($('.art_des_5').val());                                  
                $('#pre_6').val($('.art_pre_5').val());    
                $('#cost_6').val($('.art_cost_5').val());       
                $('#cant_art_6').val($('.art_cant_5').val());                                             

                    //descuentos
                    if($('#cant_art_6').val()>=15){ //may
                        var may=10;

                        $('#may_6').val(may+'%');
                    }else{
                        var may=0;
                    }                     
                    
                    if($('#art_id_6').val()!=''){
                    if(window.cli>0){ //cli
                        $('#lp_6').val(window.cli+'%');
                    }                                                                 
                    // if(window.dia>0){ //dia
                    //     $('#dia_6').val(window.dia+'%');
                    // }                                                    
                    }

                    //saldo     
                    var descuento=parseInt(window.dia)+parseInt(window.cli)+parseInt(may); //desc    
                    if(descuento>0){
                        var descontar=$('#pre_6').val()*descuento;
                        var descontar=descontar/100;
                    }else{
                        var descontar=0;
                    }          
                    var pre=$('#pre_6').val()-descontar;                                 
                    if(pre>0){$('#saldo_6').val(pre);}

                    var importe=pre*$('#cant_art_6').val(); 
                    var costo=$('#cost_6').val()*$('#cant_art_6').val();
                                                                                                                                            
                if($('.id_imp_5').val()==1){
                    $('#exen_6').val(importe);                                                  
                    $('#cost_exen_6').val(costo);

                }else if($('.id_imp_5').val()==2){                
                    $('#iva5_6').val(importe);                    
                    $('#cost_iva5_6').val(costo);

                    liq5+=$('#iva5_6').val()*0.05-$('#cost_iva5_6').val()*0.05;

                }else if($('.id_imp_5').val()==3){                
                    $('#iva10_6').val(importe);                                  
                    $('#cost_iva10_6').val(costo);

                    liq10+=$('#iva10_6').val()*0.10-$('#cost_iva10_6').val()*0.10;
                }         
                
                //linea 7
                $('#art_id_7').val($('.id_art_6').val());                                  
                $('#des_art_7').val($('.art_des_6').val());                                  
                $('#pre_7').val($('.art_pre_6').val());      
                $('#cost_7').val($('.art_cost_6').val());       
                $('#cant_art_7').val($('.art_cant_6').val());                                             

                    //descuentos
                    if($('#cant_art_7').val()>=15){ //may
                            var may=10;

                        $('#may_7').val(may+'%');
                    }else{
                        var may=0;
                    }                     
                    
                    if($('#art_id_7').val()!=''){
                    if(window.cli>0){ //cli
                        $('#lp_7').val(window.cli+'%');
                    }                                                                 
                    // if(window.dia>0){ //dia
                    //     $('#dia_7').val(window.dia+'%');
                    // }
                    }
                    
                    //saldo     
                    var descuento=parseInt(window.dia)+parseInt(window.cli)+parseInt(may); //desc    
                    if(descuento>0){
                        var descontar=$('#pre_7').val()*descuento;
                        var descontar=descontar/100;
                    }else{
                        var descontar=0;
                    }          
                    var pre=$('#pre_7').val()-descontar;                                 
                    if(pre>0){$('#saldo_7').val(pre);}

                    var importe=pre*$('#cant_art_7').val(); 
                    var costo=$('#cost_7').val()*$('#cant_art_7').val();
                                                                                                                                            
                if($('.id_imp_6').val()==1){
                    $('#exen_7').val(importe);                                                  
                    $('#cost_exen_7').val(costo);

                }else if($('.id_imp_6').val()==2){                
                    $('#iva5_7').val(importe);                    
                    $('#cost_iva5_7').val(costo);

                    liq5+=$('#iva5_7').val()*0.05-$('#cost_iva5_7').val()*0.05;

                }else if($('.id_imp_6').val()==3){                
                    $('#iva10_7').val(importe);                                  
                    $('#cost_iva10_7').val(costo);

                    liq10+=$('#iva10_7').val()*0.10-$('#cost_iva10_7').val()*0.10;
                }                       

                //linea 8
                $('#art_id_8').val($('.id_art_7').val());                                  
                $('#des_art_8').val($('.art_des_7').val());                                  
                $('#pre_8').val($('.art_pre_7').val());     
                $('#cost_8').val($('.art_cost_7').val());       
                $('#cant_art_8').val($('.art_cant_7').val());                                             

                    //descuentos
                    if($('#cant_art_8').val()>=15){ //may
                        var may=10;

                        $('#may_8').val(may+'%');
                    }else{
                        var may=0;
                    }                     
                    
                    if($('#art_id_8').val()!=''){
                    if(window.cli>0){ //cli
                        $('#lp_8').val(window.cli+'%');
                    }                                                                 
                    // if(window.dia>0){ //dia
                    //     $('#dia_8').val(window.dia+'%');
                    // }
                    }
                    
                    //saldo     
                    var descuento=parseInt(window.dia)+parseInt(window.cli)+parseInt(may); //desc    
                    if(descuento>0){
                        var descontar=$('#pre_8').val()*descuento;
                        var descontar=descontar/100;
                    }else{
                        var descontar=0;
                    }          
                    var pre=$('#pre_8').val()-descontar;                                 
                    if(pre>0){$('#saldo_8').val(pre);}

                    var importe=pre*$('#cant_art_8').val(); 
                    var costo=$('#cost_8').val()*$('#cant_art_8').val();
                                                                                                                                            
                if($('.id_imp_7').val()==1){
                    $('#exen_8').val(importe);                                                  
                    $('#cost_exen_8').val(costo);

                }else if($('.id_imp_7').val()==2){                
                    $('#iva5_8').val(importe);                    
                    $('#cost_iva5_8').val(costo);

                    liq5+=$('#iva5_8').val()*0.05-$('#cost_iva5_8').val()*0.05;

                }else if($('.id_imp_7').val()==3){                
                    $('#iva10_8').val(importe);                                  
                    $('#cost_iva10_8').val(costo);

                    liq10+=$('#iva10_8').val()*0.10-$('#cost_iva10_8').val()*0.10;
                }   

                //sub
                var exe=0;
                var iva5=0;
                var iva10=0;                

                $('.exentas').each(function(){
                    if($(this).val()==''){
                        exe+=0;
                    }else{
                        exe+=parseInt($(this).val());
                    }
                });

                $('.iva_5').each(function(){
                    if($(this).val()==''){
                        iva5+=0;
                    }else{
                        iva5+=parseInt($(this).val());
                    }
                });

                $('.iva10').each(function(){
                    if($(this).val()==''){
                        iva10+=0;
                    }else{
                        iva10+=parseInt($(this).val());
                    }
                });

                $('input[name=Com_StExe]').val(exe);
                $('input[name=Com_St5]').val(iva5);
                $('input[name=Com_St10]').val(iva10);

                //total
                $('input[name=Com_Total]').val(exe+parseInt(iva5)+parseInt(iva10));                              

                $('#liq5').val(liq5);
                $('#liq10').val(liq10);
                $('#totiva').val(liq5+liq10);
            }
        "></style>   
    @else <!-- si no existe -->
        <style onload=" //en blanco
            // cabecera
            $('#busca_prov').val('').prop('disabled',false);
            $('input[name=Id_Cli]').val('');
            $('input[name=cli_ruc]').val('');
            $('input[name=cli_cat]').val('');
            $('input[name=cli_desc]').val('');            
            
            // detalle
            $('#detalle input').val('');
            //totales
            $('#total input').val('');

            //opciones
            $('#art_cant').prop('disabled',false); //#busqueda,
            $('#detalle button').css('pointer-events','auto');           

            $('#aviso').html('&nbsp;');

            //BUSCA ART

            // venta_form
            // $('#limpiar').trigger('click');
        "></style>                
    @endif
</ul>