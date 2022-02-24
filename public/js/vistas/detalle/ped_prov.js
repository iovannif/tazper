window.addEventListener("load", function(){
    // proveedor    
    document.getElementById("busca_prov").addEventListener("keyup", () =>{
        if(document.getElementById("busca_prov").value.length>=1){
            fetch(`/Tazper/public/PedidoProveedor/Create/busca_proveedor?busca_prov=${document.getElementById("busca_prov").value}`, { method:'get' })            
                .then(response=>response.text())
                .then(html=>{document.getElementById("proveedor").innerHTML=html});
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
            fetch(`/Tazper/public/PedidoProveedor/Create/busca_proveedor?busca_prov=${document.getElementById("busca_prov").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("proveedor").innerHTML=html});                        
        }
    });
    //cambiar proveedor
    $('.prov .cambiar').click(function(){
        event.preventDefault();
        $('#busca_prov').removeAttr('disabled');
        $('#busca_prov').val('');        
        $('#busca_prov').focus();
        $(this).css('display','none');
        $('#id_prov').val('');
    });    

    //articulo
    document.getElementById("busca_material").addEventListener("keyup", () =>{
        if(document.getElementById("busca_material").value.length>=1){            
            fetch(`/Tazper/public/PedidoProveedor/Create/buscador?busca_material=${document.getElementById("busca_material").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("materiales").innerHTML=html});                
        }else{
            $("#material").css('display','none');              
        }
    });
    //cerrar cuadro
    $(document).click(function(){
        if(this!=$(".mat #busca_material")){
            $("#material").css('display','none');
        }
    });  
    //click  
    document.getElementById("busca_material").addEventListener("click", () =>{
        if(document.getElementById("busca_material").value.length>=1){            
            fetch(`/Tazper/public/PedidoProveedor/Create/buscador?busca_material=${document.getElementById("busca_material").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("materiales").innerHTML=html});                
        }
    });
    //cambiar articulo    
    $('.mat .cambiar').click(function(){
        event.preventDefault();        
        $('#busca_material').prop('disabled',false).val('').focus();
        $(this).css('display','none');   
        $('#tabla_articulo input').val('');    
    });    

    //Submit
    $('#pedprov_form').submit(function(){
        $('.detalle input').prop('disabled',false);
    });
});