window.addEventListener("load", function(){
    $('#grupal').css('top','144px');
    $(document).ready(function(){
        // Marcar
        //mostrar grupal
        $('input.check').click(function(){
            $("input.check").each(function(){
                if($(this).is(':checked')){ //hay marcado                    
                    $('#grupal').css('visibility','visible'); //muestra
                    return false;
                }else{ //no hay marcado
                    $('#grupal').css('visibility','hidden'); //oculta
                }
            });
            
            //pagina
            $("input.check").each(function(){
                if($(this).is(':checked')){
                    window.pagina='true';
                }else{
                    window.pagina='false';
                    return false;
                }
            });
            if(window.pagina=='true'){
                $('#todos').prop('checked', true);
            }else{
                $('#todos').prop('checked', false);
            }            

            //todo
            if($(this).is(':checked')){
                if(window.proveedores_chequeados.length==window.todos.length){
                    $('#todo').prop('checked', true);
                }
            }else{
                $('#todo').prop('checked',false);
            }
        });

        // Marcar todos
        $('#todos').click(function(){
            if($('#todos').is(':checked')){
                $('input.check').attr('checked','checked');
                // todo
                if(window.proveedores_chequeados.length==window.todos.length){
                    $('#todo').prop('checked', true);
                }
            }else{
                $("input.check").removeAttr("checked"); //quita los marcar todos
                $('#todo').prop('checked',false);
            }
        });

        // Todos los registros
        $('#todo').click(function(){
            if($('#todo').is(':checked')){
                window.marcando_todo='';

                if(window.pagina_actual!=1){
                    $('#inicio').trigger('click');
                }else{
                    $('#todos').trigger('click');

                    if(window.pagina_actual==window.ultima_pagina){
                        window.marcando_todo='fin';
                        console.log(window.proveedores_chequeados.length);
                    }else{
                        $('#siguiente').trigger('click');
                    }
                }                
            }            
        });

        // marcar filtrados
        window.marcados=[];        

        // Eliminar Marcados
            //muestra cuadro
            $('#eliminar_grupo').click(function(){
                var borrar=window.proveedores_chequeados.length;
                window.articulo=''; //fk

                $("input.check").each(function(){
                    if($(this).is(':checked')){
                        window.articulo='si';
                        
                        return false;
                    }else{                        
                        window.articulo='no';
                    }
                });   
                
                if(borrar==0){
                    if(window.articulo=='no'){
                        $('#vacio').show().delay(1500).fadeOut(0);                                
                    }else{
                        $('#rechazo').show().delay(1500).fadeOut(0);                                
                    }                                        
                }else{
                    if(borrar==1){
                        $('#confirm_grupal #cant').html('Está a punto de eliminar el proveedor, no lo podrá recuperar');
                    }else{
                        $('#confirm_grupal #cant').html('Está a punto de eliminar los proveedores, no los podrá recuperar');
                    }

                    $('#confirm_grupal').show();
                }
            });
            
            //cancelar en cuadro
            $('#g_cancelar').click(function(){
                $('#confirm_grupal').hide();
            });

            //confirmar: Elimina
        $('.g_confirmar').click(function(){
            $('#confirm_grupal').hide();
            var ids=window.proveedores_chequeados;
            var eliminar=ids.length;

            if(eliminar<=20){
                var resta=1;
            }else if(eliminar>20 && eliminar<=40){
                var resta=2;
            }

            var los_id=ids.join(',');
            $.ajax({
                async:false,
                url: '/Tazper/public/proveedores_remove',
                type: 'POST',
                data: 'ids='+los_id, //chequeados
                success: function(data){
                    console.log(los_id+' success');
                }
            });

            ids.forEach(
                element => sessionStorage.removeItem('proveedor_'+element)
            );
            sessionStorage.removeItem('proveedores_sesion');

            window.borrar=ids;
            
            //mensaje eliminados
            if(eliminar==1){
                var eliminados='<span>'+eliminar+'</span> proveedor eliminado';
            }else{
                var eliminados='<span>'+eliminar+'</span> proveedores eliminados';
            }

            if(window.no.length!=0){
                var articulos=window.no.length;                

                if(articulos==1){
                    var productos='<span>'+articulos+'</span> proveedor no eliminado';
                }else{
                    var productos='<span>'+articulos+'</span> proveedores no eliminados';
                }
                
                $('.articulos').html(productos).addClass('numero');
                $('.art_cant').html(eliminados).addClass('numero');
                $("#articulo_eliminados").show().delay(1500).fadeOut(0);    
            }else{                    
                $('.eliminados_cant').html(eliminados).addClass('numero');
                $("#eliminados").show().delay(1500).fadeOut(0);    
            }

            //recarga
            setTimeout(function(){
                var queda=window.cantidad-eliminar;
                var page=window.pagina_actual-resta;         
                
                if(window.pagina_actual==window.ultima_pagina){
                    if(queda%20==0){
                        var page=window.pagina_actual-resta; // 1
                    }else{
                        var page=window.pagina_actual;
                    }
                }else{
                    var page=window.pagina_actual;
                }  

                var route="http://localhost/Tazper/public/Proveedores";
                
                $.ajax({
                    url: route,
                    data: {'page': page},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#paginacion').html(data.paginacion);
                        $('#proveedores').html(data.contenido);
                    }
                });            

                setTimeout(function(){
                    if(queda<=20){
                        $('#paginacion').css('left','518px');
                    }                 
                    if(queda==0){
                        $('#paginacion').css('left','627px');
                    }

                    if(window.proveedores_chequeados.length==0){ //si no hay chequeados, sesion
                        $('#grupal').css('visibility','hidden'); //oculta grupal
                    }

                    $('#busqueda').val('');                    
                    $('#grupal').css('visibility','hidden');
                    $('#filtrados').prop('checked',false);
                    $('#busqueda').focus();
                    
                    if(window.proveedores_chequeados.length<0){
                        $('#grupal').css('visibility','visible');
                    }
                }, 100);
            },500);
        });
    });
});