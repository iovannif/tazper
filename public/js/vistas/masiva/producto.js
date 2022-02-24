window.addEventListener("load", function(){
    $(document).ready(function(){
        // masiva
        //set
        if(sessionStorage.getItem('producto_masiva')!=null){
            var check=document.getElementById('masiva');
            var chequeado=sessionStorage.getItem('producto_masiva');
            check.checked=chequeado; //marca
        }
        //get
        $('#masiva').click(function(){
            if($(this).is(':checked')){
                var check=document.getElementById('masiva');
                sessionStorage.setItem('producto_masiva', check.checked);                
            }else{
                sessionStorage.removeItem('producto_masiva');
            }
            $('#des_lar').focus();
        });        

        //registrar
        $('#registrar').click(function(){
            if($('#masiva').is(':checked')){
                event.preventDefault();  
                
                var des_lar=$('#des_lar').val();
                var des_cor=$('#des_cor').val();
                var cat=$('#id_cat').val();
                var tip_prod=$('#tip_prod').val();
                var imp=$('#id_imp').val();
                var pre_com=$('#pre_com').val();
                var gan_min=$('#gan_min').val();
                var pre_ven=$('#pre_ven').val();
                var stock=$('#stock').val();
                var st_mn=$('#st_mn').val();
                var st_mx=$('#st_mx').val();
                var prov=$('#id_prov').val();                                              
                var est=$('#est').val();                
                var obs=$('#art_obs').val();                

                $.ajax({
                    async:false,
                    url: '/Tazper/public/Productos',
                    type: 'POST', //create
                    headers: {
                        "X-CSRF-TOKEN":$("input[name=_token]").val()
                    },
                    data: {
                        Art_DesLar: des_lar,
                        Art_DesCor: des_cor,
                        Tip_Prod: tip_prod,
                        Id_Cat: cat,
                        Id_Imp: imp,
                        Art_PreCom: pre_com,
                        Art_GanMin: gan_min,
                        Art_PreVen: pre_ven,                                                
                        Art_St: stock,                        
                        Art_StMn: st_mn,                        
                        Art_StMx: st_mx,                        
                        Id_Prov: prov,    
                        Art_Est: est,
                        Art_Obs: obs,
                    },
                    success: function(){
                        console.log('success');
                        $('#agregado').show().delay(500).fadeOut(0);

                        $('.error_deslar').html('&nbsp;');
                        $('.error_descor').html('&nbsp;');
                        $('.error_imp').html('&nbsp;');                    
                        $('.error_precom').html('&nbsp;');                    
                        $('.error_ganmin').html('&nbsp;');
                        $('.error_preven').html('&nbsp;');
                        $('.error_st').html('&nbsp;');
                        $('.error_est').html('&nbsp;');
                        $('.error_obs').html('&nbsp;');

                        setTimeout(function(){
                            $('#des_lar').val('');
                            $('#des_cor').val('');

                            $('#cat').val('');
                            $('#imp').val('');
                            $('#pre_com').val('');
                            $('#gan_min').val('');
                            $('#pre_ven').val('');
                            $('#stock').val('');
                            $('#st_mn').val('');
                            $('#st_mx').val('');
                            $('#id_prov').val('');                              
                            $('#busca_prov').val('');
                            $('#art_obs').val('');   
                            
                            $('.cambiar').css('display','none');       
                            document.getElementById("prod_form").reset();             
                            $('input').prop('disabled',false);                                                                                                              
                            $('#des_lar').focus(); 
                        }, 500);                                

                    },
                    error: function(err){
                        if(err.status == 422){    
                            $('#des').focus();    
                            // $('.help-block').fadeIn().html(JSON.stringify(err.responseJSON));                            
                            
                            if(err.responseJSON.Art_DesLar)
                                {$('.error_deslar').fadeIn().html(err.responseJSON.Art_DesLar[0]); //first
                            }else{
                                $('.error_deslar').fadeIn().html('&nbsp;');
                            }

                            if(err.responseJSON.Art_DesCor)
                                {$('.error_descor').fadeIn().html(err.responseJSON.Art_DesCor[0]);
                            }else{
                                $('.error_descor').fadeIn().html('&nbsp;');
                            }

                            if(err.responseJSON.Id_Imp)
                                {$('.error_imp').fadeIn().html(err.responseJSON.Id_Imp[0]);
                            }else{
                                $('.error_imp').fadeIn().html('&nbsp;');
                            }
                            
                            if(err.responseJSON.Art_PreCom)
                                {$('.error_precom').fadeIn().html(err.responseJSON.Art_PreCom[0]);
                            }else{
                                $('.error_precom').fadeIn().html('&nbsp;');
                            }

                            if(err.responseJSON.Art_GanMin)
                                {$('.error_ganmin').fadeIn().html(err.responseJSON.Art_GanMin[0]);
                            }else{
                                $('.error_ganmin').fadeIn().html('&nbsp;');
                            }

                            if(err.responseJSON.Art_PreVen)
                                {$('.error_preven').fadeIn().html(err.responseJSON.Art_PreVen[0]);
                            }else{
                                $('.error_preven').fadeIn().html('&nbsp;');
                            }
                            
                            if(err.responseJSON.Art_St)
                                {$('.error_st').fadeIn().html(err.responseJSON.Art_St[0]);
                            }else{
                                $('.error_st').fadeIn().html('&nbsp;');
                            }
                            
                            if(err.responseJSON.Art_StMn)
                                {$('.error_stmn').fadeIn().html(err.responseJSON.Art_StMn[0]);
                            }else{
                                $('.error_stmn').fadeIn().html('&nbsp;');
                            }
                            
                            if(err.responseJSON.Art_StMx)
                                {$('.error_stmx').fadeIn().html(err.responseJSON.Art_StMx[0]);
                            }else{
                                $('.error_stmx').fadeIn().html('&nbsp;');
                            }
                            
                            if(err.responseJSON.Art_Est)
                                {$('.error_est').fadeIn().html(err.responseJSON.Art_Est[0]);
                            }else{
                                $('.error_est').fadeIn().html('&nbsp;');
                            }
                            
                            if(err.responseJSON.Art_Obs)
                                {$('.error_obs').fadeIn().html(err.responseJSON.Art_Obs[0]);
                            }else{
                                $('.error_obs').fadeIn().html('&nbsp;');
                            }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                        } 
                        //si no hay error devuelve cannot read 0 of undefined, no se crea el objeto, por eso if else
                    }
                }); 
            }
        }); 
    });
});