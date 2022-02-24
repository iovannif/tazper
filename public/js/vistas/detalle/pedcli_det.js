window.addEventListener("load", function(){
    //Agregar
    $('#agregar').click(function(){
        event.preventDefault();

        if($('#art_des').val()!='' & $('#art_cant').val()!='' 
            & $('#art_cant').val()>0 & $('#art_cant').val()%1==0){
            // & Math.sign($('#art_cant').val())!=-1 & Math.sign($('#art_cant').val())!=-0)       
            //Si ya está en lista //suma cant imp
            if($('#des_art_8').val()!=''){
                $('#aviso').html('&nbsp;');
            }

            if($('#art_des').val()==$('#des_art_1').val()){                        
                var cantidad=parseInt($('#cant_art_1').val());
                cantidad=cantidad+parseInt($('#art_cant').val());

                $('#cant_art_1').val(cantidad);
                
                //desc
                if(window.cli_desc>0){
                    desc_cli=window.cli_desc;
                }else{
                    desc_cli=0;
                }   

                if(cantidad>=15){ //10%
                    var desc_may=10;
                    
                    $('#may_1').val(desc_may+'%');   
                }else{
                    var desc_may=0;
                }  

                desc=parseInt(desc_cli)+parseInt(desc_may);

                if(desc>0){
                    var descontar=$('#art_pre').val()*desc; //0.
                    var descontar=descontar/100;
                }else{
                    var descontar=0;
                }                                

                var pre=$('#art_pre').val()-descontar;

                $('#imp_1').val(pre*cantidad);   

            }else if($('#art_des').val()==$('#des_art_2').val()){
                var cantidad=parseInt($('#cant_art_2').val());
                cantidad=cantidad+parseInt($('#art_cant').val());

                $('#cant_art_2').val(cantidad);
                
                //desc
                if(window.cli_desc>0){
                    desc_cli=window.cli_desc;
                }else{
                    desc_cli=0;
                }   

                if(cantidad>=15){ //10%
                    var desc_may=10;
                    
                    $('#may_2').val(desc_may+'%');   
                }else{
                    var desc_may=0;
                }  

                desc=parseInt(desc_cli)+parseInt(desc_may);

                if(desc>0){
                    var descontar=$('#art_pre').val()*desc; //0.
                    var descontar=descontar/100;
                }else{
                    var descontar=0;
                }                                

                var pre=$('#art_pre').val()-descontar;

                $('#imp_2').val(pre*cantidad);   

            }else if($('#art_des').val()==$('#des_art_3').val()){
                var cantidad=parseInt($('#cant_art_3').val());
                cantidad=cantidad+parseInt($('#art_cant').val());

                $('#cant_art_3').val(cantidad);
                
                //desc
                if(window.cli_desc>0){
                    desc_cli=window.cli_desc;
                }else{
                    desc_cli=0;
                }   

                if(cantidad>=15){ //10%
                    var desc_may=10;
                    
                    $('#may_3').val(desc_may+'%');   
                }else{
                    var desc_may=0;
                }  

                desc=parseInt(desc_cli)+parseInt(desc_may);

                if(desc>0){
                    var descontar=$('#art_pre').val()*desc; //0.
                    var descontar=descontar/100;
                }else{
                    var descontar=0;
                }                                

                var pre=$('#art_pre').val()-descontar;

                $('#imp_3').val(pre*cantidad);   

            }else if($('#art_des').val()==$('#des_art_4').val()){
                var cantidad=parseInt($('#cant_art_4').val());
                cantidad=cantidad+parseInt($('#art_cant').val());

                $('#cant_art_4').val(cantidad);
                
                //desc
                if(window.cli_desc>0){
                    desc_cli=window.cli_desc;
                }else{
                    desc_cli=0;
                }   

                if(cantidad>=15){ //10%
                    var desc_may=10;
                    
                    $('#may_4').val(desc_may+'%');   
                }else{
                    var desc_may=0;
                }  

                desc=parseInt(desc_cli)+parseInt(desc_may);

                if(desc>0){
                    var descontar=$('#art_pre').val()*desc; //0.
                    var descontar=descontar/100;
                }else{
                    var descontar=0;
                }                                

                var pre=$('#art_pre').val()-descontar;

                $('#imp_4').val(pre*cantidad);   

            }else if($('#art_des').val()==$('#des_art_5').val()){
                var cantidad=parseInt($('#cant_art_5').val());
                cantidad=cantidad+parseInt($('#art_cant').val());

                $('#cant_art_5').val(cantidad);
                
                //desc
                if(window.cli_desc>0){
                    desc_cli=window.cli_desc;
                }else{
                    desc_cli=0;
                }   

                if(cantidad>=15){ //10%
                    var desc_may=10;
                    
                    $('#may_5').val(desc_may+'%');   
                }else{
                    var desc_may=0;
                }  

                desc=parseInt(desc_cli)+parseInt(desc_may);

                if(desc>0){
                    var descontar=$('#art_pre').val()*desc; //0.
                    var descontar=descontar/100;
                }else{
                    var descontar=0;
                }                                

                var pre=$('#art_pre').val()-descontar;

                $('#imp_5').val(pre*cantidad);   

            }else if($('#art_des').val()==$('#des_art_6').val()){
                var cantidad=parseInt($('#cant_art_6').val());
                cantidad=cantidad+parseInt($('#art_cant').val());

                $('#cant_art_6').val(cantidad);
                
                //desc
                if(window.cli_desc>0){
                    desc_cli=window.cli_desc;
                }else{
                    desc_cli=0;
                }   

                if(cantidad>=15){ //10%
                    var desc_may=10;
                    
                    $('#may_6').val(desc_may+'%');   
                }else{
                    var desc_may=0;
                }  

                desc=parseInt(desc_cli)+parseInt(desc_may);

                if(desc>0){
                    var descontar=$('#art_pre').val()*desc; //0.
                    var descontar=descontar/100;
                }else{
                    var descontar=0;
                }                                

                var pre=$('#art_pre').val()-descontar;

                $('#imp_6').val(pre*cantidad);   

            }else if($('#art_des').val()==$('#des_art_7').val()){
                var cantidad=parseInt($('#cant_art_7').val());
                cantidad=cantidad+parseInt($('#art_cant').val());

                $('#cant_art_7').val(cantidad);
                
                //desc
                if(window.cli_desc>0){
                    desc_cli=window.cli_desc;
                }else{
                    desc_cli=0;
                }   

                if(cantidad>=15){ //10%
                    var desc_may=10;
                    
                    $('#may_7').val(desc_may+'%');   
                }else{
                    var desc_may=0;
                }  

                desc=parseInt(desc_cli)+parseInt(desc_may);

                if(desc>0){
                    var descontar=$('#art_pre').val()*desc; //0.
                    var descontar=descontar/100;
                }else{
                    var descontar=0;
                }                                

                var pre=$('#art_pre').val()-descontar;

                $('#imp_7').val(pre*cantidad);   

            }else if($('#art_des').val()==$('#des_art_8').val()){
                var cantidad=parseInt($('#cant_art_8').val());
                cantidad=cantidad+parseInt($('#art_cant').val());

                $('#cant_art_8').val(cantidad);
                
                //desc
                if(window.cli_desc>0){
                    desc_cli=window.cli_desc;
                }else{
                    desc_cli=0;
                }   

                if(cantidad>=15){ //10%
                    var desc_may=10;
                    
                    $('#may_8').val(desc_may+'%');   
                }else{
                    var desc_may=0;
                }  

                desc=parseInt(desc_cli)+parseInt(desc_may);

                if(desc>0){
                    var descontar=$('#art_pre').val()*desc; //0.
                    var descontar=descontar/100;
                }else{
                    var descontar=0;
                }                                

                var pre=$('#art_pre').val()-descontar;

                $('#imp_8').val(pre*cantidad);   
                
            }else{
                //Si no está                                        
                if($('#des_art_1').val()==''){
                    $('#art_id_1').val($('#id_art').val());           
                    $('#des_art_1').val($('#art_des').val());   
                    $('#pre_1').val($('#art_pre').val());   
                    $('#cant_art_1').val($('#art_cant').val());  
                    
                        //desc cli //func
                        // window.cli_desc=10;
                        if(window.cli_desc>0){
                            desc_cli=window.cli_desc;
                        }else{
                            desc_cli=0;
                        }                        

                        //desc may //
                        if($('#art_cant').val()>=15){ //10%
                            var desc_may=10;
                            
                            $('#may_1').val(desc_may+'%');   
                        }else{
                            var desc_may=0;
                        }         

                        desc=parseInt(desc_cli)+parseInt(desc_may);
                        if(desc>0){
                            var descontar=$('#art_pre').val()*desc; //0.
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }

                        var pre=$('#art_pre').val()-descontar;
                        // alert(descontar);    
                    
                    $('#imp_1').val(pre*$('#cant_art_1').val());   

                }else if($('#des_art_2').val()==''){
                    $('#art_id_2').val($('#id_art').val());           
                    $('#des_art_2').val($('#art_des').val());
                    $('#pre_2').val($('#art_pre').val());                                     
                    $('#cant_art_2').val($('#art_cant').val());                    
                    
                        if(window.cli_desc>0){
                            desc_cli=window.cli_desc;
                        }else{
                            desc_cli=0;
                        }                        

                        if($('#art_cant').val()>=15){
                            var desc_may=10;
                            
                            $('#may_2').val(desc_may+'%');   
                        }else{
                            var desc_may=0;
                        }         

                        desc=parseInt(desc_cli)+parseInt(desc_may);
                        if(desc>0){
                            var descontar=$('#art_pre').val()*desc;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        
                        var pre=$('#art_pre').val()-descontar;
                    
                    $('#imp_2').val(pre*$('#cant_art_2').val());

                }else if($('#des_art_3').val()==''){
                    $('#art_id_3').val($('#id_art').val());           
                    $('#des_art_3').val($('#art_des').val());                                  
                    $('#pre_3').val($('#art_pre').val());   
                    $('#cant_art_3').val($('#art_cant').val());           
                    
                        if(window.cli_desc>0){
                            desc_cli=window.cli_desc;
                        }else{
                            desc_cli=0;
                        }                        

                        if($('#art_cant').val()>=15){
                            var desc_may=10;
                            
                            $('#may_3').val(desc_may+'%');   
                        }else{
                            var desc_may=0;
                        }         

                        desc=parseInt(desc_cli)+parseInt(desc_may);
                        if(desc>0){
                            var descontar=$('#art_pre').val()*desc;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        
                        var pre=$('#art_pre').val()-descontar;
                    
                    $('#imp_3').val(pre*$('#cant_art_3').val());

                }else if($('#des_art_4').val()==''){
                    $('#art_id_4').val($('#id_art').val());           
                    $('#des_art_4').val($('#art_des').val());                                  
                    $('#pre_4').val($('#art_pre').val());   
                    $('#cant_art_4').val($('#art_cant').val());        
                    
                        if(window.cli_desc>0){
                            desc_cli=window.cli_desc;
                        }else{
                            desc_cli=0;
                        }                        

                        if($('#art_cant').val()>=15){
                            var desc_may=10;
                            
                            $('#may_4').val(desc_may+'%');   
                        }else{
                            var desc_may=0;
                        }         

                        desc=parseInt(desc_cli)+parseInt(desc_may);
                        if(desc>0){
                            var descontar=$('#art_pre').val()*desc;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        
                        var pre=$('#art_pre').val()-descontar;
                    
                    $('#imp_4').val(pre*$('#cant_art_4').val());

                }else if($('#des_art_5').val()==''){
                    $('#art_id_5').val($('#id_art').val());           
                    $('#des_art_5').val($('#art_des').val());                                  
                    $('#pre_5').val($('#art_pre').val());   
                    $('#cant_art_5').val($('#art_cant').val());        
                    
                        if(window.cli_desc>0){
                            desc_cli=window.cli_desc;
                        }else{
                            desc_cli=0;
                        }                        

                        if($('#art_cant').val()>=15){
                            var desc_may=10;
                            
                            $('#may_5').val(desc_may+'%');   
                        }else{
                            var desc_may=0;
                        }         

                        desc=parseInt(desc_cli)+parseInt(desc_may);
                        if(desc>0){
                            var descontar=$('#art_pre').val()*desc;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        
                        var pre=$('#art_pre').val()-descontar;
                    
                    $('#imp_5').val(pre*$('#cant_art_5').val());

                }else if($('#des_art_6').val()==''){
                    $('#art_id_6').val($('#id_art').val());           
                    $('#des_art_6').val($('#art_des').val());    
                    $('#pre_6').val($('#art_pre').val());   
                    $('#cant_art_6').val($('#art_cant').val());
                    
                        if(window.cli_desc>0){
                            desc_cli=window.cli_desc;
                        }else{
                            desc_cli=0;
                        }                        

                        if($('#art_cant').val()>=15){
                            var desc_may=10;
                            
                            $('#may_6').val(desc_may+'%');   
                        }else{
                            var desc_may=0;
                        }         

                        desc=parseInt(desc_cli)+parseInt(desc_may);
                        if(desc>0){
                            var descontar=$('#art_pre').val()*desc;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        
                        var pre=$('#art_pre').val()-descontar;
                    
                    $('#imp_6').val(pre*$('#cant_art_6').val());  

                }else if($('#des_art_7').val()==''){
                    $('#art_id_7').val($('#id_art').val());           
                    $('#des_art_7').val($('#art_des').val());    
                    $('#pre_7').val($('#art_pre').val());                                 
                    $('#cant_art_7').val($('#art_cant').val());

                        if(window.cli_desc>0){
                            desc_cli=window.cli_desc;
                        }else{
                            desc_cli=0;
                        }                        

                        if($('#art_cant').val()>=15){
                            var desc_may=10;
                            
                            $('#may_7').val(desc_may+'%');   
                        }else{
                            var desc_may=0;
                        }         

                        desc=parseInt(desc_cli)+parseInt(desc_may);
                        if(desc>0){
                            var descontar=$('#art_pre').val()*desc;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        
                        var pre=$('#art_pre').val()-descontar;
                    
                    $('#imp_7').val(pre*$('#cant_art_7').val());

                }else if($('#des_art_8').val()==''){
                    $('#art_id_8').val($('#id_art').val());           
                    $('#des_art_8').val($('#art_des').val()); 
                    $('#pre_8').val($('#art_pre').val());                                    
                    $('#cant_art_8').val($('#art_cant').val());

                        if(window.cli_desc>0){
                            desc_cli=window.cli_desc;
                        }else{
                            desc_cli=0;
                        }                        

                        if($('#art_cant').val()>=15){
                            var desc_may=10;
                            
                            $('#may_8').val(desc_may+'%');   
                        }else{
                            var desc_may=0;
                        }         

                        desc=parseInt(desc_cli)+parseInt(desc_may);
                        if(desc>0){
                            var descontar=$('#art_pre').val()*desc;
                            var descontar=descontar/100;
                        }else{
                            var descontar=0;
                        }
                        
                        var pre=$('#art_pre').val()-descontar;
                    
                    $('#imp_8').val(pre*$('#cant_art_8').val());
                    
                }else{                        
                    $('#aviso').html('Ha llegado al límite de ítems');                        
                }                                                
            }

            if($('#des_art_1').val()!=''){//Solo cuando se agrega, error no
                if($('#aviso').text()!='Ha llegado al límite de ítems'){ //limpia
                    $('#busca_producto').prop('disabled',false).val('').focus();
                    $('#busc_art .cambiar').css('display','none');   
                    $('#tabla_articulo input').val(''); 
                }                      
            }

            if($('#art_id_8').val()==''){
                $('#aviso').html('&nbsp;');
            }

            //total //func
            $('#total').val($('#imp_1').val());  

            if($('#pre_2').val()!=''){
                $('#total').val(
                    parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
                );  
            }   
            if($('#pre_3').val()!=''){
                $('#total').val(
                    parseInt($('#imp_1').val())+parseInt($('#imp_2').val())+parseInt($('#imp_3').val())
                );  
            }

            if($('#pre_4').val()!=''){
                $('#total').val(
                    parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
                    +parseInt($('#imp_3').val())+parseInt($('#imp_4').val())
                );  
            }       
                        
            if($('#pre_5').val()!=''){
                $('#total').val(
                    parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
                    +parseInt($('#imp_3').val())+parseInt($('#imp_4').val())
                    +parseInt($('#imp_5').val())
                );  
            }
            if($('#pre_6').val()!=''){
                $('#total').val(
                    parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
                    +parseInt($('#imp_3').val())+parseInt($('#imp_4').val())
                    +parseInt($('#imp_5').val())+parseInt($('#imp_6').val())
                );  
            }
            if($('#pre_7').val()!=''){
                $('#total').val(
                    parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
                    +parseInt($('#imp_3').val())+parseInt($('#imp_4').val())
                    +parseInt($('#imp_5').val())+parseInt($('#imp_6').val())
                    +parseInt($('#imp_7').val())
                );  
            }
            if($('#pre_8').val()!=''){
                $('#total').val(
                    parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
                    +parseInt($('#imp_3').val())+parseInt($('#imp_4').val())
                    +parseInt($('#imp_5').val())+parseInt($('#imp_6').val())
                    +parseInt($('#imp_7').val())+parseInt($('#imp_8').val())
                );  
            }            
        }
    });

    //quitar
    $('.quitar').click(function(){
        event.preventDefault();  
        $(this).css('visibility','hidden');                  
        $('.linea:hover input').val('');  
        
        if($('#des_art_1').val()==''){
            $('#art_id_1').val($('#art_id_2').val());                       
            $('#des_art_1').val($('#des_art_2').val());        
            $('#pre_1').val($('#pre_2').val());                                              
            $('#cant_art_1').val($('#cant_art_2').val());                      
            $('#may_1').val($('#may_2').val());                                   
            $('#imp_1').val($('#imp_2').val());                                   
            
            $('.linea_2 input').val('');  
        }
        if($('#des_art_2').val()==''){
            $('#art_id_2').val($('#art_id_3').val());                       
            $('#des_art_2').val($('#des_art_3').val());    
            $('#pre_2').val($('#pre_3').val());                                   
            $('#cant_art_2').val($('#cant_art_3').val());              
            $('#may_2').val($('#may_3').val());                                   
            $('#imp_2').val($('#imp_3').val());                                   

            $('.linea_3 input').val('');  
        }
        if($('#des_art_3').val()==''){
            $('#art_id_3').val($('#art_id_4').val());                       
            $('#des_art_3').val($('#des_art_4').val());                                  
            $('#pre_3').val($('#pre_4').val());     
            $('#cant_art_3').val($('#cant_art_4').val());  
            $('#may_3').val($('#may_4').val());                                   
            $('#imp_3').val($('#imp_4').val());     

            $('.linea_4 input').val('');  
        }

        if($('#des_art_4').val()==''){
            $('#art_id_4').val($('#art_id_5').val());                       
            $('#des_art_4').val($('#des_art_5').val());                                  
            $('#pre_4').val($('#pre_5').val());     
            $('#cant_art_4').val($('#cant_art_5').val());  
            $('#may_4').val($('#may_5').val());                                   
            $('#imp_4').val($('#imp_5').val());

            $('.linea_5 input').val('');  
        }
        if($('#des_art_5').val()==''){
            $('#art_id_5').val($('#art_id_6').val());                       
            $('#des_art_5').val($('#des_art_6').val());    
            $('#pre_5').val($('#pre_6').val());                                   
            $('#cant_art_5').val($('#cant_art_6').val());              
            $('#may_5').val($('#may_6').val());                                   
            $('#imp_5').val($('#imp_6').val());                                   

            $('.linea_6 input').val('');  
        }
        if($('#des_art_6').val()==''){
            $('#art_id_6').val($('#art_id_7').val());                       
            $('#des_art_6').val($('#des_art_7').val());                                  
            $('#pre_6').val($('#pre_7').val());     
            $('#cant_art_6').val($('#cant_art_7').val());  
            $('#may_6').val($('#may_7').val());                                               
            $('#imp_6').val($('#imp_7').val());     

            $('.linea_7 input').val('');  
        }
        if($('#des_art_7').val()==''){
            $('#art_id_7').val($('#art_id_8').val());                       
            $('#des_art_7').val($('#des_art_8').val());                                  
            $('#pre_7').val($('#pre_8').val());     
            $('#cant_art_7').val($('#cant_art_8').val());              
            $('#may_7').val($('#may_8').val());                                   
            $('#imp_7').val($('#imp_8').val());     

            $('.linea_8 input').val('');  
            
        }

        if($('#art_id_8').val()==''){
            $('#aviso').html('&nbsp;');
        }

        //total
        if($('#pre_1').val()!=''){
            $('#total').val($('#imp_1').val());  
        }else{
            $('#total').val(0);  
        }

        if($('#pre_2').val()!=''){
            $('#total').val(
                parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
            );  
        }   
        if($('#pre_3').val()!=''){
            $('#total').val(
                parseInt($('#imp_1').val())+parseInt($('#imp_2').val())+parseInt($('#imp_3').val())
            );  
        }

        if($('#pre_4').val()!=''){
            $('#total').val(
                parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
                +parseInt($('#imp_3').val())+parseInt($('#imp_4').val())
            );  
        }       
                 
        if($('#pre_5').val()!=''){
            $('#total').val(
                parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
                +parseInt($('#imp_3').val())+parseInt($('#imp_4').val())
                +parseInt($('#imp_5').val())
            );  
        }
        if($('#pre_6').val()!=''){
            $('#total').val(
                parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
                +parseInt($('#imp_3').val())+parseInt($('#imp_4').val())
                +parseInt($('#imp_5').val())+parseInt($('#imp_6').val())
            );  
        }
        if($('#pre_7').val()!=''){
            $('#total').val(
                parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
                +parseInt($('#imp_3').val())+parseInt($('#imp_4').val())
                +parseInt($('#imp_5').val())+parseInt($('#imp_6').val())
                +parseInt($('#imp_7').val())
            );  
        }
        if($('#pre_8').val()!=''){
            $('#total').val(
                parseInt($('#imp_1').val())+parseInt($('#imp_2').val())
                +parseInt($('#imp_3').val())+parseInt($('#imp_4').val())
                +parseInt($('#imp_5').val())+parseInt($('#imp_6').val())
                +parseInt($('#imp_7').val())+parseInt($('#imp_8').val())
            );  
        }

        $('#busca_producto').prop('disabled',false).focus(); 
    });    

    //css    
    $(".linea").mouseover(function(){
        if($(this).find('.art').val()!=''){
            $(this).find('.quitar').css('visibility','visible');
        }
    }); 
    $(".linea").mouseout(function(){
        if($(this).find('.art').val()!=''){
            $(this).find('.quitar').css('visibility','hidden');
        }
    });      
});