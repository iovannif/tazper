window.addEventListener("load", function(){
    //agregar mat a det
    $('#agregar').click(function(){
        event.preventDefault();

        if($('#art_des').val()!='' & $('#art_cant').val()!='' & $('#art_cant').val()>0){
            // & Math.sign($('#art_cant').val())!=-1 & Math.sign($('#art_cant').val())!=-0
        if($('#art_med').val().toLowerCase()=='unidades' && $('#art_cant').val()%1!=0){    
            console.log('invalido');  
        }else{
            //si da el stock
            if(parseFloat($('#art_st').val())>=parseFloat($('#art_cant').val())){            
                //si ya está
                if($('#des_art_8').val()!=''){
                    $('#aviso').html('&nbsp;');
                }

                if($('#art_des').val()==$('#des_art_1').val()){                        
                    var cantidad=parseFloat($('#cant_art_1').val());
                    cantidad=cantidad+parseFloat($('#art_cant').val());
                    $('#cant_art_1').val(cantidad);

                }else if($('#art_des').val()==$('#des_art_2').val()){
                    var cantidad=parseFloat($('#cant_art_2').val());
                    cantidad=cantidad+parseFloat($('#art_cant').val());
                    $('#cant_art_2').val(cantidad);

                }else if($('#art_des').val()==$('#des_art_3').val()){
                    var cantidad=parseFloat($('#cant_art_3').val());
                    cantidad=cantidad+parseFloat($('#art_cant').val());
                    $('#cant_art_3').val(cantidad);

                }else if($('#art_des').val()==$('#des_art_4').val()){
                    var cantidad=parseFloat($('#cant_art_4').val());
                    cantidad=cantidad+parseFloat($('#art_cant').val());
                    $('#cant_art_4').val(cantidad);

                }else if($('#art_des').val()==$('#des_art_5').val()){
                    var cantidad=parseFloat($('#cant_art_5').val());
                    cantidad=cantidad+parseFloat($('#art_cant').val());
                    $('#cant_art_5').val(cantidad);

                }else if($('#art_des').val()==$('#des_art_6').val()){
                    var cantidad=parseFloat($('#cant_art_6').val());
                    cantidad=cantidad+parseFloat($('#art_cant').val());
                    $('#cant_art_6').val(cantidad);

                }else if($('#art_des').val()==$('#des_art_7').val()){
                    var cantidad=parseFloat($('#cant_art_7').val());
                    cantidad=cantidad+parseFloat($('#art_cant').val());
                    $('#cant_art_7').val(cantidad);

                }else if($('#art_des').val()==$('#des_art_8').val()){
                    var cantidad=parseFloat($('#cant_art_8').val());
                    cantidad=cantidad+parseFloat($('#art_cant').val());
                    $('#cant_art_8').val(cantidad);
                    
                }else{
                    //si no está                                        
                    if($('#des_art_1').val()==''){
                        $('#art_id_1').val($('#id_art').val());           
                        $('#mat_id_1').val($('#id_mat').val());    
                        $('#des_art_1').val($('#art_des').val());                                  
                        $('#cant_art_1').val($('#art_cant').val());  
                        $('#unmed_art_1').val($('#art_med').val());  
    
                    }else if($('#des_art_2').val()==''){
                        $('#art_id_2').val($('#id_art').val());           
                        $('#mat_id_2').val($('#id_mat').val());    
                        $('#des_art_2').val($('#art_des').val());                                  
                        $('#cant_art_2').val($('#art_cant').val());   
                        $('#unmed_art_2').val($('#art_med').val());  
    
                    }else if($('#des_art_3').val()==''){
                        $('#art_id_3').val($('#id_art').val());           
                        $('#mat_id_3').val($('#id_mat').val());    
                        $('#des_art_3').val($('#art_des').val());                                  
                        $('#cant_art_3').val($('#art_cant').val());           
                        $('#unmed_art_3').val($('#art_med').val());  
    
                    }else if($('#des_art_4').val()==''){
                        $('#art_id_4').val($('#id_art').val());           
                        $('#mat_id_4').val($('#id_mat').val());    
                        $('#des_art_4').val($('#art_des').val());                                  
                        $('#cant_art_4').val($('#art_cant').val());           
                        $('#unmed_art_4').val($('#art_med').val());  
    
                    }else if($('#des_art_5').val()==''){
                        $('#art_id_5').val($('#id_art').val());           
                        $('#mat_id_5').val($('#id_mat').val());    
                        $('#des_art_5').val($('#art_des').val());                                  
                        $('#cant_art_5').val($('#art_cant').val());        
                        $('#unmed_art_5').val($('#art_med').val());  
    
                    }else if($('#des_art_6').val()==''){
                        $('#art_id_6').val($('#id_art').val());           
                        $('#mat_id_6').val($('#id_mat').val());    
                        $('#des_art_6').val($('#art_des').val());                                  
                        $('#cant_art_6').val($('#art_cant').val());
                        $('#unmed_art_6').val($('#art_med').val());  
    
                    }else if($('#des_art_7').val()==''){
                        $('#art_id_7').val($('#id_art').val());           
                        $('#mat_id_7').val($('#id_mat').val());    
                        $('#des_art_7').val($('#art_des').val());                                  
                        $('#cant_art_7').val($('#art_cant').val());
                        $('#unmed_art_7').val($('#art_med').val());  
    
                    }else if($('#des_art_8').val()==''){
                        $('#art_id_8').val($('#id_art').val());           
                        $('#mat_id_8').val($('#id_mat').val());    
                        $('#des_art_8').val($('#art_des').val());                                  
                        $('#cant_art_8').val($('#art_cant').val());
                        $('#unmed_art_8').val($('#art_med').val());                          
                        
                    }else{                        
                        $('#aviso').html('Ha llegado al límite de ítems');                        
                    }                                                
                }

                if($('#des_art_1').val()!=''){//Solo cuando se agrega, error no
                    if($('#aviso').text()!='Ha llegado al límite de ítems'){ //limpia
                        $('#busca_material').prop('disabled',false).val('').focus();
                        $('.cambiar').css('display','none');   
                        $('#tabla_articulo input').val(''); 
                    }                      
                }

                if($('#art_id_8').val()==''){
                    $('#aviso').html('&nbsp;');
                }

            }else{ //excede stock
                $('#aviso').html('Excede existencia');
            }
        }
        }
    });

    //quitar de la lista un mat
    $('.quitar').click(function(){
        event.preventDefault();  
        $(this).css('visibility','hidden');                  
        $('.linea:hover input').val('');  
        
        if($('#des_art_1').val()==''){
            $('#art_id_1').val($('#art_id_2').val());           
            $('#mat_id_1').val($('#mat_id_2').val());    
            $('#des_art_1').val($('#des_art_2').val());                                  
            $('#cant_art_1').val($('#cant_art_2').val());  
            $('#unmed_art_1').val($('#unmed_art_2').val()); 
            
            $('.linea_2 input').val('');  
        }
        if($('#des_art_2').val()==''){
            $('#art_id_2').val($('#art_id_3').val());           
            $('#mat_id_2').val($('#mat_id_3').val());    
            $('#des_art_2').val($('#des_art_3').val());                                  
            $('#cant_art_2').val($('#cant_art_3').val());  
            $('#unmed_art_2').val($('#unmed_art_3').val());  

            $('.linea_3 input').val('');  
        }
        if($('#des_art_3').val()==''){
            $('#art_id_3').val($('#art_id_4').val());           
            $('#mat_id_3').val($('#mat_id_4').val());    
            $('#des_art_3').val($('#des_art_4').val());                                  
            $('#cant_art_3').val($('#cant_art_4').val());  
            $('#unmed_art_3').val($('#unmed_art_4').val());  

            $('.linea_4 input').val('');  
        }

        if($('#des_art_4').val()==''){
            $('#art_id_4').val($('#art_id_5').val());           
            $('#mat_id_4').val($('#mat_id_5').val());    
            $('#des_art_4').val($('#des_art_5').val());                                  
            $('#cant_art_4').val($('#cant_art_5').val());  
            $('#unmed_art_4').val($('#unmed_art_5').val());  

            $('.linea_5 input').val('');  
        }
        if($('#des_art_5').val()==''){
            $('#art_id_5').val($('#art_id_6').val());           
            $('#mat_id_5').val($('#mat_id_6').val());    
            $('#des_art_5').val($('#des_art_6').val());                                  
            $('#cant_art_5').val($('#cant_art_6').val());  
            $('#unmed_art_5').val($('#unmed_art_6').val());  

            $('.linea_6 input').val('');  
        }
        if($('#des_art_6').val()==''){
            $('#art_id_6').val($('#art_id_7').val());           
            $('#mat_id_6').val($('#mat_id_7').val());    
            $('#des_art_6').val($('#des_art_7').val());                                  
            $('#cant_art_6').val($('#cant_art_7').val());  
            $('#unmed_art_6').val($('#unmed_art_7').val());  

            $('.linea_7 input').val('');  
        }
        if($('#des_art_7').val()==''){
            $('#art_id_7').val($('#art_id_8').val());           
            $('#mat_id_7').val($('#mat_id_8').val());    
            $('#des_art_7').val($('#des_art_8').val());                                  
            $('#cant_art_7').val($('#cant_art_8').val());  
            $('#unmed_art_7').val($('#unmed_art_8').val());  

            $('.linea_8 input').val('');  
            
        }

        if($('#art_id_8').val()==''){
            $('#aviso').html('&nbsp;');
        }

        $('#busca_material').prop('disabled',false).focus(); 
    });    

    //css    
    $(".linea").mouseover(function(){
        if($(this).find('.art').val()!=''){
            // $('.quitar').css('visibility','visible');
            // $(this).find($('.quitar')).css('visibility','visible');
            $(this).find('.quitar').css('visibility','visible');
        }
    }); 
    $(".linea").mouseout(function(){
        if($(this).find('.art').val()!=''){
            $(this).find('.quitar').css('visibility','hidden');
        }
    });      
});