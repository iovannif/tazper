window.addEventListener("load", function(){
    $(document).ready(function(){
        //paginador
        $(document).on('click','#paginacion .records a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var route="http://localhost/Tazper/public/Ventas"

            $.ajax({
                url: route,
                data: {
                    page: page,
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){  //console.log(data);
                    $('#paginacion').html(data.paginacion);
                    $('#ventas').html(data.contenido);
                    $('#busqueda').focus();
                }
            });
        });

        //buscador 
        //filtro necesita confirmacion                
        $(document).on('click','#buscar', function(e){      
            $('#busqueda').focus();
            // if(document.getElementById("busqueda").value.length>=1){ //fecha completa
            if(document.getElementById("busqueda").value!=''){                
                var busqueda=document.getElementById("busqueda").value;

                var route="http://localhost/Tazper/public/Ventas_buscador";

                $.ajax({
                    url: route,
                    data: {busqueda: busqueda},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#paginacion').html(data.paginacion);
                        $('#ventas').html(data.contenido);
                    }
                });
            }else{
                var route="http://localhost/Tazper/public/Ventas";

                $.ajax({
                    url: route,
                    data: {route: route},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#paginacion').html(data.paginacion);
                        $('#ventas').html(data.contenido);
                    }
                });
            }
        });  

        //paginador resultados //buscador
        $(document).on('click','#paginacion .resultados a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            
            // console.log($('#cancelar_filtro').css('display'));

            if($('#cancelar_filtro').css('display')=='none'){                    
                var route="http://localhost/Tazper/public/Ventas_buscador";
            }else{
                var route="http://localhost/Tazper/public/Ventas_filtros";
            }  
                                    
            $.ajax({
                url: route,
                data: {
                    page: page,
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('#paginacion').html(data.paginacion);
                    $('#ventas').html(data.contenido);
                }
            });
        });
    });
});