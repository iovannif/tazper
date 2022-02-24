window.addEventListener("load", function(){
    $(document).ready(function(){
        //paginador
        $(document).on('click','#nav a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var route="http://localhost/Tazper/public/PedidoProveedor"

            $.ajax({
                url: route,
                data: {
                    page: page,
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){  //console.log(data);
                    $('#nav').html(data.paginacion);
                    $('#pedidos').html(data.contenido);
                }
            });
        });

        //pendientes
        $(document).on('click','#pendiente', function(e){
            // e.preventDefault();            
            var route="http://localhost/Tazper/public/PedidoProveedor?filtro=Pendiente"

            $.ajax({
                url: route,
                data: {
                    route: route,
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){  //console.log(data);
                    $('#nav').html(data.paginacion);
                    $('#pedidos').html(data.contenido);
                }
            });
        });

        //todos
        $(document).on('click','#todo', function(e){
            // e.preventDefault();            
            var route="http://localhost/Tazper/public/PedidoProveedor?filtro=todos"

            $.ajax({
                url: route,
                data: {
                    route: route,
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){  //console.log(data);
                    $('#nav').html(data.paginacion);
                    $('#pedidos').html(data.contenido);
                }
            });
        });
    });
});