window.addEventListener("load", function(){
    $(document).ready(function(){
        //paginador
        $(document).on('click','#nav a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var route="http://localhost/Tazper/public/OrdenCompra"

            $.ajax({
                url: route,
                data: {
                    page: page,
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){  //console.log(data);
                    $('#nav').html(data.paginacion);
                    $('#ordenes').html(data.contenido);
                }
            });
        });      
    });
});