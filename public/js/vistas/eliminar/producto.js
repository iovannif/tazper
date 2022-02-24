window.addEventListener("load", function(){
    $(document).ready(function(){
        //si esta marcado
        $('.borrar').click(function(){
            window.el_check=$('.registro:hover').find($('input[type=checkbox]'));  
            
                window.id=$('.registro:hover').find('input').val(); 

            //si el regsitro está referenciado
            // window.todos=0;
            // if(window.todos>0){
                
            // if(window.todos.length>0){
            //     $('#rechazo').show().delay(1500).fadeOut(0);
            // }else{
                // $('#confirm').css('display','block');
            // } 

            var foreign=$('.registro:hover').find($('.foreign')).val();            
            
            if(foreign!=''){                      
                $('#rechazo').show().delay(1500).fadeOut(0);
            }else{
                window.id=$('.registro:hover').find($('.foreign')).attr('id');    
                $('#confirm').css('display','block');
            }
        });

        // Confirmar
        $('.confirmar').click(function(){
            event.preventDefault();
            var id=window.id;
            $("#confirm").css("display","none");

            $.ajax({
                type:"DELETE",
                url:"http://localhost/Tazper/public/Productos/"+id,
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
                sessionStorage.removeItem('producto_'+id);
                
                var el_id=window.productos_chequeados.indexOf(id);
                window.productos_chequeados.splice(el_id,1);
                
                sessionStorage.setItem('productos_sesion', JSON.stringify(window.productos_chequeados));
            }

            // window.borrar=[];
            // window.borrar.push(id);

            //mensaje de eliminado
            $("#eliminado").show().delay(1500).fadeOut(0);            

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

                var route="http://localhost/Tazper/public/Productos";
                
                    $.ajax({
                        url: route,
                        data: {'page': page},
                        type: 'GET',
                        dataType: 'json',
                        success: function(data){
                            $('#paginacion').html(data.paginacion);
                            $('#productos').html(data.contenido);
                        }
                    });                                        

                setTimeout(function(){
                    if(queda<=20){
                        $('#paginacion').css('left','501px');
                    }
                    if(queda==0){
                        $('#paginacion').css('left','627px');                        
                    }        
                    
                    $('#busqueda,#filtro_idArt,#filtro_idProd,#filtro_Cat,#filtro_Est,#filtro_Pre,#filtro_Imp').val('');
                    $('#busqueda').focus();
                    $('#nav3').hide();
                    $('#cancelar_filtro').hide();
                    $('#filtros').show();

                    if(window.productos_chequeados.length==0){ //si no hay chequeados, sesion
                        $('#grupal').css('visibility','hidden'); //oculta grupal
                    }
                }, 100);                                                    
            }, 500);                        
        });
    });
});