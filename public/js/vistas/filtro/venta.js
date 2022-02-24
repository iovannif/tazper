window.addEventListener("load", function(){
    //el navegador lee todo el script y cuando se produce, sabe que hacer

    // mostrar filtros (inputs)
    $('#filtros').click(function(){    
        $(this).hide();
        $('.filtro').css('visibility','visible');
        $('#cancelar_filtro').show();
        $('#filtro_idVen').focus();                             
        $("#busqueda").css('margin-right','5px');        
        $('#buscar').hide();
        $('#buscar_filtro').show();                             
    });

    // ocultar filtros
    $('#cancelar_filtro').click(function(){    
        $(this).hide();
        $('.filtro').css('visibility','hidden');
        $('#filtros').show();
        $('#busqueda').focus();            
        $("#busqueda,.filtro").val('');        
        // $("#no_match").css("display",'none');    
        $("#busqueda").css('margin-right','20px');     
        $('#buscar').show();
        $('#buscar_filtro').hide();

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
    });    

    //buscar
    $('#buscar_filtro').click(function(){
        if(
            $('#busqueda').val()!='' || $('#filtro_idVen').val()!='' ||
            $('#filtro_Fac').val()!='' || $('#filtro_Tip').val()!='' ||
            $('#filtro_Cli').val()!='' || $('#filtro_Est').val()!=''  
        ){ // || $('#filtro_Cat').val()!='' || $('#filtro_Desc').val()!='' 
        if($('#busqueda').val()==''){
            var ven_fe=JSON.stringify($('#busqueda').val());
        }else{
            if(/^\s*$/.test($('#busqueda').val())){
                var ven_fe=JSON.stringify(document.getElementById("busqueda").value.trim());
            }else{
                var ven_fe=document.getElementById("busqueda").value;
            }
        }        

        if($('#filtro_idVen').val()==''){
            var id_ven=JSON.stringify($('#filtro_idVen').val());
        }else{
            if(/^\s*$/.test($('#filtro_idVen').val())){
                var id_ven=JSON.stringify(document.getElementById("filtro_idVen").value.trim());
            }else{
                var id_ven=document.getElementById("filtro_idVen").value;
            }
        }

        if($('#filtro_Fac').val()==''){
            var ven_fact=JSON.stringify($('#filtro_Fac').val());
        }else{
            if(/^\s*$/.test($('#filtro_Fac').val())){
                var ven_fact=JSON.stringify(document.getElementById("filtro_Fac").value.trim());
            }else{
                var ven_fact=document.getElementById("filtro_Fac").value;
            }
        }        

        if($('#filtro_Tip').val()==''){
            var ven_tip=JSON.stringify($('#filtro_Tip').val());
        }else{
            if(/^\s*$/.test($('#filtro_Tip').val())){
                var ven_tip=JSON.stringify(document.getElementById("filtro_Tip").value.trim());
            }else{
                var ven_tip=document.getElementById("filtro_Tip").value;
            }
        }             

        if($('#filtro_Cli').val()==''){
            var ven_cli=JSON.stringify($('#filtro_Cli').val());
        }else{
            if(/^\s*$/.test($('#filtro_Cli').val())){
                var ven_cli=JSON.stringify(document.getElementById("filtro_Cli").value.trim());
            }else{
                var ven_cli=document.getElementById("filtro_Cli").value;
            }
        }    

        // if($('#filtro_Cat').val()==''){
        //     var ven_cliLp=JSON.stringify($('#filtro_Cat').val());
        // }else{
        //     if(/^\s*$/.test($('#filtro_Cat').val())){
        //         var ven_cliLp=JSON.stringify(document.getElementById("filtro_Cat").value.trim());
        //     }else{
        //         var ven_cliLp=document.getElementById("filtro_Cat").value;
        //     }
        // }    

        // if($('#filtro_Desc').val()==''){
        //     var ven_cliDesc=JSON.stringify($('#filtro_Desc').val());
        // }else{
        //     if(/^\s*$/.test($('#filtro_Desc').val())){
        //         var ven_cliDesc=JSON.stringify(document.getElementById("filtro_Desc").value.trim());
        //     }else{
        //         var ven_cliDesc=document.getElementById("filtro_Desc").value;
        //     }
        // }     

        if($('#filtro_Est').val()==''){
            var ven_est=JSON.stringify($('#filtro_Est').val());
        }else{
            if(/^\s*$/.test($('#filtro_Est').val())){
                var ven_est=JSON.stringify(document.getElementById("filtro_Est").value.trim());
            }else{
                var ven_est=document.getElementById("filtro_Est").value;
            }
        }

        var route="http://localhost/Tazper/public/Ventas_filtros";

        $.ajax({
            url: route,
            data: {
                ven_fe: ven_fe,
                id_ven: id_ven,
                ven_fact: ven_fact,
                ven_tip: ven_tip,
                ven_cli: ven_cli,
                // ven_cliLp: ven_cliLp,
                // ven_cliDesc: ven_cliDesc,
                ven_est: ven_est,    
            },
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#paginacion').html(data.paginacion);
                $('#ventas').html(data.contenido);
            }
        });    
        }                  
    });
});