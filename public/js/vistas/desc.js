window.addEventListener("load", function(){
    $(document).ready(function(){
        //check
        window.lp=[];
        window.cli=[];
        window.cat=[];
        window.prod=[];
        window.porc=[];

        //Mostrar Cuadros
        //clientes        
        $('#cli_cat').click(function(){
            $('.categorias_cli').show();
            $('.clientes_cli').hide();

            $('.categorias_cli input[type=checkbox]').prop('disabled',false).css('cursor','hand');
            // $('.clientes_cli input[type=checkbox]').prop('disabled',true).css('cursor','default').prop('checked',false);

            // window.cli=[];
        });

        $('#cli_cli').click(function(){
            $('.clientes_cli').show();
            $('.categorias_cli').hide();

            $('.clientes_cli input[type=checkbox]').prop('disabled',false).css('cursor','hand');
            // $('.categorias_cli input[type=checkbox]').prop('disabled',true).css('cursor','default').prop('checked',false);

            // window.lp=[];
        });

        $('#cli_tod').click(function(){
            $('.categorias_cli,.clientes_cli').hide();
            $('.categorias_cli,.clientes_cli').prop('disabled',true).hide().css('cursor','default').prop('checked',false);

            $('.categorias_cli input[type=checkbox],.clientes_cli input[type=checkbox]').prop('disabled',true).css('cursor','default').prop('checked',false);
            
            window.lp=[];
            window.cli=[];
        });            

        //productos        
        $('#prod_cat').click(function(){
            $('.categorias_prod').show();
            $('.productos_prod').hide();

            $('.categorias_prod input[type=checkbox]').prop('disabled',false).css('cursor','hand');
            // $('.productos_prod input[type=checkbox]').prop('disabled',true).css('cursor','default').prop('checked',false);  
            
            $('.categorias_prod input[type=number]').prop('disabled',false);
            $('.porc_todos input').val(''); //.productos_prod .porc, 
            
            // window.prod=[]
        });

        $('#prod_prod').click(function(){
            $('.productos_prod').show();
            $('.categorias_prod').hide();

            $('.productos_prod input[type=checkbox]').prop('disabled',false).css('cursor','hand');
            // $('.categorias_prod input[type=checkbox]').prop('disabled',true).css('cursor','default').prop('checked',false);   
            
            $('.productos_prod input[type=number]').prop('disabled',false); // .categorias_prod .porc, 
            $('.porc_todos input').val('');            
            
            // window.cat=[]
        });

        $('#prod_tod').click(function(){
            $('.categorias_prod,.productos_prod').hide();
            $('#porc_tod').focus();

            $('.categorias_prod input[type=checkbox],.productos_prod input[type=checkbox]').prop('disabled',true).css('cursor','default').prop('checked',false);                    
            // $('.porc_todos input').reset();
            // document.getElementById("porc_tod").reset();
            // $('.porc_todos input')[0].reset();
            // $('input').get(0).reset();            
            $('.categorias_prod .porc, .productos_prod .porc, .porc_todos input').val('');  
            
            window.cat=[];
            window.prod=[];            
        });        

        $('#porc_tod').focus(function(){
            $('.porc').val('');
        });
        
        //Check        
        //cat cli
        $('.categorias_cli input[type=checkbox]').click(function(){                     
            if($('.categorias_cli input[type=checkbox]:hover').is(':checked')){
                // console.log($(this).attr('class'));
                window.lp.push($(this).attr('class')); //agrega                                   
            }else{
                // console.log('lp');
                window.lp.splice(window.lp.indexOf($(this).attr('class')),1); //saca
                //si no especificas el lugar se lleva hasta el final
            }
            console.log('lp '+window.lp);            
        });

        //cli
        $('.clientes_cli input[type=checkbox]').click(function(){                 
            if($('.clientes_cli input[type=checkbox]:hover').is(':checked')){
                // console.log($(this).attr('class'));                                   
                window.cli.push($(this).attr('class')); //agrega
            }else{
                // console.log('cli');  
                window.cli.splice(window.cli.indexOf($(this).attr('class')),1); //saca 
            }
            console.log('cli '+window.cli);      
        });

        //cat prod
        $('.categorias_prod input[type=checkbox]').click(function(){                 
            if($('.categorias_prod input[type=checkbox]:hover').is(':checked')){
                // console.log($(this).attr('class'));  
                window.cat.push($(this).attr('class')); //agrega                     
                // $('tr:hover').find('.porc').focus(); 
                $('.cat:hover').find('.porc').focus();                            
            }else{
                // console.log('cat');    
                window.cat.splice(window.cat.indexOf($(this).attr('class')),1); //saca 
            }     
            console.log('cat '+window.cat);      
        });

        //prod
        $('.productos_prod input[type=checkbox]').click(function(){            
            if($('.productos_prod input[type=checkbox]:hover').is(':checked')){
                // console.log($(this).attr('class'));       
                window.prod.push($(this).attr('class')); //agrega 
                $('.prod:hover').find('.porc').focus();                 
            }else{
                // console.log('prod');    
                window.prod.splice(window.prod.indexOf($(this).attr('class')),1); //saca 
            }    
            console.log('prod '+window.prod);              
        });
        
        //Enviar
        $('#registrar').click(function(){
            event.preventDefault();    

            //para todos
            if($("#cli_tod").is(':checked')){ 
                window.lp.push('0');
                window.cli.push('0');
                // console.log(window.lp);    
            }
            //sobre todos
            if($("#prod_tod").is(':checked')){ 
                window.cat.push('0');
                window.prod.push('0');
            }              

            //porc
            if($("#porc_tod").val()!=''){ 
                window.porc.push($("#porc_tod").val());                                     

            }else{
            // else if($("#prod_cat").is(':checked')){
                window.cat=[];                

                $(".categorias_prod tr").each(function(){
                    if($(this).find('input[type=checkbox]').is(':checked')){
                        // console.log($(this).find('.porc').val()); 
                        // window.porc.push($(this).find('input[type=checkbox]').attr('class')+' '+$(this).find('.porc').val());

                        window.cat.push($(this).find('input[type=checkbox]').attr('class'));
                        window.porc.push($(this).find('.porc').val());
                    }                    
                });
                // console.log('porc cat: '+Cat_Porc);
                // window.porc.push('');
            // }else if($("#prod_prod").is(':checked')){
                window.prod=[];

                $(".productos_prod tr").each(function(){
                    if($(this).find('input[type=checkbox]').is(':checked')){
                        // console.log($(this).find('.porc').val()); 
                        // window.porc.push($(this).find('input[type=checkbox]').attr('class')+' '+$(this).find('.porc').val());
                        
                        window.prod.push($(this).find('input[type=checkbox]').attr('class'));
                        window.porc.push($(this).find('.porc').val());
                    }                    
                });            
                // console.log('sobre prod: '+Prod_Porc);
            // }  
            }                                   
                                    
            //ajax
            // Cabecera    
            var Desc_Tip=$('input[name=Desc_Tip]').val();
            var Desc_Des=$('input[name=Desc_Des]').val();
            var Desc_Obs=$('textarea[name=Desc_Obs]').val();
            // console.log(Desc_Tip+Desc_Des+Desc_Obs);

            // var lp=window.lp.join(',');
            // var cli=window.cli.join(',');
            // var cat=window.cat.join(',');
            // var prod=window.prod.join(',');
            // var porc=window.porc.join(',');
            // console.log('lp '+lp);
            // console.log('cli '+cli);
            // console.log('cat '+cat);
            // console.log('prod '+prod);
            // console.log('porc '+porc);

            // var Porc=0;
                         
            $.ajax({
                async:false, //
                headers: {
                    "X-CSRF-TOKEN":$("input[name=_token]").val()
                },
                type: 'POST',
                url: '/Tazper/public/Descuento',
                dataType: 'json',                
                data: {
                    Desc_Tip: Desc_Tip,
                    Desc_Des: Desc_Des,
                    Desc_Obs: Desc_Obs,
                },        
                // data: 'ids='+los_id, //pasar todos a array string
                // success: function(data){
                //     console.log('success');
                //     //mensaje, redireccion
                //     // location.href = '/Tazper/public/Descuento';
                // },                                                                                    
                error: function(err){ //se puede de una vez
                    // alert('koi');
                    // console.log(JSON.stringify(err.responseJSON));
                    if(JSON.stringify(err.responseJSON)==undefined){
                        // console.log('kurra');      

                        //success // Detalle                                    
                        $.ajax({
                            async:false,
                            headers: {
                                "X-CSRF-TOKEN":$("input[name=_token]").val()
                            },
                            type: 'POST',
                            url: '/Tazper/public/Descuento_detalle',
                            dataType: 'json',
                            data: {
                                lp: window.lp,
                                cli: window.cli,
                                cat: window.cat,
                                prod: window.prod,
                                porc: window.porc
                            },
                            // data: 'lp='+lp, //string //para eliminar de una vez
                            // data: 'ids='+los_id,
                            // data: {DD_Porc: window.lp}, //juntos
                            
                            // lp cli cat prod porc
                            error: function(err){
                                if(JSON.stringify(err.responseJSON)==undefined){
                                    console.log('success');
                                    // console.log('lp='+lp);                              
                                }
                            },
                        });                                

                        location.href = '/Tazper/public/Descuento';
                        // console.log(Porc);
                    }else{
                        console.log(JSON.stringify(err.responseJSON));

                        $('.primer').focus();
                        
                        if(err.status == 422){                                
                            if(err.responseJSON.Desc_Tip)
                                {$('.error_tip').fadeIn().html(err.responseJSON.Desc_Tip[0]);
                            }else{
                                $('.error_tip').fadeIn().html('&nbsp;');
                            }  

                            if(err.responseJSON.Desc_Des)
                                {$('.error_des').fadeIn().html(err.responseJSON.Desc_Des[0]);
                            }else{
                                $('.error_des').fadeIn().html('&nbsp;');
                            }  
                            
                            if(err.responseJSON.Desc_Obs)
                                {$('.error_obs').fadeIn().html(err.responseJSON.Desc_Obs[0]);
                            }else{
                                $('.error_obs').fadeIn().html('&nbsp;');
                            }  
                        }
                    }
                },
            });     

                // var promise = 

                //     $.ajax({
                        
                //         headers: {
                //             "X-CSRF-TOKEN":$("input[name=_token]").val()
                //         },
                //         type: 'POST',
                //         url: '/Tazper/public/Descuento',
                //         dataType: 'json',                
                //         data: {
                //             Desc_Tip: Desc_Tip,
                //             Desc_Des: Desc_Des,
                //             Desc_Obs: Desc_Obs,
                //         }              
                //     });     

                //   promise.fail( function() {
                //     window.alert("Fail!");
                //   });
                
                //   promise.done( function() {
                //     window.alert("Success!");
                //   });            
        });
                
        //reset
        $('#limpiar').click(function(){
            $('.cuadro').hide();
        });
    });
});