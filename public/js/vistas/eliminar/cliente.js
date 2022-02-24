window.addEventListener("load", function(){
    $(document).ready(function(){        
        $('.borrar').click(function(){                        
            //si el regsitro está referenciado
            var foreign=$('.registro:hover').find($('.foreign')).val();
            window.id=$('.registro:hover').find($('.foreign')).attr('id');
                // console.log(foreign);
            if(foreign=='true'){
                // alert('referenciado');
                $('#rechazo').show().delay(1500).fadeOut(0);
            }else{
                $('#confirm').css('display','block');
                // alert(window.id);
            }
        });

        // Confirmar
        $('.confirmar').click(function(){
            event.preventDefault();
            var id=window.id;
            $("#confirm").css("display","none");

            $.ajax({
                type:"DELETE",
                async:'false',
                url:"http://localhost/Tazper/public/Clientes/"+id,
                headers: {
                    "X-CSRF-TOKEN":$("input[name=_token]").val()
                },
                data:{"id":id,
                    "_method": "DELETE"},
                success:function(data){
                    console.log(id+" success");
                }
            });            

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

                var route="http://localhost/Tazper/public/Clientes";
                
                    $.ajax({
                        url: route,
                        data: {'page': page},
                        type: 'GET',
                        dataType: 'json',
                        success: function(data){
                            $('#paginacion').html(data.paginacion);
                            $('#clientes').html(data.contenido);
                            // console.log('ok');
                        }
                    });                

                setTimeout(function(){
                    if(queda<=20){
                        $('#paginacion').css('left','514px');
                    }
                    if(queda==0){
                        $('#paginacion').css('left','627px');                        
                    }                                        
                }, 100);                                                    
            }, 500);                        
        });
    });
});