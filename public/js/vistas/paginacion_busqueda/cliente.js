window.addEventListener("load", function(){
    $(document).ready(function(){
        //paginador
        $(document).on('click','#paginacion .records a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var route="http://localhost/Tazper/public/Clientes"

            $.ajax({
                url: route,
                data: {
                    page: page,
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){  //console.log(data);
                    $('#paginacion').html(data.paginacion);
                    $('#clientes').html(data.contenido);
                    // console.log('ok');
                }
            });
        });
    });
});