window.addEventListener("load", function(){
    $(document).ready(function(){
        // cargar pagina
        $('#aumentar,#disminuir,#establecer_pre').prop('disabled',false);

        // clickar
        $('#mdf_grupo').click(function(){
            $('#mdf').css('display','block');
        });

        // cancelar
        $('#cancelar_mdf').click(function(){
            $('#mdf').css('display','none');
            $('#aumentar,#disminuir,#establecer_pre').val('');
            $('#aumentar,#disminuir,#establecer_pre').prop('disabled',false);
        });

        //opcion
        $('#aumentar').click(function(){
            $('#disminuir,#establecer_pre').prop('disabled',true);
        });
        $('#disminuir').click(function(){
            $('#aumentar,#establecer_pre').prop('disabled',true);
        });
        $('#establecer_pre').click(function(){
            $('#aumentar,#disminuir').prop('disabled',true);
        });

        //enviar
        $('#mdf_submit').click(function(){            
            // if(!$('#aumentar,#disminuir,#disminuir').is(':disabled')){
            // if(!$('#aumentar,#disminuir,#disminuir').is(':disabled')){
            //     $('#campo_vacio').show().delay(1000).fadeOut(0);
            // }else{
                
                //Aumentar
                if(!$('#aumentar').is(':disabled')){
                    // if($('#aumentar').val()==''){
                    //     $('#campo_vacio').show().delay(1000).fadeOut(0);
                    // }else{
                        if($('#aumentar').val()!='' && $('#aumentar').val()>=500 && $('#aumentar').val()<=1000000){
                                
                            $('#mdf .error').css('color','green').css('text-align','center');                                  
                            $('#mdf .error').html('Éxito');
                            $('.registro').css('pointer-events','none'); 

                            var operacion='aumentar';
                            var operar=$('#aumentar').val();    
                            // console.log(operacion+', '+operar)                           
                            
                            setTimeout(function(){                                                                                        
                                $('#mdf').css('display','none');                                                                                                                                                            
                                $('#mdf .error').css('color','red');                                  
                                $('#mdf .error').html('&nbsp');    
                            }, 500);                            

                        }else{  
                            $('#mdf .error').text('Valor no válido');
                            $('#aumentar').focus();
                        }
                    // }
                }
                //Disminuir
                if(!$('#disminuir').is(':disabled')){
                    if($('#disminuir').val()!='' && $('#disminuir').val()>=500 && $('#disminuir').val()<=1000000){
                                
                        $('#mdf .error').css('color','green').css('text-align','center');                                  
                        $('#mdf .error').html('Éxito');
                        $('.registro').css('pointer-events','none'); 

                        var operacion='disminuir';
                        var operar=$('#disminuir').val();    
                        // console.log(operacion+', '+operar)                           
                        
                        setTimeout(function(){                                                                                        
                            $('#mdf').css('display','none');                                                                                                                                                            
                            $('#mdf .error').css('color','red');                                  
                            $('#mdf .error').html('&nbsp');    
                        }, 500);                            

                    }else{  
                        $('#mdf .error').text('Valor no válido');
                        $('#aumentar').focus();
                    }
                }
                //Establecer
                if(!$('#establecer_pre').is(':disabled')){
                    if($('#establecer_pre').val()!='' && $('#establecer_pre').val()>=500 && $('#establecer_pre').val()<=1000000){
                                
                        $('#mdf .error').css('color','green').css('text-align','center');                                  
                        $('#mdf .error').html('Éxito');
                        $('.registro').css('pointer-events','none'); 

                        var operacion='establecer';
                        var operar=$('#establecer_pre').val();    
                        // console.log(operacion+', '+operar)                           
                        
                        setTimeout(function(){                                                                                        
                            $('#mdf').css('display','none');                                                                                                                                                            
                            $('#mdf .error').css('color','red');                                  
                            $('#mdf .error').html('&nbsp');    
                        }, 500);                            

                    }else{  
                        $('#mdf .error').text('Valor no válido');
                        $('#establecer_pre').focus();
                    }
                }


                var ids=window.productos_chequeados;
                var modificar=ids.length;
                // var los_id=ids.join(',');

                if(modificar==1){
                    var modificados='<span>'+modificar+'</span> producto modificado';
                }else{
                    var modificados='<span>'+modificar+'</span> productos modificados';
                }

                $.ajax({
                    async:false,
                    url: '/Tazper/public/productos_mod_mas',
                    type: 'POST',
                    data: {// 'ids':los_id,
                        'ids':ids,
                        'operacion':operacion,
                        'operar':operar,
                    },
                    success: function(data){
                        console.log(ids+' success');
                    }
                });

                $('#aumentar,#disminuir,#establecer_pre').prop('disabled',false);
                $('#aumentar,#disminuir,#establecer_pre').val('');
            // }

            if($('#aumentar,#disminuir,#disminuir').val()!=''){
                $('.eliminados_cant').html(modificados).addClass('numero');
                $('#eliminados').show().delay(1500).fadeOut(0);
            }

            ids.forEach( //borra items
                element => sessionStorage.removeItem('producto_'+element)
            );
            sessionStorage.removeItem('productos_sesion'); //borra sesion            

                // $('#busqueda').val('');
                // $('#nav3 input').val('');
                $('#cancelar_filtro').trigger('click');
                // $('#grupal').css('visibility','hidden !important');
                $('#grupal').css('display','none');     
                $('#cancelar_grupo').trigger('click');           

            var route="http://localhost/Tazper/public/Productos";                                 

            $.ajax({                   
                url: route,
                data: {'route': route},
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('#paginacion').html(data.paginacion);
                    $('#productos').html(data.contenido);
                }
            });

            
            $('#todo').prop('disabled',false);
            $('#todo').prop('checked',false);            
        });
    });
});