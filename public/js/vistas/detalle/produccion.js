window.addEventListener("load", function(){
    // producto
    if(window.productos.length>0){
    document.getElementById("busca_prod").addEventListener("keyup", () =>{
        if(document.getElementById("busca_prod").value.length>=1){
            fetch(`/Tazper/public/Produccion/{id}/edit/busca_producto?busca_prod=${document.getElementById("busca_prod").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("producto").innerHTML=html});                        
        }else{
            $("#productos").css('display','none');                    
        }
    });    
    //cerrar cuadro
    $(document).click(function(){
        if(this!=$(".prod #busca_prod")){
            $("#productos").css('display','none');                    
        }             
    });
    //click
    $("#busca_prod").click(function(){        
        if(document.getElementById("busca_prod").value.length>=1){
            fetch(`/Tazper/public/Produccion/{id}/edit/busca_producto?busca_prod=${document.getElementById("busca_prod").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("producto").innerHTML=html});                        
        }
    });
    //cambiar producto
    $('.prod .cambiar').click(function(){
        event.preventDefault();
        $('#busca_prod').removeAttr('disabled');
        $('#busca_prod').val('');        
        $('#busca_prod').focus();
        $(this).css('display','none');
        $('#id_prod').val('');
    });
    }

    //material
    document.getElementById("busca_material").addEventListener("keyup", () =>{
        if(document.getElementById("busca_material").value.length>=1){            
            fetch(`/Tazper/public/Produccion/Create/buscador?busca_material=${document.getElementById("busca_material").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("materiales").innerHTML=html});                
        }
        else{
            $("#material").css('display','none');
        //     document.getElementById("materiales").innerHTML = "";        
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
            fetch(`/Tazper/public/Produccion/Create/buscador?busca_material=${document.getElementById("busca_material").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("materiales").innerHTML=html});                
        }
    });
    //cambiar material    
    $('.mat .cambiar').click(function(){
        event.preventDefault();        
        $('#busca_material').prop('disabled',false).val('').focus();
        $(this).css('display','none');   
        $('#tabla_articulo input').val('');    
    });    
});