window.addEventListener("load", function(){
    //Cliente
    document.getElementById("busca_cli").addEventListener("keyup", () =>{
        if(document.getElementById("busca_cli").value.length>=1){
            fetch(`/Tazper/public/PedidoCliente/Create/busca_cliente?busca_cli=${document.getElementById("busca_cli").value}`, { method:'get' })            
                .then(response=>response.text())
                .then(html=>{document.getElementById("cliente").innerHTML=html});
        }else{
            $("#clientes").css('display','none');                    
        }
    });    
        //cerrar cuadro
        $(document).click(function(){
            if(this!=$(".cli #busca_cli")){
                $("#clientes").css('display','none');                    
            }             
        });
        //click
        $("#busca_cli").click(function(){        
            if(document.getElementById("busca_cli").value.length>=1){
                fetch(`/Tazper/public/PedidoCliente/Create/busca_cliente?busca_cli=${document.getElementById("busca_cli").value}`, { method:'get' })
                    .then(response=>response.text())
                    .then(html=>{document.getElementById("cliente").innerHTML=html});                        
            }
        });
        //cambiar cliente
        $('.cli .cambiar').click(function(){
            event.preventDefault();
            $('#busca_cli').removeAttr('disabled');
            $('#busca_cli').val('');        
            $('#busca_cli').focus();
            $(this).css('display','none');
            $('#id_cli').val('');
            $('.cli_cat,.cli_desc').css('display','none');  
            $('#busca_producto').prop('disabled',true);
            $('.detalle input').val('');
        });    

    //Producto
    document.getElementById("busca_producto").addEventListener("keyup", () =>{
        if(document.getElementById("busca_producto").value.length>=1){            
            fetch(`/Tazper/public/PedidoCliente/Create/buscador?busca_prod=${document.getElementById("busca_producto").value}`, { method:'get' })
                .then(response=>response.text())
                .then(html=>{document.getElementById("productos").innerHTML=html});                
        }else{
            $("#producto").css('display','none');              
        }
    });
        //cerrar cuadro
        $(document).click(function(){
            if(this!=$(".prod #busca_producto")){
                $("#producto").css('display','none');
            }
        });  
        //click  
        document.getElementById("busca_producto").addEventListener("click", () =>{
            if(document.getElementById("busca_producto").value.length>=1){            
                fetch(`/Tazper/public/PedidoCliente/Create/buscador?busca_prod=${document.getElementById("busca_producto").value}`, { method:'get' })
                    .then(response=>response.text())
                    .then(html=>{document.getElementById("productos").innerHTML=html});                
            }
        });
        //cambiar prod    
        $('.prod .cambiar').click(function(){
            event.preventDefault();        
            $('#busca_producto').prop('disabled',false).val('').focus();
            $(this).css('display','none');   
            $('#tabla_articulo input').val('');              
        });    

    //Submit
    $('#pedcli_form').submit(function(){
        $('.detalle input').prop('disabled',false);
    });
});