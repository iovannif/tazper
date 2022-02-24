window.addEventListener("load", function(){
    $(document).ready(function(){        
        // Confirmar
        $('.confirmar').click(function(){            
            var id=window.id;      
            $('#confirm').css('display','none');      

            $.ajax({
                async: false,
                type:"DELETE",
                url:"http://localhost/Tazper/public/Compras/"+id,
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
                                    
                var route="http://localhost/Tazper/public/Compras";
                
                $.ajax({
                    url: route,                        
                    data: {'page': page},                    
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#paginacion').html(data.paginacion);
                        $('#compras').html(data.contenido);
                    }
                });                                                                               
            }, 500);                        
        });
    });
});