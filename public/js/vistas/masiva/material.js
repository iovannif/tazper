window.addEventListener("load", function(){
    $(document).ready(function(){
        // masiva
        //set
        if(sessionStorage.getItem('material_masiva')!=null){
            var check=document.getElementById('masiva');
            var chequeado=sessionStorage.getItem('material_masiva');
            check.checked=chequeado; //marca
        }
        //get
        $('#masiva').click(function(){
            if($(this).is(':checked')){
                var check=document.getElementById('masiva');
                sessionStorage.setItem('material_masiva', check.checked);                
            }else{
                sessionStorage.removeItem('material_masiva');
            }
            $('#des').focus();
        });        

        //registrar
        $('#registrar').click(function(){
            if($('#masiva').is(':checked')){
                event.preventDefault();  
                
                var des=$('#des').val();
                var pre=$('#pre').val();
                var med=$('#uni_med').val();
                var cant=$('#cant').val();
                var prov=$('#id_prov').val();   
                var imp=$('#id_imp').val();                           
                var est=$('#est').val();                
                var obs=$('#art_obs').val();                

                $.ajax({
                    async:false,
                    url: '/Tazper/public/Materiales',
                    type: 'POST', //create
                    headers: {
                        "X-CSRF-TOKEN":$("input[name=_token]").val()
                    },
                    data: {
                        Art_DesLar: des,
                        Art_PreCom: pre,
                        Art_UniMed: med,
                        Art_St: cant,                        
                        Id_Prov: prov,    
                        Id_Imp: imp, 
                        Art_Est: est,
                        Art_Obs: obs,
                    },
                    success: function(){
                        console.log('success');
                        $('#agregado').show().delay(500).fadeOut(0);

                        $('.error_des').html('&nbsp;');
                        $('.error_pre').html('&nbsp;');
                        $('.error_unimed').html('&nbsp;');
                        $('.error_cant').html('&nbsp;');
                        $('.error_imp').html('&nbsp;');  
                        $('.error_est').html('&nbsp;');
                        $('.error_obs').html('&nbsp;');

                        setTimeout(function(){
                            $('#des').val('');
                            $('#pre').val('');
                            $('#uni_med').val('');         
                            $('#cant').val('');
                            $('#id_prov').val('');  
                            $('#imp').val('');                            
                            $('#busca_prov').val('');
                            $('#cambiar').css('display','none');     
                            // $('#est').val('');                
                            $('#art_obs').val('');                            

                            document.getElementById("mat_form").reset(); 
                            $('input').prop('disabled',false);
                            $('#des').focus(); 
                        }, 500);                                

                    },
                    error: function(err){
                        if(err.status == 422){    
                            $('#des').focus();    
                            // $('.help-block').fadeIn().html(JSON.stringify(err.responseJSON));
                            
                            if(err.responseJSON.Art_DesLar)
                                {$('.error_des').fadeIn().html(err.responseJSON.Art_DesLar[0]); //first
                            }else{
                                $('.error_des').fadeIn().html('&nbsp;');
                            }
                            
                            if(err.responseJSON.Art_PreCom)
                                {$('.error_pre').fadeIn().html(err.responseJSON.Art_PreCom[0]);
                            }else{
                                $('.error_pre').fadeIn().html('&nbsp;');
                            }

                            if(err.responseJSON.Art_UniMed)
                                {$('.error_unimed').fadeIn().html(err.responseJSON.Art_UniMed[0]);
                            }else{
                                $('.error_unimed').fadeIn().html('&nbsp;');
                            }
                            
                            if(err.responseJSON.Art_St)
                                {$('.error_cant').fadeIn().html(err.responseJSON.Art_St[0]);
                            }else{
                                $('.error_cant').fadeIn().html('&nbsp;');
                            }
                            
                            if(err.responseJSON.Art_Est)
                                {$('.error_est').fadeIn().html(err.responseJSON.Art_Est[0]);
                            }else{
                                $('.error_est').fadeIn().html('&nbsp;');
                            }

                            if(err.responseJSON.Id_Imp)
                                {$('.error_imp').fadeIn().html(err.responseJSON.Id_Imp[0]);
                            }else{
                                $('.error_imp').fadeIn().html('&nbsp;');
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