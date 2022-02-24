window.addEventListener("load", function(){
    //detalle
    var sub_exen=0;
    var sub_iva5=0;
    var sub_iva10=0;    

    function totales(){
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
    }

    $('#agregar').click(function(){ //agregar
        event.preventDefault();

        if($('#art_des').val()!='' & $('#art_cant').val()!='' & $('#art_cant').val()>0){
        // & Math.sign($('#art_cant').val())!=-1 & Math.sign($('#art_cant').val())!=-0
                                
            if($('#tipo').val()=='Producto' && $('#art_cant').val()%1!=0){
                console.log('invalido');
                // console.log($('#uni_med').val());

            }else if($('#tipo').val()=='Material' && $('#art_med').val().toLowerCase()=='unidades' && $('#art_cant').val()%1!=0){

                console.log($('#art_med').val());     
                // console.log('window.med');     
                
            }else{                                          

                //si no esta al limite no muestra aviso
                if($('#des_art_8').val()!=''){ 
                    $('#aviso').html('&nbsp;');
                }

            //si ya está en alguna linea
            if($('#art_des').val()==$('#des_art_1').val()){                        
                var cantidad=parseFloat($('#cant_art_1').val());
                cantidad=cantidad+parseFloat($('#art_cant').val());
                $('#cant_art_1').val(cantidad);                    

                var importe=$('#pre_1').val()*$('#cant_art_1').val();   

                if($('#art_imp').val()=='Exentas'){
                    $('#exen_1').val(importe);
                }else if($('#art_imp').val()=='IVA 5%'){
                    $('#iva5_1').val(importe);                
                }else if($('#art_imp').val()=='IVA 10%'){
                    $('#iva10_1').val(importe);
                }

            }else if($('#art_des').val()==$('#des_art_2').val()){
                var cantidad=parseFloat($('#cant_art_2').val());
                cantidad=cantidad+parseFloat($('#art_cant').val());
                $('#cant_art_2').val(cantidad);
                
                var importe=$('#pre_2').val()*$('#cant_art_2').val();   

                if($('#art_imp').val()=='Exentas'){
                    $('#exen_2').val(importe);
                }else if($('#art_imp').val()=='IVA 5%'){
                    $('#iva5_2').val(importe);                
                }else if($('#art_imp').val()=='IVA 10%'){
                    $('#iva10_2').val(importe);
                }

            }else if($('#art_des').val()==$('#des_art_3').val()){
                var cantidad=parseFloat($('#cant_art_3').val());
                cantidad=cantidad+parseFloat($('#art_cant').val());
                $('#cant_art_3').val(cantidad);
                
                var importe=$('#pre_3').val()*$('#cant_art_3').val();   

                if($('#art_imp').val()=='Exentas'){
                    $('#exen_3').val(importe);
                }else if($('#art_imp').val()=='IVA 5%'){
                    $('#iva5_3').val(importe);                
                }else if($('#art_imp').val()=='IVA 10%'){
                    $('#iva10_3').val(importe);
                }

            }else if($('#art_des').val()==$('#des_art_4').val()){
                var cantidad=parseFloat($('#cant_art_4').val());
                cantidad=cantidad+parseFloat($('#art_cant').val());
                $('#cant_art_4').val(cantidad);
                
                var importe=$('#pre_4').val()*$('#cant_art_4').val();   

                if($('#art_imp').val()=='Exentas'){
                    $('#exen_4').val(importe);
                }else if($('#art_imp').val()=='IVA 5%'){
                    $('#iva5_4').val(importe);                
                }else if($('#art_imp').val()=='IVA 10%'){
                    $('#iva10_4').val(importe);
                }

            }else if($('#art_des').val()==$('#des_art_5').val()){
                var cantidad=parseFloat($('#cant_art_5').val());
                cantidad=cantidad+parseFloat($('#art_cant').val());
                $('#cant_art_5').val(cantidad);
                
                var importe=$('#pre_5').val()*$('#cant_art_5').val();   

                if($('#art_imp').val()=='Exentas'){
                    $('#exen_5').val(importe);
                }else if($('#art_imp').val()=='IVA 5%'){
                    $('#iva5_5').val(importe);                
                }else if($('#art_imp').val()=='IVA 10%'){
                    $('#iva10_5').val(importe);
                }

            }else if($('#art_des').val()==$('#des_art_6').val()){
                var cantidad=parseFloat($('#cant_art_6').val());
                cantidad=cantidad+parseFloat($('#art_cant').val());
                $('#cant_art_6').val(cantidad);
                
                var importe=$('#pre_6').val()*$('#cant_art_6').val();   

                if($('#art_imp').val()=='Exentas'){
                    $('#exen_6').val(importe);
                }else if($('#art_imp').val()=='IVA 5%'){
                    $('#iva5_6').val(importe);                
                }else if($('#art_imp').val()=='IVA 10%'){
                    $('#iva10_6').val(importe);
                }

            }else if($('#art_des').val()==$('#des_art_7').val()){
                var cantidad=parseFloat($('#cant_art_7').val());
                cantidad=cantidad+parseFloat($('#art_cant').val());
                $('#cant_art_7').val(cantidad);
                
                var importe=$('#pre_7').val()*$('#cant_art_7').val();   

                if($('#art_imp').val()=='Exentas'){
                    $('#exen_7').val(importe);
                }else if($('#art_imp').val()=='IVA 5%'){
                    $('#iva5_7').val(importe);                
                }else if($('#art_imp').val()=='IVA 10%'){
                    $('#iva10_7').val(importe);
                }

            }else if($('#art_des').val()==$('#des_art_8').val()){
                var cantidad=parseFloat($('#cant_art_8').val());
                cantidad=cantidad+parseFloat($('#art_cant').val());
                $('#cant_art_8').val(cantidad);
                
                var importe=$('#pre_8').val()*$('#cant_art_8').val();   

                if($('#art_imp').val()=='Exentas'){
                    $('#exen_8').val(importe);
                }else if($('#art_imp').val()=='IVA 5%'){
                    $('#iva5_8').val(importe);                
                }else if($('#art_imp').val()=='IVA 10%'){
                    $('#iva10_8').val(importe);
                }
                
            }else{
                //si no está, agrega nueva linea en vacias                                        
                if($('#des_art_1').val()==''){
                    $('#art_id_1').val($('#id_art').val());           
                    $('#des_art_1').val($('#art_des').val());   
                    $('#pre_1').val($('#art_pre').val());   
                    $('#cant_art_1').val($('#art_cant').val());  
                    $('#unmed_art_1').val($('#art_med').val());  

                    var importe=$('#pre_1').val()*$('#cant_art_1').val();   

                    if($('#art_imp').val()=='Exentas'){
                        $('#exen_1').val(importe);
                    }else if($('#art_imp').val()=='IVA 5%'){
                        $('#iva5_1').val(importe);                
                    }else if($('#art_imp').val()=='IVA 10%'){
                        $('#iva10_1').val(importe);
                    }

                }else if($('#des_art_2').val()==''){ //si esta ocupada, en la siguiente
                    $('#art_id_2').val($('#id_art').val());           
                    $('#des_art_2').val($('#art_des').val());
                    $('#pre_2').val($('#art_pre').val());                                     
                    $('#cant_art_2').val($('#art_cant').val());   
                    $('#unmed_art_2').val($('#art_med').val());  
                    
                    var importe=$('#pre_2').val()*$('#cant_art_2').val();   

                    if($('#art_imp').val()=='Exentas'){
                        $('#exen_2').val(importe);
                    }else if($('#art_imp').val()=='IVA 5%'){
                        $('#iva5_2').val(importe);                
                    }else if($('#art_imp').val()=='IVA 10%'){
                        $('#iva10_2').val(importe);
                    }

                }else if($('#des_art_3').val()==''){
                    $('#art_id_3').val($('#id_art').val());           
                    $('#des_art_3').val($('#art_des').val());                                  
                    $('#pre_3').val($('#art_pre').val());   
                    $('#cant_art_3').val($('#art_cant').val());           
                    $('#unmed_art_3').val($('#art_med').val());  
                    
                    var importe=$('#pre_3').val()*$('#cant_art_3').val();   

                    if($('#art_imp').val()=='Exentas'){
                        $('#exen_3').val(importe);
                    }else if($('#art_imp').val()=='IVA 5%'){
                        $('#iva5_3').val(importe);                
                    }else if($('#art_imp').val()=='IVA 10%'){
                        $('#iva10_3').val(importe);
                    }

                }else if($('#des_art_4').val()==''){
                    $('#art_id_4').val($('#id_art').val());           
                    $('#des_art_4').val($('#art_des').val());                                  
                    $('#pre_4').val($('#art_pre').val());   
                    $('#cant_art_4').val($('#art_cant').val());           
                    $('#unmed_art_4').val($('#art_med').val());  
                    
                    var importe=$('#pre_4').val()*$('#cant_art_4').val();   

                    if($('#art_imp').val()=='Exentas'){
                        $('#exen_4').val(importe);
                    }else if($('#art_imp').val()=='IVA 5%'){
                        $('#iva5_4').val(importe);                
                    }else if($('#art_imp').val()=='IVA 10%'){
                        $('#iva10_4').val(importe);
                    }

                }else if($('#des_art_5').val()==''){
                    $('#art_id_5').val($('#id_art').val());           
                    $('#des_art_5').val($('#art_des').val());                                  
                    $('#pre_5').val($('#art_pre').val());   
                    $('#cant_art_5').val($('#art_cant').val());        
                    $('#unmed_art_5').val($('#art_med').val());  
                    
                    var importe=$('#pre_5').val()*$('#cant_art_5').val();   

                    if($('#art_imp').val()=='Exentas'){
                        $('#exen_5').val(importe);
                    }else if($('#art_imp').val()=='IVA 5%'){
                        $('#iva5_5').val(importe);                
                    }else if($('#art_imp').val()=='IVA 10%'){
                        $('#iva10_5').val(importe);
                    }

                }else if($('#des_art_6').val()==''){
                    $('#art_id_6').val($('#id_art').val());           
                    $('#des_art_6').val($('#art_des').val());    
                    $('#pre_6').val($('#art_pre').val());   
                    $('#cant_art_6').val($('#art_cant').val());
                    $('#unmed_art_6').val($('#art_med').val());  
                    
                    var importe=$('#pre_6').val()*$('#cant_art_6').val();   

                    if($('#art_imp').val()=='Exentas'){
                        $('#exen_6').val(importe);
                    }else if($('#art_imp').val()=='IVA 5%'){
                        $('#iva5_6').val(importe);                
                    }else if($('#art_imp').val()=='IVA 10%'){
                        $('#iva10_6').val(importe);
                    }

                }else if($('#des_art_7').val()==''){
                    $('#art_id_7').val($('#id_art').val());           
                    $('#des_art_7').val($('#art_des').val());    
                    $('#pre_7').val($('#art_pre').val());                                 
                    $('#cant_art_7').val($('#art_cant').val());
                    $('#unmed_art_7').val($('#art_med').val());  
                    
                    var importe=$('#pre_7').val()*$('#cant_art_7').val();   

                    if($('#art_imp').val()=='Exentas'){
                        $('#exen_7').val(importe);
                    }else if($('#art_imp').val()=='IVA 5%'){
                        $('#iva5_7').val(importe);                
                    }else if($('#art_imp').val()=='IVA 10%'){
                        $('#iva10_7').val(importe);
                    }

                }else if($('#des_art_8').val()==''){
                    $('#art_id_8').val($('#id_art').val());           
                    $('#des_art_8').val($('#art_des').val()); 
                    $('#pre_8').val($('#art_pre').val());                                    
                    $('#cant_art_8').val($('#art_cant').val());
                    $('#unmed_art_8').val($('#art_med').val());
                    
                    var importe=$('#pre_8').val()*$('#cant_art_8').val();   

                    if($('#art_imp').val()=='Exentas'){
                        $('#exen_8').val(importe);
                    }else if($('#art_imp').val()=='IVA 5%'){
                        $('#iva5_8').val(importe);                
                    }else if($('#art_imp').val()=='IVA 10%'){
                        $('#iva10_8').val(importe);
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
            
            }            
        }        

        if($('#art_des').val()!='' & $('#art_cant').val()==''){
            $('#art_cant').focus();
        }
    });

    // Mas
    $('.mas').click(function(){
        event.preventDefault();  

        if($('.linea:hover .cant').val()!='' && $('.linea:hover .cant')!=9999){
            if($('.linea:hover .unimed').val()=='Unidades' || $('.linea:hover .unimed').val()=='unidades'){                    
                // cant                                                               
                var cant=parseInt($('.linea:hover .cant').val())+parseInt(1);       
                $('.linea:hover .cant').val(cant);

                // importe 
                var precio=parseInt($('.linea:hover .precio').val());
                
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
            }else{
                // cant
                var cant=parseFloat($('.linea:hover .cant').val())+parseFloat(0.5);       
                $('.linea:hover .cant').val(cant);   

                // importe      
                var precio=parseInt($('.linea:hover .precio').val())/2;
                
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

            //Totales            
            totales();
        }                
    });

    // Menos   
    $('.menos').click(function(){
        event.preventDefault();  
        
        if($('.linea:hover .cant').val()!=''){                                   
            if($('.linea:hover .unimed').val()=='Unidades' || $('.linea:hover .unimed').val()=='unidades'){ 
                if($('.linea:hover .cant').val()!=1){
                    // cant
                    var cant=parseInt($('.linea:hover .cant').val())-parseInt(1);       
                    $('.linea:hover .cant').val(cant);       

                    // importe                    
                    var precio=parseInt($('.linea:hover .precio').val());
                    
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
            }else{
                if($('.linea:hover .cant').val()!=0.5){
                    // cant
                    var cant=parseFloat($('.linea:hover .cant').val())-parseFloat(0.5);       
                    $('.linea:hover .cant').val(cant);      
                    
                    // importe
                    // importe      
                    var precio=parseInt($('.linea:hover .precio').val())/2;
                    
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
            }    
            
            //Totales            
            totales();                                                            
        }        
    });

    //Quitar
    $('.quitar').click(function(){
        event.preventDefault();                    
        $('.linea:hover input').val('');  

        //vacia y la linea siguiente ocupa su lugar
        if($('#des_art_1').val()==''){
            $('#art_id_1').val($('#art_id_2').val());                       
            $('#des_art_1').val($('#des_art_2').val());        
            $('#pre_1').val($('#pre_2').val());                                              
            $('#cant_art_1').val($('#cant_art_2').val());  
            $('#unmed_art_1').val($('#unmed_art_2').val()); 
            
            $('#exen_1').val($('#exen_2').val()); 
            $('#iva5_1').val($('#iva5_2').val()); 
            $('#iva10_1').val($('#iva10_2').val()); 
            
            $('.linea_2 input').val('');  
        }
        if($('#des_art_2').val()==''){
            $('#art_id_2').val($('#art_id_3').val());                       
            $('#des_art_2').val($('#des_art_3').val());    
            $('#pre_2').val($('#pre_3').val());                                   
            $('#cant_art_2').val($('#cant_art_3').val());  
            $('#unmed_art_2').val($('#unmed_art_3').val());  
            
            $('#exen_2').val($('#exen_3').val()); 
            $('#iva5_2').val($('#iva5_3').val()); 
            $('#iva10_2').val($('#iva10_3').val()); 

            $('.linea_3 input').val('');  
        }
        if($('#des_art_3').val()==''){
            $('#art_id_3').val($('#art_id_4').val());                       
            $('#des_art_3').val($('#des_art_4').val());                                  
            $('#pre_3').val($('#pre_4').val());     
            $('#cant_art_3').val($('#cant_art_4').val());  
            $('#unmed_art_3').val($('#unmed_art_4').val());  
            
            $('#exen_3').val($('#exen_4').val()); 
            $('#iva5_3').val($('#iva5_4').val()); 
            $('#iva10_3').val($('#iva10_4').val()); 

            $('.linea_4 input').val('');  
        }

        if($('#des_art_4').val()==''){
            $('#art_id_4').val($('#art_id_5').val());                       
            $('#des_art_4').val($('#des_art_5').val());                                  
            $('#pre_4').val($('#pre_5').val());     
            $('#cant_art_4').val($('#cant_art_5').val());  
            $('#unmed_art_4').val($('#unmed_art_5').val());  
            
            $('#exen_4').val($('#exen_5').val()); 
            $('#iva5_4').val($('#iva5_5').val()); 
            $('#iva10_4').val($('#iva10_5').val()); 

            $('.linea_5 input').val('');  
        }
        if($('#des_art_5').val()==''){
            $('#art_id_5').val($('#art_id_6').val());                       
            $('#des_art_5').val($('#des_art_6').val());    
            $('#pre_5').val($('#pre_6').val());                                   
            $('#cant_art_5').val($('#cant_art_6').val());  
            $('#unmed_art_5').val($('#unmed_art_6').val());  
            
            $('#exen_5').val($('#exen_6').val()); 
            $('#iva5_5').val($('#iva5_6').val()); 
            $('#iva10_5').val($('#iva10_6').val()); 

            $('.linea_6 input').val('');  
        }
        if($('#des_art_6').val()==''){
            $('#art_id_6').val($('#art_id_7').val());                       
            $('#des_art_6').val($('#des_art_7').val());                                  
            $('#pre_6').val($('#pre_7').val());     
            $('#cant_art_6').val($('#cant_art_7').val());  
            $('#unmed_art_6').val($('#unmed_art_7').val());  
            
            $('#exen_6').val($('#exen_7').val()); 
            $('#iva5_6').val($('#iva5_7').val()); 
            $('#iva10_6').val($('#iva10_7').val()); 

            $('.linea_7 input').val('');  
        }
        if($('#des_art_7').val()==''){
            $('#art_id_7').val($('#art_id_8').val());                       
            $('#des_art_7').val($('#des_art_8').val());                                  
            $('#pre_7').val($('#pre_8').val());     
            $('#cant_art_7').val($('#cant_art_8').val());  
            $('#unmed_art_7').val($('#unmed_art_8').val());  
            
            $('#exen_7').val($('#exen_8').val()); 
            $('#iva5_7').val($('#iva5_8').val()); 
            $('#iva10_7').val($('#iva10_8').val()); 

            $('.linea_8 input').val('');  
            
        }

        if($('#art_id_8').val()==''){
            $('#aviso').html('&nbsp;');
        }                
        
        //Totales            
        totales();        
    });         
});