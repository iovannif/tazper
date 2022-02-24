window.addEventListener("load", function(){
    $(document).ready(function(){        
        // Cancelar (index)
        $('.borrar').click(function(){                       
            event.preventDefault();
            window.id=$('.registro:hover').find('input').val();    
            
            if($(this).val()=='Cancelar'){
                $('#cancela').css('display','block');    
                window.mensaje='cancelado';
            }else{
                $('#confirm').css('display','block');
                window.mensaje='eliminado';
            }          
        });

        //cancelar
        $('.cancelar').click(function(){
            $('#cancela,#confirm').css('display','none');
        });

        // Confirmar
        $('.confirmar').click(function(){            
            var id=window.id;             
            $("#confirm,#cancela").css("display","none");                    

            $.ajax({
                async: false,
                type:"DELETE",
                url:"http://localhost/Tazper/public/PedidoCliente/"+id,
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
            if(window.mensaje=='cancelado'){
                $("#cancelado").show().delay(1500).fadeOut(0);            
            }else{
                $("#eliminado").show().delay(1500).fadeOut(0);            
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

                var route="http://localhost/Tazper/public/PedidoCliente";
                
                $.ajax({
                    url: route,                        
                    data: {'page': page},                    
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#nav').html(data.paginacion);
                        $('#pedidos').html(data.contenido);
                    }
                });                                                                               
            }, 500);                        
        });
    });
});