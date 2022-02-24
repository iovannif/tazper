window.addEventListener("load", function(){
    $(document).ready(function(){
        //paginador                
        $(document).on('click','#paginacion .records a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var route="http://localhost/Tazper/public/Arqueo";

            $.ajax({
                url: route,
                data: {page: page},
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('#paginacion').html(data.paginacion);
                    $('#contenido').html(data.contenido);
                }
            });
        });
        
        //buscador 
        //date en blanco necesita confirmacion                
        $(document).on('click','#buscar', function(e){      
            $('#busqueda').focus();
            // if(document.getElementById("busqueda").value.length>=1){ //fecha completa
            if(document.getElementById("busqueda").value!=''){
                var busqueda=document.getElementById("busqueda").value;

                var route="http://localhost/Tazper/public/Arqueo_buscador";

                $.ajax({
                    url: route,
                    data: {busqueda: busqueda},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#paginacion').html(data.paginacion);
                        $('#contenido').html(data.contenido);
                    }
                });
            }else{
                var route="http://localhost/Tazper/public/Arqueo";

                $.ajax({
                    url: route,
                    data: {route: route},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#paginacion').html(data.paginacion);
                        $('#contenido').html(data.contenido);
                    }
                });
            }
        });  

        //paginador resultados
        $(document).on('click','#paginacion .resultados a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var route="http://localhost/Tazper/public/Arqueo_buscador"

            $.ajax({
                url: route,
                data: {
                    page: page,
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('#paginacion').html(data.paginacion);
                    $('#contenido').html(data.contenido);
                }
            });
        });
    });
})