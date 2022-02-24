window.addEventListener("load", function(){
    //cliente
    document.getElementById("busca_prov").addEventListener("keyup", () =>{
        if(document.getElementById("busca_prov").value.length>=1){
            fetch(`/Tazper/public/Ventas/Create/busca_proveedor?busca_prov=${document.getElementById("busca_prov").value}`, { method:'get' })            
                .then(response=>response.text())
                .then(html=>{document.getElementById("proveedor").innerHTML=html});
            
            //cambia el que estaba al buscar otro //busq no disabled            
            $('input[name=cli_ruc],input[name=cli_cat],input[name=cli_desc],input[name=Id_Cli]').val('');              
        }else{
            $("#proveedores").css('display','none'); //en blanco                    
        }
        $('#busqueda').prop('disabled',true);  
    });    
    //cerrar cuadro
    $(document).click(function(){
        if(this!=$(".prov #busca_prov")){
            $("#proveedores").css('display','none');                    
        }             
    });
    //click
    $("#busca_prov").click(function(){        
        if(document.getElementById("busca_prov").value.length>=1){
            fetch(`/Tazper/public/Ventas/Create/busca_proveedor?busca_prov=${document.getElementById("busca_prov").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("proveedor").innerHTML=html});                        
        }
    });

    //productos
    document.getElementById("busqueda").addEventListener("keyup", () =>{
        if(document.getElementById("busqueda").value.length>=1){
            fetch(`/Tazper/public/Ventas/Create/buscador?busqueda=${document.getElementById("busqueda").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("articulos").innerHTML=html});                
        }else{
            document.getElementById("articulos").innerHTML = "";
        }
    });
    //cierra cuadro
    $('#busqueda').addClass('over');
    $('#articulos').addClass('over');        
    
    jQuery('.over').hover(function(){
        if($('#busqueda').val()!=''){ //solo si hay algo
            $('#resultados').show();        
        }            
    }, function(){
        $('#resultados').hide();        
    }); 

    //vuelto
    $('#mont_rec').keyup(function(){        
        if($('input[name=Com_Total]').val()!='' && $('#mont_rec').val()!=''){
            if($('#mont_rec').val()-$('input[name=Com_Total]').val()>=0){
                $('#vuelto').val($('#mont_rec').val()-$('input[name=Com_Total]').val());
            }
        }
    });

    $('#mont_rec').click(function(){ //onkeypress         
        if($('input[name=Com_Total]').val()!='' && $('#mont_rec').val()!=''){
            if($('#mont_rec').val()-$('input[name=Com_Total]').val()>=0){
                $('#vuelto').val($('#mont_rec').val()-$('input[name=Com_Total]').val());
            }
        }
    });

    //Submit
    $('#venta_form').submit(function(){        
        $('input').prop('disabled',false);
    });
});