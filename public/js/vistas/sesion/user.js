window.addEventListener("load", function(){
    $(document).ready(function(){
        // Cargar Pagina
        //sesion, chequeados
        if(sessionStorage.getItem('users_sesion')==null){ //si no hay sesion
            window.users_chequeados=[];
        }else{
            window.users_chequeados=JSON.parse(sessionStorage.getItem('users_sesion')); //guarda los id
        }

            if(sessionStorage.getItem('users_per_sesion')==null){
                window.users_per_chequeados=[];
            }else{
                window.users_per_chequeados=JSON.parse(sessionStorage.getItem('users_per_sesion'));
            }

        //set
        $('input.check').each(function(){
            var id=$(this).attr('id');
            // var check=document.getElementById(id);

            if(sessionStorage.getItem('user_'+id)!=null){ //si tiene item
                var chequeado=sessionStorage.getItem('user_'+id); //true
                // check.checked=chequeado; //marca
                                
                $('input.check').each(function(){
                    if(id=$(this).attr('id')){
                        $(this).prop('checked', chequeado);
                    }
                });                                
            }

            // sessionStorage.removeItem('user_'+id); //borra
            // sessionStorage.removeItem('users_sesion');
        });

        // Click
        //get
        $('input.check').click(function(){
            var id=$(this).attr('id');
            // var check=document.getElementById(id);
            var check=$(this);
            var per=$('.registro:hover').find($('.per')).val();

            // sessionStorage.setItem('user_'+id, check.checked); //crea item, check true
            //     sessionStorage.setItem('user_per_'+id, per); // personal

            if(check.is(':checked')){
                sessionStorage.setItem('user_'+id, true);                      
            }else{
                sessionStorage.setItem('user_'+id, false);                      
            }

            if(sessionStorage.getItem('user_'+id)=='true'){ //si tiene item
                window.users_chequeados.push(id); //agrega a chequeados                
                    window.users_per_chequeados.push(per);            
            }else{
                sessionStorage.removeItem('user_'+id); //borra item
                    
                var index=window.users_chequeados.indexOf(id); //busca
                window.users_chequeados.splice(index,1); //quita de chequeados
                                
                    var index=window.users_per_chequeados.indexOf(per); //busca
                    window.users_per_chequeados.splice(index,1); //quita de chequeados                
            }
            
            console.log('chequeados: '+window.users_chequeados); //vemos chequeados
                console.log('personal: '+window.users_per_chequeados); //vemos chequeados

            // array a string
            sessionStorage.setItem('users_sesion', JSON.stringify(window.users_chequeados)); //tiene los id
            //console.log('sesion: '+JSON.parse(sessionStorage.getItem('users_sesion'))); //muestra la sesion
            //string a array

            // chequeados a chequeados, usa sesion para mantener, carga con pagina

                sessionStorage.setItem('users_per_sesion', JSON.stringify(window.users_per_chequeados));
        });

        //todos
        window.marcados=[];
        $('#todos').click(function(){
            if($('#todos').is(':checked')){
                $("input.check").each(function(){
                    var id=$(this).attr('id');                                            
                    // var check=document.getElementById(id);

                    // var check=$(this); 
                    // var check=$('input.check');                    

                    $('.per').each(function(){   
                        // console.log($(this).attr('id'));                        
                        if($(this).attr('id')==id){
                            var per=$(this).val();                                                
                            
                            if(sessionStorage.getItem('user_'+id)==null){                                
                                sessionStorage.setItem('user_'+id, true);
                                    sessionStorage.setItem('user_per_'+id, per);
        
                                window.users_chequeados.push(id);
                                    window.users_per_chequeados.push(per);                                                                
                            }else{
                                window.marcados.push(id);
                            }
                        }
                    });                                        

                    // if(sessionStorage.getItem('user_'+id)==null){
                    //     // sessionStorage.setItem('user_'+id, check.checked);
                    //     sessionStorage.setItem('user_'+id, true);
                    //         sessionStorage.setItem('user_per_'+id, per);

                    //     window.users_chequeados.push(id);
                    //         window.users_per_chequeados.push(per);
                    // }else{
                    //     window.marcados.push(id);
                    // }
                });
            }else{
                $("input.check").each(function(){
                    var id=$(this).attr('id');
                    var per=$(this).val();

                    if(window.marcados.indexOf(id)==-1){
                        sessionStorage.removeItem('user_'+id);                            

                        var index=window.users_chequeados.indexOf(id);
                        window.users_chequeados.splice(index,1);

                            var index=window.users_per_chequeados.indexOf(per);
                            window.users_per_chequeados.splice(index,1);
                    }
                });
            }
            console.log('chequeados: '+window.users_chequeados);
                console.log('personal: '+window.users_per_chequeados);

            sessionStorage.setItem('users_sesion', JSON.stringify(window.users_chequeados));
            // console.log('sesion: '+JSON.parse(sessionStorage.getItem('users_sesion')));
            
                sessionStorage.setItem('users_per_sesion', JSON.stringify(window.users_per_chequeados));
        });

            //mostrar grupal
            // $("input.check").each(function(){
                if(window.users_chequeados.length!=0){ //si hay chequeados
                    $('#grupal').css('visibility','visible');
                }
            // });

            // Desmarcar Todo
            $('#cancelar_grupo').click(function(){
                window.users_chequeados.forEach(
                    element => sessionStorage.removeItem('user_'+element) //borra items
                );
                window.users_chequeados=[];
                sessionStorage.removeItem('users_sesion'); //borra sesion, chequeados=[]
                $('#grupal').css('visibility','hidden'); //oculta grupal

                    // window.users_per_chequeados.forEach(
                    //     element => sessionStorage.removeItem('user_per'+element) //borra items
                    // );
                    sessionStorage.removeItem('users_per_sesion');


                $("input.check").each(function(){ //recorre
                    if(sessionStorage.getItem('user_'+$(this).attr('id'))==null){ //si no hay item
                        $(this).prop('checked', false); //desmarca
                    }
                });
            });
    });
});