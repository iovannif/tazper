window.addEventListener("load", function(){
    $(document).ready(function(){        
        $('.borrar').click(function(){
            //si esta marcado
            window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
            window.id=window.el_check.val();

                window.id=$('.registro:hover').find('#id').val(); 
            
            //si el regsitro está referenciado
            var foreign=$('.registro:hover').find($('.foreign')).val();            
            if(foreign!=''){      
            // if(window.todos.length>0){            
                // alert('si');                
                $('#rechazo').show().delay(1500).fadeOut(0);
            }else{
                $('#confirm').css('display','block');
            }
        });

        // Confirmar
        $('.confirmar').click(function(){            
            var id=window.id;
            $("#confirm").css("display","none");            

            $.ajax({
                async: false,
                type:"DELETE",
                url:"http://localhost/Tazper/public/Materiales/"+id,
                headers: {
                    "X-CSRF-TOKEN":$("input[name=_token]").val()
                },
                data:{"id":id,
                    "_method": "DELETE"},
                success:function(data){
                    console.log(id+" success");
                }
            });

            //borra item, y quita de chequeados
            if(window.el_check.is(':checked')){
                sessionStorage.removeItem('material_'+id);
                
                var el_id=window.materiales_chequeados.indexOf(id);
                window.materiales_chequeados.splice(el_id,1);
                
                sessionStorage.setItem('materiales_sesion', JSON.stringify(window.materiales_chequeados));
            }            

            //mensaje de eliminado
            $("#eliminado").show().delay(1500).fadeOut(0);

            if(window.cant>0){
                $('#busqueda').val('');
            }

            //recarga            
            setTimeout(function(){
                var queda=window.cantidad-1;                
                
                if(window.pagina_actual==window.ultima_pagina){
                    if(queda%20==0){
                        var page=window.pagina_actual-1;
                    }else{
                        var page=window.pagina_actual;
                    }
                }else{
                    var page=window.pagina_actual;
                }                

                var route="http://localhost/Tazper/public/Materiales";
                
                    $.ajax({
                        url: route,                        
                        data: {'page': page},
                        type: 'GET',
                        dataType: 'json',
                        success: function(data){
                            $('#paginacion').html(data.paginacion);
                            $('#materiales').html(data.contenido);
                        }
                    });                

                setTimeout(function(){
                    if(queda<=20){
                        $('#paginacion').css('left','514px');
                    }
                    if(queda==0){
                        $('#paginacion').css('left','627px');                        
                    }
                    
                        if(window.cant>0){
                            $('#busqueda').focus();
                        }

                    if(window.materiales_chequeados.length==0){ //si no hay chequeados, sesion
                        $('#grupal').css('visibility','hidden'); //oculta grupal
                    }
                }, 100);                                                    
            }, 500);                        
        });
    });
});