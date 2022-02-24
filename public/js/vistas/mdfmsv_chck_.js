
    $('#grupal').css('top','144px');    
    $('#siguiente').trigger('click');    

    //cargar pagina Set
    if(sessionStorage.getItem('productos_sesion')==null){
        window.productos_chequeados=[];
    }else{
        window.productos_chequeados=JSON.parse(sessionStorage.getItem('productos_sesion'));        
    }
    $('input.check').each(function(){
        var id=$(this).attr('id');        
        if(sessionStorage.getItem('producto_'+id)!=null){
            var chequeado=sessionStorage.getItem('producto_'+id);
        }else{
            var chequeado=false;
        }

        $(this).prop("checked", chequeado);
    });
    
    //check
    $('input.check').click(function(){
        //mostrar grupal
        $("input.check").each(function(){
            if($(this).is(':checked')){
                $('#grupal').css('visibility','visible');
                return false;
            }else{
                $('#grupal').css('visibility','hidden');
            }
        });                                    

        //Get
        var id=$(this).attr('id');
        
        if($(this).is(':checked')){
            sessionStorage.setItem('producto_'+id,true);
        }else{
            sessionStorage.setItem('producto_'+id,false);
        }        

        if(sessionStorage.getItem('producto_'+id)=='true'){
            window.productos_chequeados.push(id);            
        }else{
            sessionStorage.removeItem('producto_'+id);

            var index=window.productos_chequeados.indexOf(id);
            window.productos_chequeados.splice(index,1);
        }
        console.log('chequeados: '+window.productos_chequeados);
        
        //sesion productos
        sessionStorage.setItem('productos_sesion', JSON.stringify(window.productos_chequeados));
        console.log('sesion: '+JSON.parse(sessionStorage.getItem('productos_sesion')));  
        
        //todos marcados
        if(window.productos_chequeados.length==window.todos.length){
            $('#todo').prop('checked', true).prop('disabled', true);                
        }else{
            $('#todo').prop('checked',false).prop('disabled',false);
        }
    });  

    //marcar todo
    $('#todo').click(function(){
        if($('#todo').is(':checked')){
            window.marcando_todo='';

            if(window.pagina_actual!=1){
                $('#inicio').trigger('click');
            }else{
                $("input.check").each(function(){
                    $(this).prop('checked', true);

                    var id=$(this).attr('id');                                                        
                    sessionStorage.setItem('producto_'+id,true);                                                     
                    window.productos_chequeados.push(id);                                                                                            
                });                
                //sesion productos
                sessionStorage.setItem('productos_sesion', JSON.stringify(window.productos_chequeados));
                console.log('sesion: '+JSON.parse(sessionStorage.getItem('productos_sesion')));                                  

                if(window.pagina_actual==window.ultima_pagina){
                    window.marcando_todo='fin';                                
                    $('#todo').prop('checked', true).prop('disabled', true);
                    $('#grupal').css('visibility','visible');
                }else{
                    $('#siguiente').trigger('click');
                }
            }                
        }            
    });
    
    //cargar pagina
        window.marcados=[];        
    
    $("input.check").each(function(){            
        if(window.productos_chequeados.length!=0){ 
            $('#grupal').css('visibility','visible');
        }
    });

    if(window.productos_chequeados.length==window.todos.length){
        $('#todo').prop('checked', true).prop('disabled', true);                
    }else{
        $('#todo').prop('checked',false).prop('disabled',false);
    }

    //cancelar marcado
    $('#cancelar_grupo').click(function(){
        window.productos_chequeados.forEach(
            element => sessionStorage.removeItem('producto_'+element)
        );
        window.productos_chequeados=[];            
        sessionStorage.removeItem('productos_sesion');
        $('#grupal').css('visibility','hidden');
        
        $("input.check").each(function(){
            if(sessionStorage.getItem('producto_'+$(this).attr('id'))==null){
                $(this).prop('checked', false); //desmarca
            }
        });
        
        $('#todo').prop('disabled',false);
        $('#todo').prop('checked', false);
        $('#filtrados').prop('checked', false);
        $('#nav3').css('display','none');
        //window.filtrados
    });
