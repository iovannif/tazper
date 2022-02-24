<ul id="pedprov">    
    @if($pedido!='') <!-- si existe -->
        <!-- cabecera -->
        <input type="hidden" id="id_oc" value="{{$oc->Id_OC}}">          
        <input type="hidden" id="id_prov" value="{{$proveedor->Id_Prov}}">
        <input type="hidden" id="des_prov" value="{{$proveedor->Prov_Des}}">
        <input type="hidden" id="ruc_prov" value="{{$proveedor->Prov_Ruc}}">
        <input type="hidden" id="tel_prov" value="{{$proveedor->Prov_Tel}}">
        <input type="hidden" id="dir_prov" value="{{$proveedor->Prov_Dir}}">        

        <!-- totales -->
        <input type="hidden" id="oc_tot" value="{{$oc->OC_SubTot}}">  
    
        <!-- detalle -->
        @php                 
            $i=0;         
        @endphp              
    
        <table class="hidden">
        @foreach($detalles as $detalle)   
            @php                 
                $id_art='id_art_'.$i;
                $art_des='art_des_'.$i;
                $art_pre='art_pre_'.$i;
                $art_imp='id_imp_'.$i; 
                $art_cant='art_cant_'.$i;
                $art_unimed='art_unimed_'.$i;
                $art_tot='art_imp_'.$i;            
            @endphp   

            <tr>
                @foreach($articulos as $articulo)                        
                @if($articulo->Id_Art==$det_art[$i]->Id_Art)
                <td><input type="text" size="4" class="{{$id_art}}" value="{{$det_art[$i]->Id_Art}}" disabled></td>                                                            
                <td><input type="text" size="35" class="{{$art_des}}" value="{{$articulo->Art_DesLar}}" disabled></td>                
                <td><input type="text" size="7" class="{{$art_pre}}" value="{{$articulo->Art_PreCom}}" disabled></td>                
                <td><input type="text" size="7" class="{{$art_imp}}" value="{{$articulo->Id_Imp}}" disabled></td>
                <td>
                    <input type="text" size="3" class="{{$art_cant}}" value="{{$detalle->PPD_ArtCant}}" disabled>
                    <input type="text" size="17" class="{{$art_unimed}}" style="text-align:left" value="{{$articulo->Art_UniMed}}" disabled>
                </td>    
                <td><input type="text" size="7" class="{{$art_tot}}" value="{{$importe=$detalle->PPD_ArtCant*$articulo->Art_PreCom}}" disabled></td>                                                    
                @endif            
                @endforeach
            </tr>                
            
            @php            
                $i++;            
            @endphp                                                         
        @endforeach             
        </table>        
                
        <style onload="
            // cabecera
            $('input[name=Id_OC]').val($('#id_oc').val());   
            $('#busca_prov').val($('#des_prov').val()).prop('disabled',true);
            $('input[name=Id_Prov]').val($('#id_prov').val()); 
            $('#prov_ruc').val($('#ruc_prov').val());   
            $('#prov_tel').val($('#tel_prov').val());   
            $('#prov_dir').val($('#dir_prov').val());              

            //cuando sea venta, evaluar la existencia
            
            // detalle            
            $('#exen_1,#exen_2,#exen_3,#exen_4,#exen_5,#exen_6,#exen_7,#exen_8').val('');    
            $('#iva5_1,#iva5_2,#iva5_3,#iva5_4,#iva5_5,#iva5_6,#iva5_7,#iva5_8').val('');   
            $('#iva10_1,#iva10_2,#iva10_3,#iva10_4,#iva10_5,#iva10_6,#iva10_7,#iva10_8').val(''); 
            //limpia lo que quedo
            $('#total input').val('');

            //linea 1
            $('#art_id_1').val($('.id_art_0').val());                                  
            $('#des_art_1').val($('.art_des_0').val());                                  
            $('#pre_1').val($('.art_pre_0' ).val());                                  
            $('#cant_art_1').val($('.art_cant_0').val());                                 
            $('#unmed_art_1').val($('.art_unimed_0').val());                                             
            //impuesto
            if($('.id_imp_0').val()==1){
                $('#exen_1').val($('.art_imp_0').val());                                                  
            }else if($('.id_imp_0').val()==2){                
                $('#iva5_1').val($('.art_imp_0').val());                    
            }else if($('.id_imp_0').val()==3){                
                $('#iva10_1').val($('.art_imp_0').val());                                  
            }         

            //linea 2
            $('#art_id_2').val($('.id_art_1').val());                                  
            $('#des_art_2').val($('.art_des_1').val());                                  
            $('#pre_2').val($('.art_pre_1' ).val());                                  
            $('#cant_art_2').val($('.art_cant_1').val());                                 
            $('#unmed_art_2').val($('.art_unimed_1').val());  

            if($('.id_imp_1').val()==1){
                $('#exen_2').val($('.art_imp_1').val());                                                  
            }else if($('.id_imp_1').val()==2){                
                $('#iva5_2').val($('.art_imp_1').val());                    
            }else if($('.id_imp_1').val()==3){                
                $('#iva10_2').val($('.art_imp_1').val());                                  
            }                                        

            //linea 3
            $('#art_id_3').val($('.id_art_2').val());                                  
            $('#des_art_3').val($('.art_des_2').val());                                  
            $('#pre_3').val($('.art_pre_2' ).val());                                  
            $('#cant_art_3').val($('.art_cant_2').val());                                 
            $('#unmed_art_3').val($('.art_unimed_2').val());                                 

            if($('.id_imp_2').val()==1){
                $('#exen_3').val($('.art_imp_2').val());                                                  
            }else if($('.id_imp_2').val()==2){                
                $('#iva5_3').val($('.art_imp_2').val());                    
            }else if($('.id_imp_2').val()==3){
                $('#iva10_3').val($('.art_imp_2').val());                                  
            }               

            //linea 4
            $('#art_id_4').val($('.id_art_3').val());                                  
            $('#des_art_4').val($('.art_des_3').val());                                  
            $('#pre_4').val($('.art_pre_3' ).val());                                  
            $('#cant_art_4').val($('.art_cant_3').val());                                 
            $('#unmed_art_4').val($('.art_unimed_3').val());                                 

            if($('.id_imp_3').val()==1){
                $('#exen_4').val($('.art_imp_3').val());                                                   
            }else if($('.id_imp_3').val()==2){                
                $('#iva5_4').val($('.art_imp_3').val());                    
            }else if($('.id_imp_3').val()==3){                
                $('#iva10_4').val($('.art_imp_3').val());                                  
            }                            

            //linea 5
            $('#art_id_5').val($('.id_art_4').val());                                  
            $('#des_art_5').val($('.art_des_4').val());                                  
            $('#pre_5').val($('.art_pre_4' ).val());                                  
            $('#cant_art_5').val($('.art_cant_4').val());                                 
            $('#unmed_art_5').val($('.art_unimed_4').val());                                 

            if($('.id_imp_4').val()==1){
                $('#exen_5').val($('.art_imp_4').val());                                                  
            }else if($('.id_imp_4').val()==2){                
                $('#iva5_5').val($('.art_imp_4').val());                    
            }else if($('.id_imp_4').val()==3){
                $('#iva10_5').val($('.art_imp_4').val());                                  
            }                   

            //linea 6
            $('#art_id_6').val($('.id_art_5').val());                                  
            $('#des_art_6').val($('.art_des_5').val());                                  
            $('#pre_6').val($('.art_pre_5' ).val());                                  
            $('#cant_art_6').val($('.art_cant_5').val());                                 
            $('#unmed_art_6').val($('.art_unimed_5').val());                                 

            if($('.id_imp_5').val()==1){
                $('#exen_6').val($('.art_imp_5').val());                                  
            }else if($('.id_imp_5').val()==2){                
                $('#iva5_6').val($('.art_imp_5').val());                    
            }else if($('.id_imp_5').val()==3){
                $('#iva10_6').val($('.art_imp_5').val());                                  
            }            
            
            //linea 7
            $('#art_id_7').val($('.id_art_6').val());                                  
            $('#des_art_7').val($('.art_des_6').val());                                  
            $('#pre_7').val($('.art_pre_6' ).val());                                  
            $('#cant_art_7').val($('.art_cant_6').val());                                 
            $('#unmed_art_7').val($('.art_unimed_6').val());  

            if($('.id_imp_6').val()==1){
                $('#exen_7').val($('.art_imp_6').val());                                  
            }else if($('.id_imp_6').val()==2){
                $('#iva5_7').val($('.art_imp_6').val());    
            }else if($('.id_imp_6').val()==3){
                $('#iva10_7').val($('.art_imp_6').val());                                  
            }                        

            //linea 8
            $('#art_id_8').val($('.id_art_7').val());                                  
            $('#des_art_8').val($('.art_des_7').val());                                  
            $('#pre_8').val($('.art_pre_7' ).val());                                  
            $('#cant_art_8').val($('.art_cant_7').val());                                 
            $('#unmed_art_8').val($('.art_unimed_7').val());                                 

            if($('.id_imp_7').val()==1){
                $('#exen_8').val($('.art_imp_7').val());                                  
            }else if($('.id_imp_7').val()==2){                
                $('#iva5_8').val($('.art_imp_7').val());                    
            }else if($('.id_imp_7').val()==3){                
                $('#iva10_8').val($('.art_imp_7').val());                                  
            }                      
                        
            //totales
            //sub
            var exen=0;
            var iva5=0;
            var iva10=0;            

            //linea1
            if($('#exen_1').val()!=''){
                exen=parseInt($('#exen_1').val());
            }
            if($('#iva5_1').val()!=''){
                iva5=parseInt($('#iva5_1').val());
            }
            if($('#iva10_1').val()!=''){
                iva10=parseInt($('#iva10_1').val());
            }
            
            //linea2
            if($('#exen_2').val()!=''){
                exen+=parseInt($('#exen_2').val());
            }
            if($('#iva5_2').val()!=''){
                iva5+=parseInt($('#iva5_2').val());
            }
            if($('#iva10_2').val()!=''){
                iva10+=parseInt($('#iva10_2').val());
            }

            //linea3
            if($('#exen_3').val()!=''){
                exen+=parseInt($('#exen_3').val());
            }
            if($('#iva5_3').val()!=''){
                iva5+=parseInt($('#iva5_3').val());
            }
            if($('#iva10_3').val()!=''){
                iva10+=parseInt($('#iva10_3').val());
            }

            //linea4
            if($('#exen_4').val()!=''){
                exen+=parseInt($('#exen_4').val());
            }
            if($('#iva5_4').val()!=''){
                iva5+=parseInt($('#iva5_4').val());
            }
            if($('#iva10_4').val()!=''){
                iva10+=parseInt($('#iva10_4').val());
            }

            //linea5
            if($('#exen_5').val()!=''){
                exen+=parseInt($('#exen_5').val());
            }
            if($('#iva5_5').val()!=''){
                iva5+=parseInt($('#iva5_5').val());
            }
            if($('#iva10_5').val()!=''){
                iva10+=parseInt($('#iva10_5').val());
            }
            
            //linea6
            if($('#exen_6').val()!=''){
                exen+=parseInt($('#exen_6').val());
            }
            if($('#iva5_6').val()!=''){
                iva5+=parseInt($('#iva5_6').val());
            }
            if($('#iva10_6').val()!=''){
                iva10+=parseInt($('#iva10_6').val());
            }

            //linea7
            if($('#exen_7').val()!=''){
                exen+=parseInt($('#exen_7').val());
            }
            if($('#iva5_7').val()!=''){
                iva5+=parseInt($('#iva5_7').val());
            }
            if($('#iva10_7').val()!=''){
                iva10+=parseInt($('#iva10_7').val());
            }

            //linea8
            if($('#exen_8').val()!=''){
                exen+=parseInt($('#exen_8').val());
            }  
            if($('#iva5_8').val()!=''){
                iva5+=parseInt($('#iva5_8').val());
            }
            if($('#iva10_8').val()!=''){
                iva10+=parseInt($('#iva10_8').val());
            }          

            $('input[name=Com_StExe]').val(exen);
            $('input[name=Com_St5]').val(iva5);
            $('input[name=Com_St10]').val(iva10);            
            $('input[name=Com_Total]').val($('#oc_tot').val());

            $('#busqueda,#tabla_articulo input').val('');
            //opciones
            $('#busqueda,#art_cant,#detalle button').prop('disabled',true);
            // $('#detalle input, #detalle button').css('pointer-events','none');
        "></style>   
    @else <!-- si no existe -->
        <style onload="
            // cabecera
            $('input[name=Id_OC]').val('');
            $('#busca_prov').val('').prop('disabled',false);
            $('input[name=Id_Prov]').val('');
            $('#prov_ruc').val('');
            $('#prov_tel').val('');
            $('#prov_dir').val('');            
            // detalle
            $('#detalle input').val('');
            //totales
            $('#total input').val('');

            //opciones
            $('#busqueda,#art_cant,#detalle button').prop('disabled',false); 
            // $('#detalle input, #detalle button').css('pointer-events','auto');           
        "></style>                
    @endif
</ul>