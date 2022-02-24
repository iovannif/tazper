window.addEventListener("load", function(){
    $(document).ready(function(){
        // Cargar Pagina
        //sesion, chequeados
        if(sessionStorage.getItem('personal_sesion')==null){ //si no hay sesion
            window.personal_chequeados=[];
        }else{
            window.personal_chequeados=JSON.parse(sessionStorage.getItem('personal_sesion')); //guarda los id
        }

        //set
        $('input.check').each(function(){
            var id=$(this).attr('id');
            // var check=document.getElementById(id);
                // var check=$(this);

            if(sessionStorage.getItem('personal_'+id)!=null){ //si tiene item
                // var chequeado=sessionStorage.getItem('personal_'+id); //true
                // check.checked=chequeado; //marca

                $(this).prop("checked",true);                
            }

            // sessionStorage.removeItem('personal_'+id); //borra
            // sessionStorage.removeItem('personal_sesion');
        });

        // Click
        //get
        window.no=[];
        $('input.check').click(function(){
            var id=$(this).attr('id');

            $('.usu').each(function(){
                if($(this).attr('id')==id){
                    if($(this).val()==''){                              
                        // var check=document.getElementById(id);
                        // var check=$('input.check:hover');   
                        // console.log(check.val());                     
                        
                        // sessionStorage.setItem('personal_'+id, check.checked); //crea item, check true
                        if($('input.check:hover').is(':checked')){
                            sessionStorage.setItem('personal_'+id, true)
                            window.personal_chequeados.push(id)
                        }else{
                            sessionStorage.removeItem('personal_'+id);
                            
                            var index=window.personal_chequeados.indexOf(id);
                            window.personal_chequeados.splice(index,1);
                        }                        

                        // if(sessionStorage.getItem('personal_'+id)=='true'){ //si tiene item
                        //     window.personal_chequeados.push(id); //agrega a chequeados
                        // }else{
                        //     sessionStorage.removeItem('personal_'+id); //borra item

                        //     var index=window.personal_chequeados.indexOf(id); //busca
                        //     window.personal_chequeados.splice(index,1); //quita de chequeados
                        // 
                        // }
                        console.log('chequeados: '+window.personal_chequeados); //vemos chequeados

                        // array a string
                        sessionStorage.setItem('personal_sesion', JSON.stringify(window.personal_chequeados)); //tiene los id
                        // console.log('sesion: '+JSON.parse(sessionStorage.getItem('personal_sesion'))); //muestra la sesion
                        //string a array

                        // chequeados a chequeados, usa sesion para mantener, carga con pagina        
                    }else{
                        if($('input.check:hover').is(':checked')){
                            window.no.push(id);                    
                        }else{
                            var i=window.no.indexOf(id);
                            window.no.splice(i,1);
                        }        
                        console.log('no '+window.no);                 
                    }
                    // console.log('no '+window.no.length);  
                    // console.log('chekados '+window.personal_chequeados.length);                                                                
                }
            });            
        });

        //todos
        window.marcados=[];
        $('#todos').click(function(){
            if($('#todos').is(':checked')){
                $("input.check").each(function(){
                    var id=$(this).attr('id');
                    
                    $('.usu').each(function(){
                        if($(this).attr('id')==id){
                            // alert('si');

                            if($(this).val()==''){
                                // alert('vacio');                                

                                // var check=document.getElementById(id);

                                if(sessionStorage.getItem('personal_'+id)==null){
                                    // sessionStorage.setItem('personal_'+id, check.checked);
                                    sessionStorage.setItem('personal_'+id, true);
                                    window.personal_chequeados.push(id);
                                }else{
                                    window.marcados.push(id);
                                }                                
                            }else{
                                // alert($(this).val());

                                if(window.no.indexOf(id)==-1){
                                    window.no.push(id);
                                }
                                // alert(window.no);
                            }
                        }                        
                    });                
                });                
            }else{
                $("input.check").each(function(){
                    var id=$(this).attr('id');
                    
                    $('.usu').each(function(){
                        if($(this).attr('id')==id){
                            if($(this).val()==''){
                                // if(window.marcados.indexOf(id)==-1){
                                    sessionStorage.removeItem('personal_'+id);

                                    var index=window.personal_chequeados.indexOf(id);
                                    window.personal_chequeados.splice(index,1);                        
                                // }
                            }else{                        
                                window.no.splice(window.no.indexOf(id),1);                  
                                // alert(window.no.length);
                            }     
                        }                   
                    });
                });
            }
            console.log('chequeados: '+window.personal_chequeados);

            sessionStorage.setItem('personal_sesion', JSON.stringify(window.personal_chequeados));
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('personal_sesion')));

            console.log('no: '+window.no);
        });

            //mostrar grupal
            $("input.check").each(function(){
                if(window.personal_chequeados.length!=0){ //si hay chequeados
                    $('#grupal').css('visibility','visible');
                }
            });

            // Desmarcar Todo
            $('#cancelar_grupo').click(function(){
                window.personal_chequeados.forEach(
                    element => sessionStorage.removeItem('personal_'+element) //borra items                    
                );
                sessionStorage.removeItem('personal_sesion'); //borra sesion, chequeados=[]  
                window.personal_chequeados=[];              
                $('#grupal').css('visibility','hidden'); //oculta grupal

                $("input.check").each(function(){ //recorre
                    if(sessionStorage.getItem('personal_'+$(this).attr('id'))==null){ //si no hay item
                        $(this).prop('checked', false); //desmarca
                    }
                });
            });
    });
});