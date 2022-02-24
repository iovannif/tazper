window.addEventListener("load", function(){
    $(document).ready(function(){
        // Agregar
        $('#agregar').click(function(){
            event.preventDefault();
            $('#create').show();
            $('#descripcion').focus();
        });

            $('#masiva').click(function(){
                $('#descripcion').focus();
            });

        // Cancelar
        $('#cancelar_c').click(function(){
            $('#descripcion').val('');
            $('.help-block').html("&nbsp;");
            $('#create').hide();            
        });

        // Ajax create
        $('#create_submit').click(function(){
            $('#principal').prop('disabled',true);

            var des=$('#descripcion').val();
            // if(des!=''){
                $.ajax({
                    async:false,
                    url: '/Tazper/public/Productos_Categoria',
                    type: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": window.token
                    },
                    data: {
                        // type: 1,
                        Cat_Des: des,
                    },
                    success: function(){
                        console.log('success');

                        $('.help-block').fadeIn().html("Categoría agregada").css('color','#22AB00');                                                
                        setTimeout(function(){ $('.help-block').html("&nbsp;"); }, 1000);      
                        $('#descripcion').val('');

                        if($('#masiva').is(':checked')){
                            $('#descripcion').focus();
                        }else{
                            setTimeout(function(){
                                $('#create').hide();
                                $('.help-block').html("&nbsp");                                     
                            }, 500);
                        }

                        var route="http://localhost/Tazper/public/Productos_Categoria";
                        var page=window.ult_pag;            

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
                    },
                    error: function(err){
                        if(err.status == 422){                            
                            // $('.help-block').fadeIn().html(JSON.stringify(err.responseJSON));                                                                                                
                            $('.help-block').fadeIn().html(err.responseJSON.Cat_Des[0]).css('color','#C90000');                                                 
                            $('#descripcion').focus();         
                        }
                    }
                });       
            // }
            // else{
            //     alert('campo vacio');
            // }                                                                                                                           
        });        
    });
});