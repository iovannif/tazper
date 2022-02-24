window.addEventListener("load", function(){
    $(document).ready(function(){        
        $('.borrar').click(function(){
            //si esta marcado
            window.el_check=$('.registro:hover').find($('input[type=checkbox]'));
            window.id=window.el_check.val();

                window.id=$('.registro:hover').find('input').val(); 
            
            //si el regsitro está referenciado
            var foreign=$('.registro:hover').find($('.foreign')).val();
                // console.log(foreign);
            if(foreign=='true'){
                // alert('referenciado');
                $('#rechazo').show().delay(1500).fadeOut(0);
            }else{
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
                async:false, 
                url:"http://localhost/Tazper/public/Proveedores/"+id,
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
                sessionStorage.removeItem('proveedor_'+id);
                
                var el_id=window.proveedores_chequeados.indexOf(id);
                window.proveedores_chequeados.splice(el_id,1);
                
                sessionStorage.setItem('proveedores_sesion', JSON.stringify(window.proveedores_chequeados));
            }            

            //mensaje de eliminado
            $("#eliminado").show().delay(1500).fadeOut(0);

            $('#busqueda').val('');

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
                        $('#paginacion').css('left','514px');
                    }
                    if(queda==0){
                        $('#paginacion').css('left','627px');                        
                    }

                    $('#busqueda').focus();

                    if(window.proveedores_chequeados.length==0){ //si no hay chequeados, sesion
                        $('#grupal').css('visibility','hidden'); //oculta grupal
                    }
                }, 100);                                                    
            }, 500);                        
        });
    });
});