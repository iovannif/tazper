window.addEventListener("load", function(){
    
    //Dia
    window.dia=0;

    function dia(){        
        if($('input[name=desc_des]').val()!=''){ //Si Día
            //determinar para:
            var desc_lp='';
            var desc_cli='';
            var desc_cat='';
            var desc_prod='';        
            
            //Si incluye a:
            //Lp            
            $('.desc_lp').each(function(){
                if($(this).val()==$('input[name=cli_lp]').val()){                    
                    desc_lp='si';
                        return false;
                }                                
            });              

            //Cliente
            $('.desc_cli').each(function(){
                if($(this).val()==$('input[name=Id_Cli]').val()){
                    desc_cli='si';
                        return false;
                }                                
            });            

            //Categoria                                
                var cat='';

                $('.desc_cat').each(function(){
                    if($(this).val()!=''){
                        cat='si';
                        return false;
                    }                                
                });                  

            if(cat!=''){
                $('.desc_cat').each(function(){
                    if($(this).val()==$('#categoria').val()){
                        desc_cat='si';
                            return false;
                    }                                
                });                                      
            }                                            

            //Producto                                
            $('.desc_art').each(function(){
                if($(this).val()==$('#id').val()){
                    desc_prod='si';
                        return false;
                }                                
            });                              

        //Aplicar
        if(desc_cli!='' || desc_lp!=''){
            if(desc_prod!='' || desc_cat!=''){
                window.dia=$('input[name=porc]').val();            
            }
        }

        }
    }    

        //totales
        var sub_exen=0;
        var sub_iva5=0;
        var sub_iva10=0;        

        function totales(){ //
            //Sub         

            //linea1
            if($('#exen_1').val()!=''){
                sub_exen=parseInt($('#exen_1').val());
            }else{
                sub_exen=0;
            }
            if($('#iva5_1').val()!=''){
                sub_iva5=parseInt($('#iva5_1').val());
            }else{
                sub_iva5=0;
            }
            if($('#iva10_1').val()!=''){
                sub_iva10=parseInt($('#iva10_1').val());
            }else{
                sub_iva10=0;
            }
            
            //linea2
            if($('#exen_2').val()!=''){
                sub_exen+=parseInt($('#exen_2').val());
            }
            if($('#iva5_2').val()!=''){
                sub_iva5+=parseInt($('#iva5_2').val());
            }
            if($('#iva10_2').val()!=''){
                sub_iva10+=parseInt($('#iva10_2').val());
            }

            //linea3
            if($('#exen_3').val()!=''){
                sub_exen+=parseInt($('#exen_3').val());
            }
            if($('#iva5_3').val()!=''){
                sub_iva5+=parseInt($('#iva5_3').val());
            }
            if($('#iva10_3').val()!=''){
                sub_iva10+=parseInt($('#iva10_3').val());
            }

            //linea4
            if($('#exen_4').val()!=''){
                sub_exen+=parseInt($('#exen_4').val());
            }
            if($('#iva5_4').val()!=''){
                sub_iva5+=parseInt($('#iva5_4').val());
            }
            if($('#iva10_4').val()!=''){
                sub_iva10+=parseInt($('#iva10_4').val());
            }

            //linea5
            if($('#exen_5').val()!=''){
                sub_exen+=parseInt($('#exen_5').val());
            }
            if($('#iva5_5').val()!=''){
                sub_iva5+=parseInt($('#iva5_5').val());
            }
            if($('#iva10_5').val()!=''){
                sub_iva10+=parseInt($('#iva10_5').val());
            }
            
            //linea6
            if($('#exen_6').val()!=''){
                sub_exen+=parseInt($('#exen_6').val());
            }
            if($('#iva5_6').val()!=''){
                sub_iva5+=parseInt($('#iva5_6').val());
            }
            if($('#iva10_6').val()!=''){
                sub_iva10+=parseInt($('#iva10_6').val());
            }

            //linea7
            if($('#exen_7').val()!=''){
                sub_exen+=parseInt($('#exen_7').val());
            }
            if($('#iva5_7').val()!=''){
                sub_iva5+=parseInt($('#iva5_7').val());
            }
            if($('#iva10_7').val()!=''){
                sub_iva10+=parseInt($('#iva10_7').val());
            }

            //linea8
            if($('#exen_8').val()!=''){
                sub_exen+=parseInt($('#exen_8').val());
            }  
            if($('#iva5_8').val()!=''){
                sub_iva5+=parseInt($('#iva5_8').val());
            }
            if($('#iva10_8').val()!=''){
                sub_iva10+=parseInt($('#iva10_8').val());
            } 

            $('input[name=Com_StExe]').val(sub_exen);
            $('input[name=Com_St5]').val(sub_iva5);
            $('input[name=Com_St10]').val(sub_iva10);                    
            
            //Total
            var compra_total=parseInt(sub_exen)+parseInt(sub_iva5)+parseInt(sub_iva10);

            $('input[name=Com_Total]').val(compra_total);

                // console.log('sub totales');
            
                $('#liq5').val(liq5);
                $('#liq10').val(liq10);
                $('#totiva').val(liq5+liq10);
        }    
            
    var liq5=0;
    var liq10=0;

    //Agregar
    $('#agregar').click(function(){ 
        event.preventDefault();

        if($('#art_des').val()!='' & $('#art_cant').val()!='' 
            & $('#art_cant').val()>0 & $('#art_cant').val()%1==0
            & Math.sign($('#art_cant').val())!=-1 & Math.sign($('#art_cant').val())!=-0
            ){           
            //si da el stock
            if(parseInt($('#art_st').val())>=parseInt($('#art_cant').val())){                      
                    //si no esta al limite no muestra aviso
                    if($('#des_art_8').val()!=''){ 
                        $('#aviso').html('&nbsp;');
                    }

                //si ya está en alguna linea
                if($('#art_des').val()==$('#des_art_1').val()){                        
                    var cantidad=parseInt($('#cant_art_1').val()); //float anda
                    cantidad=cantidad+parseInt($('#art_cant').val());
                    $('#cant_art_1').val(cantidad);        

                    if($('#cant_art_1').val()>=15){ //may
                        var may=10;
                        $('#may_1').val(may+'%');

                            //ant
                            if($('#impuesto').val()=='IVA 5%'){
                                liq5-=$('#iva5_1').val()*0.05-$('#cost_iva5_1').val()*0.05;
                                                                
                            }else if($('#impuesto').val()=='IVA 10%'){
                                liq10-=$('#iva10_1').val()*0.10-$('#cost_iva10_1').val()*0.10;                                
                            }            

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                                                
                        var descontar=$('#art_pre').val()*descuento;
                        var descontar=descontar/100;
                        var pre=$('#art_pre').val()-descontar;   
                        var importe=pre*$('#cant_art_1').val();    
                        $('#saldo_1').val(pre);               
                    }else{
                        var importe=$('#saldo_1').val()*$('#cant_art_1').val();
                    }  
                        var costo=$('#cost_1').val()*$('#cant_art_1').val();
                       
                    if($('#impuesto').val()=='Exentas'){
                        $('#exen_1').val(importe);
                        $('#cost_exen_1').val(costo);
                        
                    }else if($('#impuesto').val()=='IVA 5%'){
                        $('#iva5_1').val(importe);                
                        $('#cost_iva5_1').val(costo);

                        if($('#cant_art_1').val()>=15){
                            liq5+=$('#iva5_1').val()*0.05 - $('#cost_iva5_1').val()*0.05;
                                                    
                        }else{
                            var dif= $('#saldo_1').val()*0.05*$('#art_cant').val() - $('#cost_1').val()*0.05*$('#art_cant').val();                                                    
                            liq5+=dif;
                        }

                    }else if($('#impuesto').val()=='IVA 10%'){
                        $('#iva10_1').val(importe);
                        $('#cost_iva10_1').val(costo);
                                                                                                                        
                        if($('#cant_art_1').val()>=15){                                                        
                            //precio may
                            liq10+=$('#iva10_1').val()*0.10 - $('#cost_iva10_1').val()*0.10;                                                                                                                                                                                                    

                        }else{
                            var dif= $('#saldo_1').val()*0.10*$('#art_cant').val() - $('#cost_1').val()*0.10*$('#art_cant').val();                                                    
                            liq10+=dif;

                            // console.log(liq10);
                        }                        

                    }

                    $('#stock_1').val($('#art_st').val()-$('#art_cant').val());                      

                }else if($('#art_des').val()==$('#des_art_2').val()){
                    var cantidad=parseInt($('#cant_art_2').val());
                    cantidad=cantidad+parseInt($('#art_cant').val());
                    $('#cant_art_2').val(cantidad);
                    
                    if($('#cant_art_2').val()>=15){ //may
                        var may=10;
                        $('#may_2').val(may+'%');

                            //ant
                            if($('#impuesto').val()=='IVA 5%'){
                                liq5-=$('#iva5_2').val()*0.05-$('#cost_iva5_2').val()*0.05;
                                                                
                            }else if($('#impuesto').val()=='IVA 10%'){
                                liq10-=$('#iva10_2').val()*0.10-$('#cost_iva10_2').val()*0.10;                                
                            }

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                                                
                        var descontar=$('#art_pre').val()*descuento;
                        var descontar=descontar/100;
                        var pre=$('#art_pre').val()-descontar;   
                        var importe=pre*$('#cant_art_2').val();    
                        $('#saldo_2').val(pre);               
                    }else{
                        var importe=$('#saldo_2').val()*$('#cant_art_2').val();
                    }
                        var costo=$('#cost_2').val()*$('#cant_art_2').val();
                       
                    if($('#impuesto').val()=='Exentas'){
                        $('#exen_2').val(importe);
                        $('#cost_exen_2').val(costo);
                        
                    }else if($('#impuesto').val()=='IVA 5%'){
                        $('#iva5_2').val(importe);                
                        $('#cost_iva5_2').val(costo);

                        if($('#cant_art_2').val()>=15){
                            liq5+=$('#iva5_2').val()*0.05 - $('#cost_iva5_2').val()*0.05;
                                                    
                        }else{
                            var dif= $('#saldo_2').val()*0.05*$('#art_cant').val() - $('#cost_2').val()*0.05*$('#art_cant').val();                                                       
                            liq5+=dif;
                        }                            

                    }else if($('#impuesto').val()=='IVA 10%'){
                        $('#iva10_2').val(importe);
                        $('#cost_iva10_2').val(costo);

                        if($('#cant_art_2').val()>=15){                                                        
                            liq10+=$('#iva10_2').val()*0.10 - $('#cost_iva10_2').val()*0.10;                                                                                                                                                                                                    
                        }else{
                            var dif= $('#saldo_2').val()*0.10*$('#art_cant').val() - $('#cost_2').val()*0.10*$('#art_cant').val();                                                    
                            liq10+=dif;
                        }
                    }

                    $('#stock_2').val($('#art_st').val()-$('#art_cant').val());

                }else if($('#art_des').val()==$('#des_art_3').val()){
                    var cantidad=parseInt($('#cant_art_3').val());
                    cantidad=cantidad+parseInt($('#art_cant').val());
                    $('#cant_art_3').val(cantidad);
                    
                    if($('#cant_art_3').val()>=15){ //may
                        var may=10;
                        $('#may_3').val(may+'%');

                            // ant
                            if($('#impuesto').val()=='IVA 5%'){
                                liq5-=$('#iva5_3').val()*0.05-$('#cost_iva5_3').val()*0.05;
                                                                
                            }else if($('#impuesto').val()=='IVA 10%'){
                                liq10-=$('#iva10_3').val()*0.10-$('#cost_iva10_3').val()*0.10;                                
                            }

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                                                
                        var descontar=$('#art_pre').val()*descuento;
                        var descontar=descontar/100;
                        var pre=$('#art_pre').val()-descontar;   
                        var importe=pre*$('#cant_art_3').val();    
                        $('#saldo_3').val(pre);               
                    }else{
                        var importe=$('#saldo_3').val()*$('#cant_art_3').val();
                    }
                        var costo=$('#cost_3').val()*$('#cant_art_3').val();
                       
                    if($('#impuesto').val()=='Exentas'){
                        $('#exen_3').val(importe);
                        $('#cost_exen_3').val(costo);
                        
                    }else if($('#impuesto').val()=='IVA 5%'){
                        $('#iva5_3').val(importe);                
                        $('#cost_iva5_3').val(costo);                            
                         
                        if($('#cant_art_3').val()>=15){
                            liq5+=$('#iva5_3').val()*0.05 - $('#cost_iva5_3').val()*0.05;
                                                    
                        }else{
                            var dif= $('#saldo_3').val()*0.05*$('#art_cant').val() - $('#cost_3').val()*0.05*$('#art_cant').val();                                                    
                            liq5+=dif;
                        } 

                    }else if($('#impuesto').val()=='IVA 10%'){
                        $('#iva10_3').val(importe);
                        $('#cost_iva10_3').val(costo);

                        if($('#cant_art_3').val()>=15){                                                        
                            liq10+=$('#iva10_3').val()*0.10 - $('#cost_iva10_3').val()*0.10;                                                                                                                                                                                                    
                        }else{
                            var dif= $('#saldo_3').val()*0.10*$('#art_cant').val() - $('#cost_3').val()*0.10*$('#art_cant').val();                                                    
                            liq10+=dif;
                        }                                                    
                    }

                    $('#stock_3').val($('#art_st').val()-$('#art_cant').val());

                }else if($('#art_des').val()==$('#des_art_4').val()){
                    var cantidad=parseInt($('#cant_art_4').val());
                    cantidad=cantidad+parseInt($('#art_cant').val());
                    $('#cant_art_4').val(cantidad);
                    
                    if($('#cant_art_4').val()>=15){ //may
                        var may=10;
                        $('#may_4').val(may+'%');

                            //ant
                            if($('#impuesto').val()=='IVA 5%'){
                                liq5-=$('#iva5_4').val()*0.05-$('#cost_iva5_4').val()*0.05;
                                                                
                            }else if($('#impuesto').val()=='IVA 10%'){
                                liq10-=$('#iva10_4').val()*0.10-$('#cost_iva10_4').val()*0.10;                                
                            }

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                                                
                        var descontar=$('#art_pre').val()*descuento;
                        var descontar=descontar/100;
                        var pre=$('#art_pre').val()-descontar;   
                        var importe=pre*$('#cant_art_4').val();    
                        $('#saldo_4').val(pre);               
                    }else{
                        var importe=$('#saldo_4').val()*$('#cant_art_4').val();
                    }
                        var costo=$('#cost_4').val()*$('#cant_art_4').val();
                       
                    if($('#impuesto').val()=='Exentas'){
                        $('#exen_4').val(importe);
                        $('#cost_exen_4').val(costo);
                        
                    }else if($('#impuesto').val()=='IVA 5%'){
                        $('#iva5_4').val(importe);                
                        $('#cost_iva5_4').val(costo);                                                    

                        if($('#cant_art_4').val()>=15){
                            liq5+=$('#iva5_4').val()*0.05 - $('#cost_iva5_4').val()*0.05;
                                                    
                        }else{
                            var dif= $('#saldo_4').val()*0.05*$('#art_cant').val() - $('#cost_4').val()*0.05*$('#art_cant').val();                                                    
                            liq5+=dif;
                        } 

                    }else if($('#impuesto').val()=='IVA 10%'){
                        $('#iva10_4').val(importe);
                        $('#cost_iva10_4').val(costo);

                        if($('#cant_art_4').val()>=15){                                                        
                            liq10+=$('#iva10_4').val()*0.10 - $('#cost_iva10_4').val()*0.10;                                                                                                                                                                                                    
                        }else{
                            var dif= $('#saldo_4').val()*0.10*$('#art_cant').val() - $('#cost_4').val()*0.10*$('#art_cant').val();                                                    
                            liq10+=dif;
                        }                             
                    }

                    $('#stock_4').val($('#art_st').val()-$('#art_cant').val());

                }else if($('#art_des').val()==$('#des_art_5').val()){
                    var cantidad=parseInt($('#cant_art_5').val());
                    cantidad=cantidad+parseInt($('#art_cant').val());
                    $('#cant_art_5').val(cantidad);
                    
                    if($('#cant_art_5').val()>=15){ //may
                        var may=10;
                        $('#may_5').val(may+'%');

                            //ant
                            if($('#impuesto').val()=='IVA 5%'){
                                liq5-=$('#iva5_5').val()*0.05-$('#cost_iva5_5').val()*0.05;
                                                                
                            }else if($('#impuesto').val()=='IVA 10%'){
                                liq10-=$('#iva10_5').val()*0.10-$('#cost_iva10_5').val()*0.10;                                
                            }

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                                                
                        var descontar=$('#art_pre').val()*descuento;
                        var descontar=descontar/100;
                        var pre=$('#art_pre').val()-descontar;   
                        var importe=pre*$('#cant_art_5').val();    
                        $('#saldo_5').val(pre);               
                    }else{
                        var importe=$('#saldo_5').val()*$('#cant_art_5').val();
                    }
                        var costo=$('#cost_5').val()*$('#cant_art_5').val();
                       
                    if($('#impuesto').val()=='Exentas'){
                        $('#exen_5').val(importe);
                        $('#cost_exen_5').val(costo);
                        
                    }else if($('#impuesto').val()=='IVA 5%'){
                        $('#iva5_5').val(importe);                
                        $('#cost_iva5_5').val(costo);

                        if($('#cant_art_5').val()>=15){
                            liq5+=$('#iva5_5').val()*0.05 - $('#cost_iva5_5').val()*0.05;
                                                    
                        }else{
                            var dif= $('#saldo_5').val()*0.05*$('#art_cant').val() - $('#cost_5').val()*0.05*$('#art_cant').val();                                                    
                            liq5+=dif;
                        }                             

                    }else if($('#impuesto').val()=='IVA 10%'){
                        $('#iva10_5').val(importe);
                        $('#cost_iva10_5').val(costo);

                        if($('#cant_art_5').val()>=15){                                                        
                            liq10+=$('#iva10_5').val()*0.10 - $('#cost_iva10_5').val()*0.10;                                                                                                                                                                                                    
                        }else{
                            var dif= $('#saldo_5').val()*0.10*$('#art_cant').val() - $('#cost_5').val()*0.10*$('#art_cant').val();                                                    
                            liq10+=dif;
                        }                            
                    }

                    $('#stock_5').val($('#art_st').val()-$('#art_cant').val());

                }else if($('#art_des').val()==$('#des_art_6').val()){
                    var cantidad=parseInt($('#cant_art_6').val());
                    cantidad=cantidad+parseInt($('#art_cant').val());
                    $('#cant_art_6').val(cantidad);
                    
                    if($('#cant_art_6').val()>=15){ //may
                        var may=10;
                        $('#may_6').val(may+'%');
                        
                            //ant
                            if($('#impuesto').val()=='IVA 5%'){
                                liq5-=$('#iva5_6').val()*0.05-$('#cost_iva5_6').val()*0.05;
                                                                
                            }else if($('#impuesto').val()=='IVA 10%'){
                                liq10-=$('#iva10_6').val()*0.10-$('#cost_iva10_6').val()*0.10;                                
                            }

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                                                
                        var descontar=$('#art_pre').val()*descuento;
                        var descontar=descontar/100;
                        var pre=$('#art_pre').val()-descontar;   
                        var importe=pre*$('#cant_art_6').val();    
                        $('#saldo_6').val(pre);               
                    }else{
                        var importe=$('#saldo_6').val()*$('#cant_art_6').val();
                    }
                        var costo=$('#cost_6').val()*$('#cant_art_6').val();
                       
                    if($('#impuesto').val()=='Exentas'){
                        $('#exen_6').val(importe);
                        $('#cost_exen_6').val(costo);
                        
                    }else if($('#impuesto').val()=='IVA 5%'){
                        $('#iva5_6').val(importe);                
                        $('#cost_iva5_6').val(costo);

                        if($('#cant_art_6').val()>=15){
                            liq5+=$('#iva5_6').val()*0.05 - $('#cost_iva5_6').val()*0.05;
                                                    
                        }else{
                            var dif= $('#saldo_6').val()*0.05*$('#art_cant').val() - $('#cost_6').val()*0.05*$('#art_cant').val();                                                    
                            liq5+=dif;
                        }                        

                    }else if($('#impuesto').val()=='IVA 10%'){
                        $('#iva10_6').val(importe);
                        $('#cost_iva10_6').val(costo);

                        if($('#cant_art_6').val()>=15){                                                        
                            liq10+=$('#iva10_6').val()*0.10 - $('#cost_iva10_6').val()*0.10;                                                                                                                                                                                                    
                        }else{
                            var dif= $('#saldo_6').val()*0.10*$('#art_cant').val() - $('#cost_6').val()*0.10*$('#art_cant').val();                                                    
                            liq10+=dif;
                        }                         
                    }

                    $('#stock_6').val($('#art_st').val()-$('#art_cant').val());

                }else if($('#art_des').val()==$('#des_art_7').val()){
                    var cantidad=parseInt($('#cant_art_7').val());
                    cantidad=cantidad+parseInt($('#art_cant').val());
                    $('#cant_art_7').val(cantidad);
                    
                    if($('#cant_art_7').val()>=15){ //may
                        var may=10;
                        $('#may_7').val(may+'%');

                            //ant
                            if($('#impuesto').val()=='IVA 5%'){
                                liq5-=$('#iva5_7').val()*0.05-$('#cost_iva5_7').val()*0.05;
                                                                
                            }else if($('#impuesto').val()=='IVA 10%'){
                                liq10-=$('#iva10_7').val()*0.10-$('#cost_iva10_7').val()*0.10;                                
                            }

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                                                
                        var descontar=$('#art_pre').val()*descuento;
                        var descontar=descontar/100;
                        var pre=$('#art_pre').val()-descontar;   
                        var importe=pre*$('#cant_art_7').val();    
                        $('#saldo_7').val(pre);               
                    }else{
                        var importe=$('#saldo_7').val()*$('#cant_art_7').val();
                    }
                        var costo=$('#cost_7').val()*$('#cant_art_7').val();
                       
                    if($('#impuesto').val()=='Exentas'){
                        $('#exen_7').val(importe);
                        $('#cost_exen_7').val(costo);
                        
                    }else if($('#impuesto').val()=='IVA 5%'){
                        $('#iva5_7').val(importe);                
                        $('#cost_iva5_7').val(costo);

                        if($('#cant_art_7').val()>=15){
                            liq5+=$('#iva5_7').val()*0.05 - $('#cost_iva5_7').val()*0.05;
                                                    
                        }else{
                            var dif= $('#saldo_7').val()*0.05*$('#art_cant').val() - $('#cost_7').val()*0.05*$('#art_cant').val();                                                    
                            liq5+=dif;
                        }                            

                    }else if($('#impuesto').val()=='IVA 10%'){
                        $('#iva10_7').val(importe);
                        $('#cost_iva10_7').val(costo);

                        if($('#cant_art_7').val()>=15){                                                        
                            liq10+=$('#iva10_7').val()*0.10 - $('#cost_iva10_7').val()*0.10;                                                                                                                                                                                                    
                        }else{
                            var dif= $('#saldo_7').val()*0.10*$('#art_cant').val() - $('#cost_7').val()*0.10*$('#art_cant').val();                                                    
                            liq10+=dif;
                        }                            
                    }

                    $('#stock_7').val($('#art_st').val()-$('#art_cant').val());

                }else if($('#art_des').val()==$('#des_art_8').val()){
                    var cantidad=parseInt($('#cant_art_8').val());
                    cantidad=cantidad+parseInt($('#art_cant').val());
                    $('#cant_art_8').val(cantidad);
                    
                    if($('#cant_art_8').val()>=15){ //may
                        var may=10;
                        $('#may_8').val(may+'%');

                            //ant
                            if($('#impuesto').val()=='IVA 5%'){
                                liq5-=$('#iva5_8').val()*0.05-$('#cost_iva5_8').val()*0.05;
                                                                
                            }else if($('#impuesto').val()=='IVA 10%'){
                                liq10-=$('#iva10_8').val()*0.10-$('#cost_iva10_8').val()*0.10;                                
                            }

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                                                
                        var descontar=$('#art_pre').val()*descuento;
                        var descontar=descontar/100;
                        var pre=$('#art_pre').val()-descontar;   
                        var importe=pre*$('#cant_art_8').val();    
                        $('#saldo_8').val(pre);               
                    }else{
                        var importe=$('#saldo_8').val()*$('#cant_art_8').val();
                    }
                        var costo=$('#cost_8').val()*$('#cant_art_8').val();
                       
                    if($('#impuesto').val()=='Exentas'){
                        $('#exen_8').val(importe);
                        $('#cost_exen_8').val(costo);
                        
                    }else if($('#impuesto').val()=='IVA 5%'){
                        $('#iva5_8').val(importe);                
                        $('#cost_iva5_8').val(costo);

                        if($('#cant_art_8').val()>=15){
                            liq5+=$('#iva5_8').val()*0.05 - $('#cost_iva5_8').val()*0.05;
                                                    
                        }else{
                            var dif= $('#saldo_8').val()*0.05*$('#art_cant').val() - $('#cost_8').val()*0.05*$('#art_cant').val();                                                    
                            liq5+=dif;
                        }                         

                    }else if($('#impuesto').val()=='IVA 10%'){
                        $('#iva10_8').val(importe);
                        $('#cost_iva10_8').val(costo);

                        if($('#cant_art_8').val()>=15){                                                        
                            liq10+=$('#iva10_8').val()*0.10 - $('#cost_iva10_8').val()*0.10;                                                                                                                                                                                                    
                        }else{
                            var dif= $('#saldo_8').val()*0.10*$('#art_cant').val() - $('#cost_8').val()*0.10*$('#art_cant').val();                                                    
                            liq10+=dif;
                        }                                                
                    }

                    $('#stock_8').val($('#art_st').val()-$('#art_cant').val());
                    
                }else{
                    //si no está, agrega nueva linea en vacias                                        
                    if($('#des_art_1').val()==''){
                        $('#art_id_1').val($('#id_art').val());           
                        $('#des_art_1').val($('#art_des').val());   
                        $('#cat_1').val($('#art_cat').val());   
                        $('#pre_1').val($('#art_pre').val());   
                        $('#cost_1').val($('#art_cost').val());   
                        $('#cant_art_1').val($('#art_cant').val());  
                        $('#stock_1').val($('#art_st').val()-$('#art_cant').val());   
                        
                            dia();                            
                        
                        if($('#cant_art_1').val()>=15){ //may
                            var may=10;
                        }else{
                            var may=0;
                        }                                                     

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                        
                        if(descuento>0){
                            var descontar=$('#art_pre').val()*descuento;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        var pre=$('#art_pre').val()-descontar; //saldo

                            if(window.clie>0){
                                $('#lp_1').val(window.clie+'%');
                            }

                            if(may>0){
                                $('#may_1').val(may+'%');
                            }

                            if(window.dia>0){
                                $('#dia_1').val(window.dia+'%');
                            }                            

                            $('#saldo_1').val(pre);

                        var importe=pre*$('#cant_art_1').val();
                        var costo=$('#cost_1').val()*$('#cant_art_1').val();
                        
                        if($('#impuesto').val()=='Exentas'){
                            $('#exen_1').val(importe);
                            $('#cost_exen_1').val(costo);

                        }else if($('#impuesto').val()=='IVA 5%'){
                            $('#iva5_1').val(importe);                
                            $('#cost_iva5_1').val(costo);
                            ///liq
                                    //vent                      //com
                            liq5= $('#iva5_1').val()*0.05 - $('#cost_iva5_1').val()*0.05;
                            // console.log(liq5); 

                        }else if($('#impuesto').val()=='IVA 10%'){
                            $('#iva10_1').val(importe);
                            $('#cost_iva10_1').val(costo);
                                
                            //liq
                                    //vent                      //com
                            liq10= $('#iva10_1').val()*0.10 - $('#cost_iva10_1').val()*0.10;
                            // console.log(liq10);                                                                                          
                        }

                    }else if($('#des_art_2').val()==''){ //si esta ocupada, en la siguiente
                        $('#art_id_2').val($('#id_art').val());           
                        $('#des_art_2').val($('#art_des').val());
                        $('#cat_2').val($('#art_cat').val());
                        $('#pre_2').val($('#art_pre').val());
                        $('#cost_2').val($('#art_cost').val());                                     
                        $('#cant_art_2').val($('#art_cant').val());   
                        $('#stock_2').val($('#art_st').val()-$('#art_cant').val());  

                            dia();                            
                        
                        if($('#cant_art_2').val()>=15){ //may
                            var may=10;
                        }else{
                            var may=0;
                        }                                                       

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                        
                        if(descuento>0){
                            var descontar=$('#art_pre').val()*descuento;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        var pre=$('#art_pre').val()-descontar; //saldo

                            if(window.clie>0){
                                $('#lp_2').val(window.clie+'%');
                            }

                            if(may>0){
                                $('#may_2').val(may+'%');
                            }

                            if(window.dia>0){
                                $('#dia_2').val(window.dia+'%');
                            }                            

                            $('#saldo_2').val(pre);

                        var importe=pre*$('#cant_art_2').val(); 
                        var costo=$('#cost_2').val()*$('#cant_art_2').val();

                        if($('#impuesto').val()=='Exentas'){
                            $('#exen_2').val(importe);
                            $('#cost_exen_2').val(costo);
                            
                        }else if($('#impuesto').val()=='IVA 5%'){
                            $('#iva5_2').val(importe);           
                            $('#cost_iva5_2').val(costo);

                            liq5+= $('#iva5_2').val()*0.05 - $('#cost_iva5_2').val()*0.05;
                            // console.log(liq5);

                        }else if($('#impuesto').val()=='IVA 10%'){
                            $('#iva10_2').val(importe);
                            $('#cost_iva10_2').val(costo);

                            liq10+= $('#iva10_2').val()*0.10 - $('#cost_iva10_2').val()*0.10;
                            // console.log(liq10);
                        }

                    }else if($('#des_art_3').val()==''){
                        $('#art_id_3').val($('#id_art').val());           
                        $('#des_art_3').val($('#art_des').val());                                  
                        $('#cat_3').val($('#art_cat').val());                                  
                        $('#pre_3').val($('#art_pre').val());
                        $('#cost_3').val($('#art_cost').val());   
                        $('#cant_art_3').val($('#art_cant').val());           
                        $('#stock_3').val($('#art_st').val()-$('#art_cant').val()); 
                        
                            dia();                                                        
                        
                        if($('#cant_art_3').val()>=15){ //may
                            var may=10;
                        }else{
                            var may=0;
                        }                                                       

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                        
                        if(descuento>0){
                            var descontar=$('#art_pre').val()*descuento;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        var pre=$('#art_pre').val()-descontar; //saldo

                            if(window.clie>0){
                                $('#lp_3').val(window.clie+'%');
                            }

                            if(may>0){
                                $('#may_3').val(may+'%');
                            }

                            if(window.dia>0){
                                $('#dia_3').val(window.dia+'%');
                            }                            

                            $('#saldo_3').val(pre);

                        var importe=pre*$('#cant_art_3').val(); 
                        var costo=$('#cost_3').val()*$('#cant_art_3').val();

                        if($('#impuesto').val()=='Exentas'){
                            $('#exen_3').val(importe);
                            $('#cost_exen_3').val(costo);
                            
                        }else if($('#impuesto').val()=='IVA 5%'){
                            $('#iva5_3').val(importe);           
                            $('#cost_iva5_3').val(costo);

                            liq5+= $('#iva5_3').val()*0.05 - $('#cost_iva5_3').val()*0.05;
                            // console.log(liq5);

                        }else if($('#impuesto').val()=='IVA 10%'){
                            $('#iva10_3').val(importe);
                            $('#cost_iva10_3').val(costo);
                            
                            liq10+= $('#iva10_3').val()*0.10 - $('#cost_iva10_3').val()*0.10;
                            // console.log(liq10);
                        }

                    }else if($('#des_art_4').val()==''){
                        $('#art_id_4').val($('#id_art').val());           
                        $('#des_art_4').val($('#art_des').val());                                  
                        $('#cat_4').val($('#art_cat').val());                                  
                        $('#pre_4').val($('#art_pre').val());
                        $('#cost_4').val($('#art_cost').val());   
                        $('#cant_art_4').val($('#art_cant').val());           
                        $('#stock_4').val($('#art_st').val()-$('#art_cant').val());  
                        
                            dia();                                                            

                        if($('#cant_art_4').val()>=15){ //may
                            var may=10;
                        }else{
                            var may=0;
                        }                                                       

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                        
                        if(descuento>0){
                            var descontar=$('#art_pre').val()*descuento;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        var pre=$('#art_pre').val()-descontar; //saldo

                            if(window.clie>0){
                                $('#lp_4').val(window.clie+'%');
                            }

                            if(may>0){
                                $('#may_4').val(may+'%');
                            }

                            if(window.dia>0){
                                $('#dia_4').val(window.dia+'%');
                            }                            

                            $('#saldo_4').val(pre);

                        var importe=pre*$('#cant_art_4').val(); 
                        var costo=$('#cost_4').val()*$('#cant_art_4').val();

                        if($('#impuesto').val()=='Exentas'){
                            $('#exen_4').val(importe);
                            $('#cost_exen_4').val(costo);
                            
                        }else if($('#impuesto').val()=='IVA 5%'){
                            $('#iva5_4').val(importe);           
                            $('#cost_iva5_4').val(costo);

                            liq5+= $('#iva5_4').val()*0.05 - $('#cost_iva5_4').val()*0.05;
                            // console.log(liq5);

                        }else if($('#impuesto').val()=='IVA 10%'){
                            $('#iva10_4').val(importe);
                            $('#cost_iva10_4').val(costo);
                            
                            liq10+= $('#iva10_4').val()*0.10 - $('#cost_iva10_4').val()*0.10;
                            // console.log(liq10);
                        }

                    }else if($('#des_art_5').val()==''){
                        $('#art_id_5').val($('#id_art').val());           
                        $('#des_art_5').val($('#art_des').val());                                  
                        $('#cat_5').val($('#art_cat').val());                                  
                        $('#pre_5').val($('#art_pre').val());
                        $('#cost_5').val($('#art_cost').val());   
                        $('#cant_art_5').val($('#art_cant').val());        
                        $('#stock_5').val($('#art_st').val()-$('#art_cant').val());  

                            dia();                                                        
                        
                        if($('#cant_art_5').val()>=15){ //may
                            var may=10;
                        }else{
                            var may=0;
                        }                                                       

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                        
                        if(descuento>0){
                            var descontar=$('#art_pre').val()*descuento;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        var pre=$('#art_pre').val()-descontar; //saldo

                            if(window.clie>0){
                                $('#lp_5').val(window.clie+'%');
                            }

                            if(may>0){
                                $('#may_5').val(may+'%');
                            }

                            if(window.dia>0){
                                $('#dia_5').val(window.dia+'%');
                            }                            

                            $('#saldo_5').val(pre);

                        var importe=pre*$('#cant_art_5').val(); 
                        var costo=$('#cost_5').val()*$('#cant_art_5').val();

                        if($('#impuesto').val()=='Exentas'){
                            $('#exen_5').val(importe);
                            $('#cost_exen_5').val(costo);
                            
                        }else if($('#impuesto').val()=='IVA 5%'){
                            $('#iva5_5').val(importe);           
                            $('#cost_iva5_5').val(costo);

                            liq5+= $('#iva5_5').val()*0.05 - $('#cost_iva5_5').val()*0.05;
                            // console.log(liq5);

                        }else if($('#impuesto').val()=='IVA 10%'){
                            $('#iva10_5').val(importe);
                            $('#cost_iva10_5').val(costo);

                            liq10+= $('#iva10_5').val()*0.10 - $('#cost_iva10_5').val()*0.10;
                            // console.log(liq10);
                        }

                    }else if($('#des_art_6').val()==''){
                        $('#art_id_6').val($('#id_art').val());           
                        $('#des_art_6').val($('#art_des').val());    
                        $('#cat_6').val($('#art_cat').val());    
                        $('#pre_6').val($('#art_pre').val());
                        $('#cost_6').val($('#art_cost').val());   
                        $('#cant_art_6').val($('#art_cant').val());
                        $('#stock_6').val($('#art_st').val()-$('#art_cant').val());  

                            dia();                                                            
                        
                        if($('#cant_art_6').val()>=15){ //may
                            var may=10;
                        }else{
                            var may=0;
                        }                                                       

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                        
                        if(descuento>0){
                            var descontar=$('#art_pre').val()*descuento;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        var pre=$('#art_pre').val()-descontar; //saldo

                            if(window.clie>0){
                                $('#lp_6').val(window.clie+'%');
                            }

                            if(may>0){
                                $('#may_6').val(may+'%');
                            }

                            if(window.dia>0){
                                $('#dia_6').val(window.dia+'%');
                            }                            

                            $('#saldo_6').val(pre);

                        var importe=pre*$('#cant_art_6').val(); 
                        var costo=$('#cost_6').val()*$('#cant_art_6').val();

                        if($('#impuesto').val()=='Exentas'){
                            $('#exen_6').val(importe);
                            $('#cost_exen_6').val(costo);
                            
                        }else if($('#impuesto').val()=='IVA 5%'){
                            $('#iva5_6').val(importe);           
                            $('#cost_iva5_6').val(costo);

                            liq5+= $('#iva5_6').val()*0.05 - $('#cost_iva5_6').val()*0.05;
                            // console.log(liq5);

                        }else if($('#impuesto').val()=='IVA 10%'){
                            $('#iva10_6').val(importe);
                            $('#cost_iva10_6').val(costo);

                            liq10+= $('#iva10_6').val()*0.10 - $('#cost_iva10_6').val()*0.10;
                            // console.log(liq10);
                        }

                    }else if($('#des_art_7').val()==''){
                        $('#art_id_7').val($('#id_art').val());           
                        $('#des_art_7').val($('#art_des').val());    
                        $('#cat_7').val($('#art_cat').val());    
                        $('#pre_7').val($('#art_pre').val());
                        $('#cost_7').val($('#art_cost').val());                                 
                        $('#cant_art_7').val($('#art_cant').val());
                        $('#stock_7').val($('#art_st').val()-$('#art_cant').val());  

                            dia();                                                            
                        
                        if($('#cant_art_7').val()>=15){ //may
                            var may=10;
                        }else{
                            var may=0;
                        }                                                       

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                        
                        if(descuento>0){
                            var descontar=$('#art_pre').val()*descuento;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        var pre=$('#art_pre').val()-descontar; //saldo

                            if(window.clie>0){
                                $('#lp_7').val(window.clie+'%');
                            }

                            if(may>0){
                                $('#may_7').val(may+'%');
                            }

                            if(window.dia>0){
                                $('#dia_7').val(window.dia+'%');
                            }                            

                            $('#saldo_7').val(pre);

                        var importe=pre*$('#cant_art_7').val(); 
                        var costo=$('#cost_7').val()*$('#cant_art_7').val();

                        if($('#impuesto').val()=='Exentas'){
                            $('#exen_7').val(importe);
                            $('#cost_exen_7').val(costo);
                            
                        }else if($('#impuesto').val()=='IVA 5%'){
                            $('#iva5_7').val(importe);           
                            $('#cost_iva5_7').val(costo);

                            liq5+= $('#iva5_7').val()*0.05 - $('#cost_iva5_7').val()*0.05;
                            // console.log(liq5);

                        }else if($('#impuesto').val()=='IVA 10%'){
                            $('#iva10_7').val(importe);
                            $('#cost_iva10_7').val(costo);

                            liq10+= $('#iva10_7').val()*0.10 - $('#cost_iva10_7').val()*0.10;
                            // console.log(liq10);
                        }

                    }else if($('#des_art_8').val()==''){
                        $('#art_id_8').val($('#id_art').val());           
                        $('#des_art_8').val($('#art_des').val()); 
                        $('#cat_8').val($('#art_cat').val()); 
                        $('#pre_8').val($('#art_pre').val());
                        $('#cost_8').val($('#art_cost').val());                                    
                        $('#cant_art_8').val($('#art_cant').val());
                        $('#stock_8').val($('#art_st').val()-$('#art_cant').val());  

                            dia();                                                            
                        
                        if($('#cant_art_8').val()>=15){ //may
                            var may=10;
                        }else{
                            var may=0;
                        }                                                       

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                        
                        if(descuento>0){
                            var descontar=$('#art_pre').val()*descuento;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        var pre=$('#art_pre').val()-descontar; //saldo

                            if(window.clie>0){
                                $('#lp_8').val(window.clie+'%');
                            }

                            if(may>0){
                                $('#may_8').val(may+'%');
                            }

                            if(window.dia>0){
                                $('#dia_8').val(window.dia+'%');
                            }                            

                            $('#saldo_8').val(pre);

                        var importe=pre*$('#cant_art_8').val(); 
                        var costo=$('#cost_8').val()*$('#cant_art_8').val();

                        if($('#impuesto').val()=='Exentas'){
                            $('#exen_8').val(importe);
                            $('#cost_exen_8').val(costo);
                            
                        }else if($('#impuesto').val()=='IVA 5%'){
                            $('#iva5_8').val(importe);           
                            $('#cost_iva5_8').val(costo);

                            liq5+= $('#iva5_8').val()*0.05 - $('#cost_iva5_8').val()*0.05;
                            // console.log(liq5);

                        }else if($('#impuesto').val()=='IVA 10%'){
                            $('#iva10_8').val(importe);
                            $('#cost_iva10_8').val(costo);

                            liq10+= $('#iva10_8').val()*0.10 - $('#cost_iva10_8').val()*0.10;
                            // console.log(liq10);
                        }
                        
                    }else{ //si todas las lineas estan ocupadas                        
                        $('#aviso').html('Ha llegado al límite de ítems');                        
                    }                                                
                }

                if($('#des_art_1').val()!=''){//Solo cuando se agrega, error no
                    if($('#aviso').text()!='Ha llegado al límite de ítems'){ //limpia
                        $('#busca_material').prop('disabled',false).val('').focus();
                        $('.cambiar').css('display','none');   
                        $('#tabla_articulo input').val(''); 
                    }                      

                    if($('#art_id_8').val()==''){
                        $('#aviso').html('&nbsp;');
                    }
        
                    //Totales            
                    totales();
        
                    $('#busqueda').focus(); //siguiente
                }    
            
            }else{ //excede stock
                $('#aviso').html('Excede stock');
            }
            
        }        

        if($('#art_des').val()!='' & $('#art_cant').val()==''){
            $('#art_cant').focus();
        }
    });

    // Mas
    $('.mas').click(function(){ //STOCK
        event.preventDefault();  

        if($('.linea:hover .cant').val()!='' && $('.linea:hover .cant')!=9999){                                                       
            if($('.linea:hover .stock').val()>0){                

                    //cambia a may 
                    if($('.linea:hover .cant').val()==14){
                        //ant                    
                        if($('.linea:hover .iva_5').val()!=''){
                            liq5-= $('.linea:hover .iva_5').val()*0.05-$('.linea:hover .cost_iva_5').val()*0.05;

                        }else if($('.linea:hover .iva10').val()!=''){
                            liq10-= $('.linea:hover .iva10').val()*0.10-$('.linea:hover .cost_iva10').val()*0.10;
                                                        
                        }                        
                    }

                // cant                                                               
                var cant=parseInt($('.linea:hover .cant').val())+parseInt(1);  
                $('.linea:hover .cant').val(cant);

                    //may //cambia el saldo base
                    if(cant>=15){
                        var may=10;
                        $('.linea:hover .may').val(may+'%');   
                                                
                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                                                
                        var descontar=$('.linea:hover .precio').val()*descuento;
                        var descontar=descontar/100;
                        var pre=$('.linea:hover .precio').val()-descontar; //saldo nuevo   
                        var importe=pre*cant;  

                        $('.linea:hover .saldo').val(pre);  

                        if($('.linea:hover .exentas').val()!=''){
                            $('.linea:hover .exentas').val(importe);
                        }
        
                        if($('.linea:hover .iva_5').val()!=''){
                            $('.linea:hover .iva_5').val(importe);
                        }
        
                        if($('.linea:hover .iva10').val()!=''){
                            $('.linea:hover .iva10').val(importe);
                        }
                    }else{
                        // importe 
                        var precio=parseInt($('.linea:hover .saldo').val());                       

                        if($('.linea:hover .exentas').val()!=''){
                            var importe=parseInt($('.linea:hover .exentas').val());
                            $('.linea:hover .exentas').val(importe+precio);
                        }
        
                        if($('.linea:hover .iva_5').val()!=''){
                            var importe=parseInt($('.linea:hover .iva_5').val());
                            $('.linea:hover .iva_5').val(importe+precio);
                        }
        
                        if($('.linea:hover .iva10').val()!=''){
                            var importe=parseInt($('.linea:hover .iva10').val());
                            $('.linea:hover .iva10').val(importe+precio);
                        } 
                    }                
                    
                    var costo=$('.linea:hover .cant').val()*$('.linea:hover .costo').val();

                    if($('.linea:hover .exentas').val()!=''){
                        $('.linea:hover .cost_exentas').val(costo);                        
                    }
    
                    if($('.linea:hover .iva_5').val()!=''){
                        $('.linea:hover .cost_iva_5').val(costo);                        

                        // liq5+=$('.linea:hover .saldo').val()*0.05-$('.linea:hover .costo').val()*0.05;

                        if(cant==15){                            
                            liq5+=$('.linea:hover .iva_5').val()*0.05 - $('.linea:hover .cost_iva_5').val()*0.05;                            

                        }else{
                            liq5+=$('.linea:hover .saldo').val()*0.05-$('.linea:hover .costo').val()*0.05;
                        }  
                    }
    
                    if($('.linea:hover .iva10').val()!=''){
                        $('.linea:hover .cost_iva10').val(costo);

                            // $('.linea:hover .cost_iva10').prop('type','text');                        
                            // $('.linea:hover .cost_iva_10').val()                                                                                                                            
                                                                                    
                        if(cant==15){                            
                            liq10+=$('.linea:hover .iva10').val()*0.10 - $('.linea:hover .cost_iva10').val()*0.10;                            

                        }else{
                            liq10+=$('.linea:hover .saldo').val()*0.10-$('.linea:hover .costo').val()*0.10;
                            // console.log(liq10);                                
                        }   
                    }
                
                $('.linea:hover .stock').val($('.linea:hover .stock').val()-1);                

                //Totales            
                totales();
            }else{
                $('#aviso').html('Excede stock');
            }
        }                
    });

    // Menos   
    $('.menos').click(function(){ //STOCK
        event.preventDefault();  
        
        if($('.linea:hover .cant').val()!=''){                                               
            if($('.linea:hover .cant').val()!=1){

                    //baja de 15 //cambia de may
                    if($('.linea:hover .cant').val()==15){

                        if($('.linea:hover .iva_5').val()!=''){
                            liq5-= $('.linea:hover .iva_5').val()*0.05-$('.linea:hover .cost_iva_5').val()*0.05;

                        }else if($('.linea:hover .iva10').val()!=''){
                            liq10-= $('.linea:hover .iva10').val()*0.10-$('.linea:hover .cost_iva10').val()*0.10;
                                                        
                        }    
                    }

                // cant
                var cant=parseInt($('.linea:hover .cant').val())-parseInt(1);       
                $('.linea:hover .cant').val(cant);       

                    //may
                    if(cant<15){
                        $('.linea:hover .may').val('');
                        var may=0;

                        var descuento=parseInt(window.dia)+parseInt(window.clie)+parseInt(may); //desc                                                
                        var descontar=$('.linea:hover .precio').val()*descuento;
                        var descontar=descontar/100;
                        var pre=$('.linea:hover .precio').val()-descontar; //saldo nuevo   
                        var importe=pre*cant;  

                        $('.linea:hover .saldo').val(pre);  

                        if($('.linea:hover .exentas').val()!=''){
                            $('.linea:hover .exentas').val(importe);
                        }
        
                        if($('.linea:hover .iva_5').val()!=''){
                            $('.linea:hover .iva_5').val(importe);
                        }
        
                        if($('.linea:hover .iva10').val()!=''){
                            $('.linea:hover .iva10').val(importe);
                        }
                    }else{
                        // importe 
                        var precio=parseInt($('.linea:hover .saldo').val());

                        if($('.linea:hover .exentas').val()!=''){
                            var importe=parseInt($('.linea:hover .exentas').val());
                            $('.linea:hover .exentas').val(importe-precio);
                        }
        
                        if($('.linea:hover .iva_5').val()!=''){
                            var importe=parseInt($('.linea:hover .iva_5').val());
                            $('.linea:hover .iva_5').val(importe-precio);
                        }
        
                        if($('.linea:hover .iva10').val()!=''){
                            var importe=parseInt($('.linea:hover .iva10').val());
                            $('.linea:hover .iva10').val(importe-precio);
                        } 
                    }  
                    
                    var costo=$('.linea:hover .cant').val()*$('.linea:hover .costo').val();

                    if($('.linea:hover .exentas').val()!=''){
                        $('.linea:hover .cost_exentas').val(costo);
                    }
    
                    if($('.linea:hover .iva_5').val()!=''){
                        $('.linea:hover .cost_iva_5').val(costo);

                        if(cant+1==15){
                            liq5-=$('.linea:hover .iva_5').val()*0.05 - $('.linea:hover .cost_iva_5').val()*0.05;                            

                        }else{
                            liq5-=$('.linea:hover .saldo').val()*0.05-$('.linea:hover .costo').val()*0.05;
                            // console.log(liq5);
                        }                                                                                                
                    }
    
                    if($('.linea:hover .iva10').val()!=''){
                        $('.linea:hover .cost_iva10').val(costo);                        

                        if(cant+1==15){                            
                            liq10+=$('.linea:hover .iva10').val()*0.10 - $('.linea:hover .cost_iva10').val()*0.10;                            

                        }else{
                            liq10-=$('.linea:hover .saldo').val()*0.10-$('.linea:hover .costo').val()*0.10;
                            // console.log(liq10);                                
                        }                            
                    }

                $('.linea:hover .stock').val(parseInt($('.linea:hover .stock').val())+1);

                if($('.linea:hover .stock').val()>0){
                    $('#aviso').html('&nbsp;');
                }

                //Totales            
                totales();
            }                                                                                                          
        }        
    });

    //Quitar
    $('.quitar').click(function(){
        event.preventDefault();                    
            
            if($('.linea:hover .iva_5').val()!=null){ //'' undefined                
                var dif=$('.linea:hover .iva_5').val()*0.05 - $('.linea:hover .cost_iva_5').val()*0.05                
                liq5-=dif;
                
                // console.log(liq5);
            }

            if($('.linea:hover .iva10').val()!=''){                
                var dif=$('.linea:hover .iva10').val()*0.10 - $('.linea:hover .cost_iva10').val()*0.10                
                liq10-=dif;

                // console.log(liq10);                                                                       
            }                          

        
        $('.linea:hover input').val('');  

        //vacia y la linea siguiente ocupa su lugar
        if($('#des_art_1').val()==''){
            $('#art_id_1').val($('#art_id_2').val());                       
            $('#des_art_1').val($('#des_art_2').val());        
            $('#cat_1').val($('#cat_2').val());        
            $('#pre_1').val($('#pre_2').val());                                              
            $('#cost_1').val($('#cost_2').val());                                              
            $('#cant_art_1').val($('#cant_art_2').val());  

            $('#stock_1').val($('#stock_2').val()); 
            $('#lp_1').val($('#lp_2').val()); 
            $('#may_1').val($('#may_2').val()); 
            $('#dia_1').val($('#dia_2').val());
            $('#saldo_1').val($('#saldo_2').val());
            
            $('#exen_1').val($('#exen_2').val()); 
            $('#iva5_1').val($('#iva5_2').val()); 
            $('#iva10_1').val($('#iva10_2').val()); 

            $('#cost_exen_1').val($('#cost_exen_2').val()); 
            $('#cost_iva5_1').val($('#cost_iva5_2').val()); 
            $('#cost_iva10_1').val($('#cost_iva10_2').val());             

            $('.linea_2 input').val('');
            
            // $('input[name=descuento]').val('');
        }
        if($('#des_art_2').val()==''){
            $('#art_id_2').val($('#art_id_3').val());                       
            $('#des_art_2').val($('#des_art_3').val());    
            $('#cat_2').val($('#cat_3').val());    
            $('#pre_2').val($('#pre_3').val());                                   
            $('#cost_2').val($('#cost_3').val());                                   
            $('#cant_art_2').val($('#cant_art_3').val());  

            $('#stock_2').val($('#stock_3').val()); 
            $('#lp_2').val($('#lp_3').val()); 
            $('#may_2').val($('#may_3').val()); 
            $('#dia_2').val($('#dia_3').val());
            $('#saldo_2').val($('#saldo_3').val());
            
            $('#exen_2').val($('#exen_3').val()); 
            $('#iva5_2').val($('#iva5_3').val()); 
            $('#iva10_2').val($('#iva10_3').val()); 

            $('#cost_exen_2').val($('#cost_exen_3').val()); 
            $('#cost_iva5_2').val($('#cost_iva5_3').val()); 
            $('#cost_iva10_2').val($('#cost_iva10_3').val()); 

            $('.linea_3 input').val('');  
        }
        if($('#des_art_3').val()==''){
            $('#art_id_3').val($('#art_id_4').val());                       
            $('#des_art_3').val($('#des_art_4').val());                                  
            $('#cat_3').val($('#cat_4').val());                                  
            $('#pre_3').val($('#pre_4').val());     
            $('#cost_3').val($('#cost_4').val());     
            $('#cant_art_3').val($('#cant_art_4').val());  
            
            $('#stock_3').val($('#stock_4').val()); 
            $('#lp_3').val($('#lp_4').val()); 
            $('#may_3').val($('#may_4').val()); 
            $('#dia_3').val($('#dia_4').val());
            $('#saldo_3').val($('#saldo_4').val());
            
            $('#exen_3').val($('#exen_4').val()); 
            $('#iva5_3').val($('#iva5_4').val()); 
            $('#iva10_3').val($('#iva10_4').val()); 

            $('#cost_exen_3').val($('#cost_exen_4').val()); 
            $('#cost_iva5_3').val($('#cost_iva5_4').val()); 
            $('#cost_iva10_3').val($('#cost_iva10_4').val()); 

            $('.linea_4 input').val('');  
        }

        if($('#des_art_4').val()==''){
            $('#art_id_4').val($('#art_id_5').val());                       
            $('#des_art_4').val($('#des_art_5').val());                                  
            $('#cat_4').val($('#cat_5').val());                                  
            $('#pre_4').val($('#pre_5').val());     
            $('#cost_4').val($('#cost_5').val());     
            $('#cant_art_4').val($('#cant_art_5').val());  

            $('#stock_4').val($('#stock_5').val()); 
            $('#lp_4').val($('#lp_5').val()); 
            $('#may_4').val($('#may_5').val()); 
            $('#dia_4').val($('#dia_5').val());
            $('#saldo_4').val($('#saldo_5').val());
            
            $('#exen_4').val($('#exen_5').val()); 
            $('#iva5_4').val($('#iva5_5').val()); 
            $('#iva10_4').val($('#iva10_5').val()); 

            $('#cost_exen_4').val($('#cost_exen_5').val()); 
            $('#cost_iva5_4').val($('#cost_iva5_5').val()); 
            $('#cost_iva10_4').val($('#cost_iva10_5').val()); 

            $('.linea_5 input').val('');  
        }
        if($('#des_art_5').val()==''){
            $('#art_id_5').val($('#art_id_6').val());                       
            $('#des_art_5').val($('#des_art_6').val());    
            $('#cat_5').val($('#cat_6').val());    
            $('#pre_5').val($('#pre_6').val());                                   
            $('#cost_5').val($('#cost_6').val());                                   
            $('#cant_art_5').val($('#cant_art_6').val());  

            $('#stock_5').val($('#stock_6').val()); 
            $('#lp_5').val($('#lp_6').val()); 
            $('#may_5').val($('#may_6').val()); 
            $('#dia_5').val($('#dia_6').val());
            $('#saldo_5').val($('#saldo_6').val());
            
            $('#exen_5').val($('#exen_6').val()); 
            $('#iva5_5').val($('#iva5_6').val()); 
            $('#iva10_5').val($('#iva10_6').val()); 

            $('#cost_exen_5').val($('#cost_exen_6').val()); 
            $('#cost_iva5_5').val($('#cost_iva5_6').val()); 
            $('#cost_iva10_5').val($('#cost_iva10_6').val()); 

            $('.linea_6 input').val('');  
        }
        if($('#des_art_6').val()==''){
            $('#art_id_6').val($('#art_id_7').val());                       
            $('#des_art_6').val($('#des_art_7').val());                                  
            $('#cat_6').val($('#cat_7').val());                                  
            $('#pre_6').val($('#pre_7').val());     
            $('#cost_6').val($('#cost_7').val());     
            $('#cant_art_6').val($('#cant_art_7').val());  

            $('#stock_6').val($('#stock_7').val()); 
            $('#lp_6').val($('#lp_7').val()); 
            $('#may_6').val($('#may_7').val()); 
            $('#dia_6').val($('#dia_7').val());
            $('#saldo_6').val($('#saldo_7').val());

            $('#exen_6').val($('#exen_7').val()); 
            $('#iva5_6').val($('#iva5_7').val()); 
            $('#iva10_6').val($('#iva10_7').val()); 

            $('#cost_exen_6').val($('#cost_exen_7').val()); 
            $('#cost_iva5_6').val($('#cost_iva5_7').val()); 
            $('#cost_iva10_6').val($('#cost_iva10_7').val()); 

            $('.linea_7 input').val('');  
        }
        if($('#des_art_7').val()==''){
            $('#art_id_7').val($('#art_id_8').val());                       
            $('#des_art_7').val($('#des_art_8').val());                                  
            $('#cat_7').val($('#cat_8').val());                                  
            $('#pre_7').val($('#pre_8').val());     
            $('#cost_7').val($('#cost_8').val());     
            $('#cant_art_7').val($('#cant_art_8').val());  

            $('#stock_7').val($('#stock_8').val()); 
            $('#lp_7').val($('#lp_8').val()); 
            $('#may_7').val($('#may_8').val()); 
            $('#dia_7').val($('#dia_8').val());
            $('#saldo_7').val($('#saldo_8').val());
            
            $('#exen_7').val($('#exen_8').val()); 
            $('#iva5_7').val($('#iva5_8').val()); 
            $('#iva10_7').val($('#iva10_8').val()); 

            $('#cost_exen_7').val($('#cost_exen_8').val()); 
            $('#cost_iva5_7').val($('#cost_iva5_8').val()); 
            $('#cost_iva10_7').val($('#cost_iva10_8').val()); 

            $('.linea_8 input').val('');  
            
        }

        // if($('#art_id_8').val()==''){
        //     $('#aviso').html('&nbsp;');
        // }                

        $('#aviso').html('&nbsp;');
        
        //Totales            
        totales();                  
    });         
});