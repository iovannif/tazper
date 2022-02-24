window.addEventListener("load", function(){
    $(document).ready(function(){
        //paginador
        $(document).on('click','#paginacion a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var route="http://localhost/Tazper/public/Articulos"

            $.ajax({
                url: route,
                data: {
                    page: page,
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){  //console.log(data);
                    $('#paginacion').html(data.paginacion);
                    $('#contenido').html(data.contenido);
                }
            });
        });        
    });
});