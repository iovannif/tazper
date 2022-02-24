window.addEventListener("load", function(){
    //blanco
    function busca(){
        fetch(`/Tazper/public/Materiales/{id}/edit/busca_proveedor_2`, { method:'get' })
        .then(response=>response.text())
        .then(html=>{document.getElementById("proveedor").innerHTML=html});
    }

    //busqueda
    document.getElementById("busca_prov").addEventListener("keyup", () =>{
        if(document.getElementById("busca_prov").value.length>=1){
            fetch(`/Tazper/public/Materiales/{id}/edit/busca_proveedor_1?busca_prov=${document.getElementById("busca_prov").value}`, { method:'get' })            
                .then(response=>response.text())
                .then(html=>{document.getElementById("proveedor").innerHTML=html});
                // .then(html=>{console.log(html)});

                // var busca_prov=document.getElementById("busca_prov").value;
                // var route="/Tazper/public/Materiales/{id}/edit/busca_proveedor_1";
                // $.ajax({
                //     async:false,
                //     url: "/Tazper/public/Materiales/{id}/edit/busca_proveedor_1",
                //     data: {busca_prov: busca_prov},
                //     type: 'GET',
                //     dataType: 'json',
                //     success: function(data){
                //         console.log(document.getElementById("busca_prov").value);                                       
                //     },
                //     error:function(err){
                //         // console.log(document.getElementById("busca_prov").value);     
                //         console.log(JSON.stringify(err));     
                //         console.log(err);                               
                //     }
                // });            
        }else{
            busca();
        }
    });

    //focus
    $("#busca_prov").click(function(){ //focus
        busca();
    });
    
    //salir
    $(document).click(function(){
        if(this!=$("#busca_prov")){
            $("#proveedores").css('display','none');
        }
    });
    //blur

    //cambiar
    $('.prov .cambiar').click(function(){
        event.preventDefault();
        $('#busca_prov').removeAttr('disabled');
        $('#busca_prov').val('');
        $('#busca_prov').trigger('click');
        $('#busca_prov').focus();
        $(this).css('display','none');
        $('#id_prov').val('');
    });
});