window.addEventListener("load", function(){
    $(document).ready(function(){
        //paginador
        $(document).on('click','#paginacion .records a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];
            var route="http://localhost/Tazper/public/Productos"

            $.ajax({
                url: route,
                data: {
                    page: page,
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){  //console.log(data);
                    $('#paginacion').html(data.paginacion);
                    $('#productos').html(data.contenido);
                }
            });
        });

        //buscador
        document.getElementById("busqueda").addEventListener("keyup", function(){
            if($('#nav3').css('display')=='none'){                   
            if(document.getElementById("busqueda").value.length>=1){
                var busqueda=document.getElementById("busqueda").value;

                var route="http://localhost/Tazper/public/Productos_buscador";                                                     

                $.ajax({
                    url: route,
                    data: {busqueda: busqueda},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#paginacion').html(data.paginacion);
                        $('#productos').html(data.contenido);
                    }
                });
                
                    setTimeout(function(){
                        $('.marcar_todos').css('display','none');
                        
                        // window.productos_chequeados=[];
                        // sessionStorage.removeItem('productos_sesion');
                        // $('#grupal').css('visibility','hidden');
                    },120);
            }else{
                    setTimeout(function(){
                        $('#paginacion').css('display','inline');
                        $('.marcar_todos').css('display','inline');

                        $('#marcar_filtrados').css('display','none');
                        $('#filtrados').css('display','none');
                        
                        // if($('#todos').is(':checked')){
                        //     $('#todos').trigger('click');
                        // }
                    },120);
                
                var route="http://localhost/Tazper/public/Productos";

                $.ajax({
                    url: route,
                    data: {route: route},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#paginacion').html(data.paginacion);
                        $('#productos').html(data.contenido);
                    }
                });
            }
            }  
        });

        //paginador resultados
        $(document).on('click','#paginacion .resultados a', function(e){
            e.preventDefault();
            var page=$(this).attr('href').split('page=')[1];

                // console.log($('#buscar').prop('disabled'));
                // console.log($('#nav3').css('display'));
                
                // if($('#buscar').prop('disabled',true)){
                if($('#nav3').css('display')=='none'){                    
                    var route="http://localhost/Tazper/public/Productos_buscador"
                }else{
                    var route="http://localhost/Tazper/public/Productos_filtros"
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
                    $('#productos').html(data.contenido);
                }
            });
        });
    });
});