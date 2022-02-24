window.addEventListener("load", function(){
    $(document).ready(function(){    
        console.log(window.personal_chequeados);    
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
                var borrar=window.personal_chequeados.length;
                window.user='';
                
                $("input.check").each(function(){
                    if($(this).is(':checked')){
                        window.user='si';
                        
                        return false;
                    }else{                        
                        window.user='no';
                    }
                });                

                if(borrar==0){
                    if(window.user=='no'){
                        $('#vacio').show().delay(1500).fadeOut(0);                                
                    }else{
                        $('#rechazo').show().delay(1500).fadeOut(0);                                
                    }                                                   
                }else{
                    // console.log(borrar);
                    if(borrar==1){
                        $('#confirm_grupal #cant').html('Está a punto de eliminar el personal, no lo podrá recuperar');
                    }else{
                        $('#confirm_grupal #cant').html('Está a punto de eliminar los empleados, no los podrá recuperar');
                    }

                    $('#confirm_grupal').show();
                }
            });

            //cancelar en cuadro
            $('#g_cancelar').click(function(){
                $('#confirm_grupal').hide();
            });

            //confirmar: Elmina
        $('.g_confirmar').click(function(){
            $('#confirm_grupal').hide();
            // var ids=[];
            // $('input.check:checked').each(function(){                
            //     ids.push($(this).val());                
            // });

            var ids=window.personal_chequeados;

                // ids.forEach(element=>console.log(element));

            var eliminar=ids.length;            
            var los_id=ids.join(',');

            $.ajax({
                async:false,
                url: 'http://localhost/Tazper/public/personal_remove',
                type: 'POST',                
                data: 'ids='+los_id,
                success: function(data){
                    console.log(los_id+' success');
                }
            });

                ids.forEach(
                    element => sessionStorage.removeItem('personal_'+element)                    
                );
                sessionStorage.removeItem('personal_sesion');                                                

                // ids.forEach(                    
                //     element => window.personal_chequeados.splice(window.personal_chequeados.indexOf(element),1)
                // );
                // sessionStorage.setItem('personal_sesion', JSON.stringify(window.personal_chequeados));
                
                if(eliminar==1){
                    var eliminados='<span>'+eliminar+'</span> personal eliminado';
                }else{
                    var eliminados='<span>'+eliminar+'</span> empleados eliminados';
                }

            if(window.no.length!=0){
                var usuarios=window.no.length;                

                if(usuarios==1){
                    var users='<span>'+usuarios+'</span> personal no eliminado';
                }else{
                    var users='<span>'+usuarios+'</span> empleados no eliminados';
                }
                
                $('.users').html(users).addClass('numero');
                $('.usu_cant').html(eliminados).addClass('numero');
                $("#usuario_eliminados").show().delay(1500).fadeOut(0);    
            }else{                    
                $('.eliminados_cant').html(eliminados).addClass('numero');
                $("#eliminados").show().delay(1500).fadeOut(0);    
            }            

            // ajax recarga
            var route="http://localhost/Tazper/public/Personal";
                
            $.ajax({
                url: route,
                data: {'route': route},
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('#nav').html(data.nav);
                    $('#personal').html(data.contenido);
                }
            });                                 
        });
    });
});