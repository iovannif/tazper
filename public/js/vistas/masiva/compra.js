window.addEventListener("load", function(){
    $(document).ready(function(){
        // masiva
        //set
        if(sessionStorage.getItem('compra_masiva')!=null){
            var check=document.getElementById('masiva');
            var chequeado=sessionStorage.getItem('compra_masiva');
            check.checked=chequeado; //marca
        }
        //get
        $('#masiva').click(function(){
            if($(this).is(':checked')){
                var check=document.getElementById('masiva');
                sessionStorage.setItem('compra_masiva', check.checked);                
            }else{
                sessionStorage.removeItem('compra_masiva');
            }
            $('#fac').focus();
        });        

        //registrar
        $('#registrar').click(function(){
            if($('#masiva').is(':checked')){
                event.preventDefault();  

                var fac=$('#fac').val();
                var prov=$('input[name=Id_Prov]').val();
                var pedprov=$('#ped').val();
                var oc=$('input[name=Id_OC]').val();                
                var medpag=$('select[name=Id_MedPag]').val();                                                                         
                                        
                var stexe=$('input[name=Com_StExe]').val();
                var stiva5=$('input[name=Com_St5]').val();
                var stiva10=$('input[name=Com_St10]').val();
                var tot=$('input[name=Com_Total]').val();
                var liq5=$('input[name=Com_Liq5]').val();
                var liq10=$('input[name=Com_Liq10]').val();
                var totliq=$('input[name=Com_TotIva]').val();      

                //detalle
                var art_id_1=$('#art_id_1').val();
                var cant_art_1=$('#cant_art_1').val();
                var exen_1=$('#exen_1').val();
                var iva5_1=$('#iva5_1').val();
                var iva10_1=$('#iva10_1').val();

                var art_id_2=$('#art_id_2').val();
                var cant_art_2=$('#cant_art_2').val();
                var exen_2=$('#exen_2').val();
                var iva5_2=$('#iva5_2').val();
                var iva10_2=$('#iva10_2').val();
                
                var art_id_3=$('#art_id_3').val();
                var cant_art_3=$('#cant_art_3').val();
                var exen_3=$('#exen_3').val();
                var iva5_3=$('#iva5_3').val();
                var iva10_3=$('#iva10_3').val();
                
                var art_id_4=$('#art_id_4').val();
                var cant_art_4=$('#cant_art_4').val();
                var exen_4=$('#exen_4').val();
                var iva5_4=$('#iva5_4').val();
                var iva10_4=$('#iva10_4').val();
                
                var art_id_5=$('#art_id_5').val();
                var cant_art_5=$('#cant_art_5').val();
                var exen_5=$('#exen_5').val();
                var iva5_5=$('#iva5_5').val();
                var iva10_5=$('#iva10_5').val();
                
                var art_id_6=$('#art_id_6').val();
                var cant_art_6=$('#cant_art_6').val();
                var exen_6=$('#exen_6').val();
                var iva5_6=$('#iva5_6').val();
                var iva10_6=$('#iva10_6').val();
                
                var art_id_7=$('#art_id_7').val();
                var cant_art_7=$('#cant_art_7').val();
                var exen_7=$('#exen_7').val();
                var iva5_7=$('#iva5_7').val();
                var iva10_7=$('#iva10_7').val();
                
                var art_id_8=$('#art_id_8').val();
                var cant_art_8=$('#cant_art_8').val();
                var exen_8=$('#exen_8').val();
                var iva5_8=$('#iva5_8').val();
                var iva10_8=$('#iva10_8').val();

                $.ajax({
                    async:false,
                    url: '/Tazper/public/Compras',
                    type: 'POST',
                    headers: {
                        "X-CSRF-TOKEN":$("input[name=_token]").val()
                    },
                    data: {
                        Com_Fac: fac,                        
                        Id_PedProv: pedprov,
                        Id_Prov: prov,
                        Id_OC: oc,
                        Id_MedPag: medpag,

                        Com_StExe: stexe,
                        Com_St5: stiva5,
                        Com_St10: stiva10,
                        Com_Total: tot,
                        Com_Liq5: liq5,
                        Com_Liq10: liq10,
                        Com_TotIva: totliq,

                        Id_Art_1: art_id_1,
                        Art_Cant_1: cant_art_1,
                        Art_Exen_1: exen_1,
                        Art_Iva5_1: iva5_1,
                        Art_Iva10_1: iva10_1,

                        Id_Art_2: art_id_2,
                        Art_Cant_2: cant_art_2,
                        Art_Exen_2: exen_2,                            
                        Art_Iva5_2: iva5_2,                            
                        Art_Iva10_2: iva10_2,                            
                        
                        Id_Art_3: art_id_3,
                        Art_Cant_3: cant_art_3,
                        Art_Exen_3: exen_3,
                        Art_Iva5_3: iva5_3,
                        Art_Iva10_3: iva10_3,
                        
                        Id_Art_4: art_id_4,
                        Art_Cant_4: cant_art_4,
                        Art_Exen_4: exen_4,
                        Art_Iva5_4: iva5_4,
                        Art_Iva10_4: iva10_4,
                        
                        Id_Art_5: art_id_5,
                        Art_Cant_5: cant_art_5,
                        Art_Exen_5: exen_5,
                        Art_Iva5_5: iva5_5,
                        Art_Iva10_5: iva10_5,
                        
                        Id_Art_6: art_id_6,
                        Art_Cant_6: cant_art_6,
                        Art_Exen_6: exen_6,
                        Art_Iva5_6: iva5_6,
                        Art_Iva10_6: iva10_6,
                        
                        Id_Art_7: art_id_7,
                        Art_Cant_7: cant_art_7,
                        Art_Exen_7: exen_7,
                        Art_Iva5_7: iva5_7,
                        Art_Iva10_7: iva10_7,
                        
                        Id_Art_8: art_id_8,                        
                        Art_Cant_8: cant_art_8,
                        Art_Exen_8: exen_8,
                        Art_Iva5_8: iva5_8,
                        Art_Iva10_8: iva10_8,
                    },
                    success: function(){
                        console.log('success');
                        $('#agregado').show().delay(500).fadeOut(0);             

                        $('.help-block').html('&nbsp;');

                        setTimeout(function(){                            
                            document.getElementById("compra_form").reset();                                                        
                            $('#fac').focus(); 
                        }, 500);                                

                    },
                    error: function(err){
                        if(err.status == 422){    
                                // $('#busca_prov').focus();    
                            // $('.help-block').fadeIn().html(JSON.stringify(err.responseJSON)); //todo trae                                                                                                        
                            console.log(JSON.stringify(err.responseJSON));

                            //cab 
                            if(err.responseJSON.Com_Fac){
                                $('.err_fac').fadeIn().html(err.responseJSON.Com_Fac);
                                $('input[name=Com_Fac]').focus();
                            }else{
                                $('.err_fac').fadeIn().html('&nbsp;');
                                $('input[name=Com_Fac]').blur();
                            }

                            //det
                              
                            if(err.responseJSON.Art_Cant_1 || err.responseJSON.Art_Cant_2 ||                                 
                                err.responseJSON.Art_Cant_3 || err.responseJSON.Art_Cant_4 || 
                                err.responseJSON.Art_Cant_5 || err.responseJSON.Art_Cant_6 || 
                                err.responseJSON.Art_Cant_7 || err.responseJSON.Art_Cant_8)
                                {$('#aviso').fadeIn().html('Error en la cantidad de artículo');
                            }else{
                                // $('#aviso').fadeIn().html('&nbsp;');

                                if(err.responseJSON.Id_Art_1)
                                {$('#aviso').fadeIn().html('Es obligatario al menos un artículo para continuar');
                                    // console.log('ok');
                                }else{
                                    $('#aviso').fadeIn().html('&nbsp;');
                                }
                            }  
                        } 
                        //si no hay error devuelve cannot read 0 of undefined, no se crea el objeto, por eso if else
                    }
                }); 
            }
        }); 
    });
});