window.addEventListener("load", function(){
    $(document).ready(function(){
        //Cargar
        $('input.check').each(function(){
            if($(this).is(':checked')){
                window.todos='true';
            }else{
                window.todos='false';
                return false;
            }
            if(window.todos=='true'){
                $('#todos').prop('checked', true);
            }else{
                $('#todos').prop('checked', false);
            }  
        });

        // Marcar
        $('input.check').click(function(){            
            $("input.check").each(function(){
                if($(this).is(':checked')){
                    $('#grupal').css('visibility','visible');
                    return false;
                }else{
                    $('#grupal').css('visibility','hidden');
                }
            });

            $("input.check").each(function(){
                if($(this).is(':checked')){
                    window.todos='true';
                }else{
                    window.todos='false';
                    return false;
                }
            });
            if(window.todos=='true'){
                $('#todos').prop('checked', true);
            }else{
                $('#todos').prop('checked', false);
            }   
        });

        // Marcar todos
        $('#todos').click(function(){
            if($('#todos').is(':checked')){
                $('input.check').attr('checked','checked');
            }else{
                $("input.check").removeAttr("checked");
            }
        });

        // Eliminar Marcados
            //muestra cuadro
            $('#eliminar_grupo').click(function(){
                var borrar=window.users_chequeados.length;

                if(borrar!=0){
                    if(borrar==1){
                        $('#confirm_grupal #cant').html('Está a punto de eliminar el usuario, no lo podrá recuperar');
                    }else{
                        $('#confirm_grupal #cant').html('Está a punto de eliminar los usuarios, no los podrá recuperar');
                    }

                    $('#confirm_grupal').show();
                }else{                
                    $('#vacio').show().delay(1500).fadeOut(0);                
                }
            });

            //cancelar en cuadro
            $('#g_cancelar').click(function(){
                $('#confirm_grupal').hide();
            });

            //confirmar: Elmina
        $('.g_confirmar').click(function(){
            $('#confirm_grupal').hide();
            var ids=[];                
                var personal=[]; 

            // $('input.check:checked').each(function(){
            //     if(window.records>1){
            //         if($(this).val()!=1){
            //             ids.push($(this).val());
            //         }else{
            //             window.admin=$(this).val();
            //             console.log('admin '+admin);
            //         }
            //     }else{
            //         ids.push($(this).val());
            //     }
            // });                                           
                
            if(window.records>1){
                if(window.users_chequeados.indexOf('1')>-1){
                    window.users_chequeados.splice(window.users_chequeados.indexOf('1'),1);
                    window.users_per_chequeados.splice(window.users_per_chequeados.indexOf('1'),1);

                    window.admin=1;
                }                                   
            }
            console.log(window.users_chequeados);
            console.log(window.users_per_chequeados);

            ids=window.users_chequeados;                  
            personal=window.users_per_chequeados;  

            // ids.forEach(element=>console.log(element));

            var eliminar=ids.length;            

            if(eliminar!=0){
                var los_id=ids.join(',');
                    var empleados=personal.join(',');
                    // console.log(empleados);

                $.ajax({
                    asnyc:false,
                    url: 'http://localhost/Tazper/public/usuarios_remove',
                    type: 'POST',                
                    // data: 'ids='+los_id,
                    data: {ids: los_id,
                        personal: empleados
                    },
                    success: function(data){
                        console.log(los_id+' success')+empleados;
                    }
                });

                ids.forEach(
                    element => sessionStorage.removeItem('user_'+element)
                );
                sessionStorage.removeItem('users_sesion');

                    personal.forEach(
                        element => sessionStorage.removeItem('user_per_'+element)
                    );
                    sessionStorage.removeItem('users_per_sesion');

                sessionStorage.removeItem('user_'+window.admin);                

                if(window.records!=1){
                        if(eliminar==1){
                            var eliminados='<span>'+eliminar+'</span> usuario eliminado';
                        }else{
                            var eliminados='<span>'+eliminar+'</span> usuarios eliminados';
                        }

                    if(window.admin){
                            console.log('hay un admin '+window.admin);                            
                        $('.admin_cant').html(eliminados).addClass('numero');
                        $('#admin_eliminados').show();
                    }else{
                            console.log('No admin');
                        $('.eliminados_cant').html(eliminados).addClass('numero');
                        $('#eliminados').show();
                    }

                    window.usuario_actual='';
                        
                    if(ids.indexOf(window.current_user)!=-1){
                        window.usuario_actual='si';
                    }                        
                
                    if(window.usuario_actual!='si'){                                       
                        setTimeout(function(){                        
                            fetch(`http://localhost/Tazper/public/usuarios_fetch`, {method:'get'})
                            .then(response=>response.text())
                            .then(html=>{document.getElementById('contenido').innerHTML=html});                        
                        }, 1000);                    

                        var queda=records-eliminar;
                        queda=queda.toString();
                        
                        if(queda.length==1){
                            $('#total_reg').text('Total: '+String.fromCharCode(160)+String.fromCharCode(160)+queda);
                        }else{
                            $('#total_reg').text('Total: '+queda);
                        }
                    }
                    else{
                        window.location.replace('http:localhost/Tazper/public/login');    
                    }                    
                }else{
                    window.location.replace('http:localhost/Tazper/public/register');
                }            
            }else{
                $('#rechazo').show().delay(1500).fadeOut(0);                    
            }
        });
    });
});