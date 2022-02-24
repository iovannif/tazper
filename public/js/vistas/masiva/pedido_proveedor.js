window.addEventListener("load", function(){
    $(document).ready(function(){
        // masiva
        //set
        if(sessionStorage.getItem('pedprov_masiva')!=null){
            var check=document.getElementById('masiva');
            var chequeado=sessionStorage.getItem('pedprov_masiva');
            check.checked=chequeado; //marca
        }
        //get
        $('#masiva').click(function(){
            if($(this).is(':checked')){
                var check=document.getElementById('masiva');
                sessionStorage.setItem('pedprov_masiva', check.checked);                
            }else{
                sessionStorage.removeItem('pedprov_masiva');
            }
            $('#busca_prov').focus();
        });        

        //registrar
        $('#registrar').click(function(){
            if($('#masiva').is(':checked')){
                event.preventDefault();  
                
                var id_prov=$('#id_prov').val();
                var fe_ent=$('#fe_ent').val();      
                var medpag=$('select[name=Id_MedPag]').val();    
                var obs=$('#obs').val();
                
                //detalle lineas
                var art_id_1=$('#art_id_1').val();
                var cant_art_1=$('#cant_art_1').val();

                var art_id_2=$('#art_id_2').val();
                var cant_art_2=$('#cant_art_2').val();
                
                var art_id_3=$('#art_id_3').val();
                var cant_art_3=$('#cant_art_3').val();
                
                var art_id_4=$('#art_id_4').val();
                var cant_art_4=$('#cant_art_4').val();
                
                var art_id_5=$('#art_id_5').val();
                var cant_art_5=$('#cant_art_5').val();
                
                var art_id_6=$('#art_id_6').val();
                var cant_art_6=$('#cant_art_6').val();
                
                var art_id_7=$('#art_id_7').val();
                var cant_art_7=$('#cant_art_7').val();
                
                var art_id_8=$('#art_id_8').val();
                var cant_art_8=$('#cant_art_8').val();                

                $.ajax({
                    async:false,
                    url: '/Tazper/public/PedidoProveedor',
                    type: 'POST',
                    headers: {
                        "X-CSRF-TOKEN":$("input[name=_token]").val()
                    },
                    data: {
                        Id_Prov: id_prov,
                        PedProv_FeEnt: fe_ent,        
                        Id_MedPag: medpag,
                        PedProv_Obs: obs,

                        Id_Art_1: art_id_1,
                        Art_Cant_1: cant_art_1,

                        Id_Art_2: art_id_2,
                        Art_Cant_2: cant_art_2,
                        
                        Id_Art_3: art_id_3,
                        Art_Cant_3: cant_art_3,
                        
                        Id_Art_4: art_id_4,
                        Art_Cant_4: cant_art_4,
                        
                        Id_Art_5: art_id_5,
                        Art_Cant_5: cant_art_5,
                        
                        Id_Art_6: art_id_6,
                        Art_Cant_6: cant_art_6,
                        
                        Id_Art_7: art_id_7,
                        Art_Cant_7: cant_art_7,
                        
                        Id_Art_8: art_id_8,                        
                        Art_Cant_8: cant_art_8,
                    },
                    success: function(){
                        console.log('success');
                        $('#agregado').show().delay(500).fadeOut(0);

                        $('.error_prov').html('&nbsp;');                        
                        $('.error_fe').html('&nbsp;');
                        $('.error_obs').html('&nbsp;');        

                        $('#aviso').html('&nbsp;');

                        setTimeout(function(){                            
                            document.getElementById("pedprov_form").reset();                                                        
                            $('#busca_prov').prop('disabled',false).focus(); 
                        }, 500);                                

                    },
                    error: function(err){
                        if(err.status == 422){    
                            $('#busca_prov').focus();    
                            // $('.help-block').fadeIn().html(JSON.stringify(err.responseJSON)); //todo trae
                            
                            if(err.responseJSON.Id_Prov)
                                {$('.error_prov').fadeIn().html(err.responseJSON.Id_Prov[0]); //first
                            }else{
                                $('.error_prov').fadeIn().html('&nbsp;');
                            }                                                        
                            
                            if(err.responseJSON.PedProv_FeEnt)
                                {$('.error_fe').fadeIn().html(err.responseJSON.PedProv_FeEnt[0]);
                            }else{
                                $('.error_fe').fadeIn().html('&nbsp;');
                            }    

                            if(err.responseJSON.Id_MedPag)
                                {$('.error_medpag').fadeIn().html(err.responseJSON.Id_MedPag[0]);
                            }else{
                                $('.error_medpag').fadeIn().html('&nbsp;');
                            }    
                            
                            if(err.responseJSON.PedProv_Obs)
                                {$('.error_obs').fadeIn().html(err.responseJSON.PedProv_Obs[0]);
                            }else{
                                $('.error_obs').fadeIn().html('&nbsp;');
                            }         
                            
                            //det
                            if(err.responseJSON.Id_Art_1)
                                {$('#aviso').fadeIn().html('Es obligatario al menos un artículo para continuar');
                            }else{
                                $('#aviso').fadeIn().html('&nbsp;');
                            }  

                            if(err.responseJSON.Art_Cant_1 || err.responseJSON.Art_Cant_2 ||                                 
                                err.responseJSON.Art_Cant_3 || err.responseJSON.Art_Cant_4 || 
                                err.responseJSON.Art_Cant_5 || err.responseJSON.Art_Cant_6 || 
                                err.responseJSON.Art_Cant_7 || err.responseJSON.Art_Cant_8)
                                {$('#aviso').fadeIn().html('Error en la cantidad de artículo');
                            }else{
                                $('#aviso').fadeIn().html('&nbsp;');
                            }  
                        } 
                        //si no hay error devuelve cannot read 0 of undefined, no se crea el objeto, por eso if else
                    }
                }); 
            }
        }); 
    });
});