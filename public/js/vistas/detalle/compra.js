window.addEventListener("load", function(){
    //proveedor
    document.getElementById("busca_prov").addEventListener("keyup", () =>{
        if(document.getElementById("busca_prov").value.length>=1){
            fetch(`/Tazper/public/Compras/Create/busca_proveedor?busca_prov=${document.getElementById("busca_prov").value}`, { method:'get' })            
                .then(response=>response.text())
                .then(html=>{document.getElementById("proveedor").innerHTML=html});
            
            $('#prov_ruc,#prov_tel,#prov_dir').val(''); //cambia //busq no disabled
            $('input[name=Id_Prov]').val('');
        }else{
            $("#proveedores").css('display','none');                    
        }
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
            fetch(`/Tazper/public/Compras/Create/busca_proveedor?busca_prov=${document.getElementById("busca_prov").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("proveedor").innerHTML=html});                        
        }
    });

    //articulos    
    document.getElementById("busqueda").addEventListener("keyup", () =>{
        if(document.getElementById("busqueda").value.length>=1){
            fetch(`/Tazper/public/Compras/Create/buscador?busqueda=${document.getElementById("busqueda").value}`, { method:'get' })
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
        $('#resultados').show();        
    }, function(){
        $('#resultados').hide();        
    }); 

    //Submit
    $('#compra_form').submit(function(){
        // $('input[name=Id_OC]').prop('disabled',false);
        // $('.detalle input').prop('disabled',false);
        // $('input[name=Com_StExe],input[name=Com_St5],input[name=Com_St10],input[name=Com_Total]').prop('disabled',false);        

        $('input').prop('disabled',false);
    });
});