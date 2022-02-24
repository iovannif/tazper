window.addEventListener("load", function(){
    $(document).ready(function(){
        //paginador                
        $(document).on('click','#paginacion .records a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var route="http://localhost/Tazper/public/Productos_Categoria";

            $.ajax({
                url: route,
                data: {page: page},
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('#paginacion').html(data.paginacion);
                    $('#categorias').html(data.contenido);
                }
            });
        });

        //buscador
        document.getElementById("busqueda").addEventListener("keyup", function(){
            if(document.getElementById("busqueda").value.length>=1){
                var busqueda=document.getElementById("busqueda").value;

                var route="http://localhost/Tazper/public/ProductosCategoria_buscador";

                $.ajax({
                    url: route,
                    data: {busqueda: busqueda},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#paginacion').html(data.paginacion);
                        $('#categorias').html(data.contenido);
                    }
                });
                
                    setTimeout(function(){
                        $('.marcar_todos').css('display','none');                                                
                    },120);
            }else{
                    setTimeout(function(){
                        $('#paginacion').css('display','inline');
                        $('.marcar_todos').css('display','inline');

                        $('#marcar_filtrados').css('display','none');
                        $('#filtrados').css('display','none');                                                
                    },120);
                
                var route="http://localhost/Tazper/public/Productos_Categoria";

                $.ajax({
                    url: route,
                    data: {route: route},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#paginacion').html(data.paginacion);
                        $('#categorias').html(data.contenido);
                    }
                });
            }
        });

        //paginador resultados
        $(document).on('click','#paginacion .resultados a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var route="http://localhost/Tazper/public/ProductosCategoria_buscador"

            $.ajax({
                url: route,
                data: {
                    page: page,
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('#paginacion').html(data.paginacion);
                    $('#categorias').html(data.contenido);
                }
            });
        });
    });
});