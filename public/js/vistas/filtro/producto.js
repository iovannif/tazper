window.addEventListener("load", function(){
    // mistrar filtros
    $('#filtros').click(function(){
        $('#nav3').show();
        $(this).hide();
        $('#cancelar_filtro').show();
        $('.filtro').css('visibility','visible');
        $('#filtro_idArt').focus();
        $("#buscar").prop("disabled", false);
        $("#buscar").css('border','1px solid #0044E1');
        $("#buscar").css('cursor','hand');
        // $('#grupal').css('top','183px');
    });

    // ocultar filtros
    $('#cancelar_filtro').click(function(){
        $('#nav3').hide();
        $('#cancelar_filtro').hide();
        $('#filtros').show();
        $('.filtro').css('visibility','hidden');
        $('#busqueda').focus();
        $("#buscar").prop("disabled", true);
        $("#buscar").css('border','1px solid #007bff');
        $("#buscar").css('cursor','default');
        $("#no_match").css("display",'none');
        // $('#grupal').css('top','144px');
        $("#busqueda,#filtro_idArt,#filtro_idProd,#filtro_Cat,#filtro_Est,#filtro_Pre,#filtro_Imp").val('');        

        if(window.productos_chequeados.length!=0){
            $('#grupal').css('visibility','hidden');

            if(window.result>20){
                setTimeout(function(){
                    // $('#grupal').css('top','144px');
                    $('#grupal').css('visibility','visible');
                },150);
            }else{
                setTimeout(function(){
                    // $('#grupal').css('top','144px');
                    $('#grupal').css('visibility','visible');
                },50);
            }
        }

        $(document).ready(function(){
            $('#mf').css('display','none');
        });
        setTimeout(function(){
            $('.marcar_todos').css('display','inline');            
        },150);

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
    });

    // marcar filtrados
    $('#filtrados').click(function(){
        if($(this).is(':checked')){
            $('#marcar_todos').hide();
        }else{
            $('#marcar_todos').show();
        }
    });

    //buscar
    $('#buscar').click(function(){
        if($('#busqueda').val()!='' || $('#filtro_idArt').val()!='' ||
            $('#filtro_idProd').val()!='' || $('#filtro_Cat').val()!='' ||
            $('#filtro_Est').val()!='' || $('#filtro_Pre').val()!='' || $('#filtro_Imp').val()!=''  
        ){    
            if($('#busqueda').val()==''){
                var art_des=JSON.stringify($('#busqueda').val());
            }else{
                if(/^\s*$/.test($('#busqueda').val())){
                    var art_des=JSON.stringify(document.getElementById("busqueda").value.trim());
                }else{
                    var art_des=document.getElementById("busqueda").value;
                }
            }

            if($('#filtro_idArt').val()==''){
                var id_art=JSON.stringify($('#filtro_idArt').val());
            }else{
                if(/^\s*$/.test($('#filtro_idArt').val())){
                    var id_art=JSON.stringify(document.getElementById("filtro_idArt").value.trim());
                }else{
                    var id_art=document.getElementById("filtro_idArt").value;
                }
            }

            if($('#filtro_idProd').val()==''){
                var id_prod=JSON.stringify($('#filtro_idProd').val());
            }else{
                if(/^\s*$/.test($('#filtro_idProd').val())){
                    var id_prod=JSON.stringify(document.getElementById("filtro_idProd").value.trim());
                }else{
                    var id_prod=document.getElementById("filtro_idProd").value;
                }
            }

            if($('#filtro_Cat').val()==''){
                var art_cat=JSON.stringify($('#filtro_Cat').val());
            }else{
                if(/^\s*$/.test($('#filtro_Cat').val())){
                    var art_cat=JSON.stringify(document.getElementById("filtro_Cat").value.trim());
                }else{
                    var art_cat=document.getElementById("filtro_Cat").value;
                }
            }

            if($('#filtro_Est').val()==''){
                var art_est=JSON.stringify($('#filtro_Est').val());
            }else{
                if(/^\s*$/.test($('#filtro_Est').val())){
                    var art_est=JSON.stringify(document.getElementById("filtro_Est").value.trim());
                }else{
                    var art_est=document.getElementById("filtro_Est").value;
                }
            }

            if($('#filtro_Pre').val()==''){
                var art_pre=JSON.stringify($('#filtro_Pre').val());
            }else{
                if(/^\s*$/.test($('#filtro_Pre').val())){
                    var art_pre=JSON.stringify(document.getElementById("filtro_Pre").value.trim());
                }else{
                    var art_pre=document.getElementById("filtro_Pre").value;
                }
            }

            if($('#filtro_Imp').val()==''){
                var art_imp=JSON.stringify($('#filtro_Imp').val());
            }else{
                if(/^\s*$/.test($('#filtro_Imp').val())){
                    var art_imp=JSON.stringify(document.getElementById("filtro_Imp").value.trim());
                }else{
                    var art_imp=document.getElementById("filtro_Imp").value;
                }
            }

            var route="http://localhost/Tazper/public/Productos_filtros";

            $.ajax({
                url: route,
                data: {
                    art_des: art_des,
                    id_art: id_art,
                    id_prod: id_prod,
                    art_cat: art_cat,
                    art_est: art_est,
                    art_pre: art_pre,
                    art_imp: art_imp
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $('#paginacion').html(data.paginacion);
                    $('#productos').html(data.contenido);
                }
            });

            setTimeout(function(){
                $('.marcar_todos').css('display','none');
            },120);
        }    
    });
});